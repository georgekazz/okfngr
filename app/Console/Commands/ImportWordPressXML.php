<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImportWordPressXML extends Command
{
    protected $signature = 'import:wordpress-xml {file}';
    protected $description = 'Import posts from WordPress XML export file';

    private $stats = [
        'posts' => 0,
        'categories' => 0,
        'tags' => 0,
        'images' => 0,
        'skipped' => 0,
        'failed' => 0,
    ];

    private $userMap = [];
    private $categoryMap = [];
    private $tagMap = [];
    private $attachmentMap = [];

    public function handle()
    {
        $xmlFile = $this->argument('file');

        if (!file_exists($xmlFile)) {
            $this->error("File not found: {$xmlFile}");
            return 1;
        }

        $this->info('Starting WordPress XML import...');
        $this->info('File: ' . basename($xmlFile));
        $this->info('');

        // Load and parse XML
        $this->info('📖 Reading XML file...');
        libxml_use_internal_errors(true);
        $xml = simplexml_load_file($xmlFile);

        if (!$xml) {
            $this->error('❌ Failed to parse XML file. Errors:');
            foreach (libxml_get_errors() as $error) {
                $this->error('  ' . $error->message);
            }
            return 1;
        }

        $namespaces = $xml->getNamespaces(true);
        $this->info('XML file loaded successfully');
        $this->info('');

        // Build attachment map FIRST (needed for featured image resolution)
        $this->info('🖼️  Building attachment map...');
        $this->attachmentMap = $this->buildAttachmentMap($xml, $namespaces);
        $this->info('Found ' . count($this->attachmentMap) . ' attachments');
        $this->info('');

        // Import authors
        $this->importAuthors($xml, $namespaces);
        $this->info('');

        // Import categories
        $this->importCategories($xml, $namespaces);
        $this->info('');

        // Import tags
        $this->importTags($xml, $namespaces);
        $this->info('');

        // Import posts
        $this->importPosts($xml, $namespaces);

        // Show summary
        $this->showSummary();

        return 0;
    }

    private function buildAttachmentMap($xml, $namespaces)
    {
        $wp = $namespaces['wp'] ?? null;
        $map = [];

        if (!$wp) {
            return $map;
        }

        $items = $xml->xpath('//item');
        foreach ($items as $item) {
            $item->registerXPathNamespace('wp', $wp);
            $postType = (string) $item->children($wp)->post_type;

            if ($postType !== 'attachment') {
                continue;
            }

            $postId = (string) $item->children($wp)->post_id;
            $attachmentUrl = (string) $item->children($wp)->attachment_url;

            // Fallback to guid
            if (empty($attachmentUrl)) {
                $attachmentUrl = (string) $item->guid;
            }

            if ($postId && $attachmentUrl) {
                $map[$postId] = $attachmentUrl;
            }
        }

        return $map;
    }

    private function importAuthors($xml, $namespaces)
    {
        $this->info('👥 Importing authors...');

        $wp = $namespaces['wp'] ?? null;
        if (!$wp) {
            $this->warn('No WordPress namespace found, using default admin for all posts');
            $this->userMap['default'] = User::where('role', 'admin')->first()->id;
            return;
        }

        $authors = $xml->xpath('//wp:author');

        foreach ($authors as $wpAuthor) {
            $wpAuthor->registerXPathNamespace('wp', $wp);

            $login = (string) $wpAuthor->children($wp)->author_login;
            $email = (string) $wpAuthor->children($wp)->author_email;
            $displayName = (string) $wpAuthor->children($wp)->author_display_name;
            $firstName = (string) $wpAuthor->children($wp)->author_first_name;
            $lastName = (string) $wpAuthor->children($wp)->author_last_name;

            if (empty($email)) {
                $email = $login . '@imported.local';
            }

            $name = $displayName ?: ($firstName . ' ' . $lastName);
            if (empty(trim($name))) {
                $name = $login;
            }

            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => trim($name),
                    'email' => $email,
                    'password' => bcrypt(Str::random(32)),
                    'role' => 'writer',
                    'email_verified_at' => now(),
                ]);

                $this->line("  ✓ Created user: {$name} ({$email})");
            }

            $this->userMap[$login] = $user->id;
        }

        // Ensure we have a default user
        if (empty($this->userMap)) {
            $defaultUser = User::where('role', 'admin')->first();
            $this->userMap['default'] = $defaultUser->id;
        }

        $this->info("Processed " . count($this->userMap) . " authors");
    }

    private function importCategories($xml, $namespaces)
    {
        $this->info('Importing categories...');

        $wp = $namespaces['wp'] ?? null;
        if (!$wp) {
            return;
        }

        $categories = $xml->xpath('//wp:category');

        foreach ($categories as $wpCategory) {
            $wpCategory->registerXPathNamespace('wp', $wp);

            $slug = (string) $wpCategory->children($wp)->category_nicename;
            $name = (string) $wpCategory->children($wp)->cat_name;
            $description = (string) $wpCategory->children($wp)->category_description;

            if ($slug === 'uncategorized') {
                continue;
            }

            $category = Category::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => $description ?: null,
                ]
            );

            $this->categoryMap[$slug] = $category->id;

            if ($category->wasRecentlyCreated) {
                $this->line("  ✓ Created category: {$name}");
                $this->stats['categories']++;
            }
        }

        $this->info("Imported {$this->stats['categories']} categories");
    }

    private function importTags($xml, $namespaces)
    {
        $this->info('Importing tags...');

        $wp = $namespaces['wp'] ?? null;
        if (!$wp) {
            return;
        }

        $tags = $xml->xpath('//wp:tag');

        foreach ($tags as $wpTag) {
            $wpTag->registerXPathNamespace('wp', $wp);

            $slug = (string) $wpTag->children($wp)->tag_slug;
            $name = (string) $wpTag->children($wp)->tag_name;
            $description = (string) $wpTag->children($wp)->tag_description;

            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => $description ?: null,
                ]
            );

            $this->tagMap[$slug] = $tag->id;

            if ($tag->wasRecentlyCreated) {
                $this->line("  ✓ Created tag: {$name}");
                $this->stats['tags']++;
            }
        }

        $this->info("Imported {$this->stats['tags']} tags");
    }

    private function importPosts($xml, $namespaces)
    {
        $this->info('📝 Importing posts...');

        $wp = $namespaces['wp'] ?? null;
        $content = $namespaces['content'] ?? null;
        $excerpt = $namespaces['excerpt'] ?? null;

        $items = $xml->xpath('//item');
        $totalItems = count($items);

        $progressBar = $this->output->createProgressBar($totalItems);
        $progressBar->start();

        foreach ($items as $item) {
            $item->registerXPathNamespace('wp', $wp);
            $item->registerXPathNamespace('content', $content);
            $item->registerXPathNamespace('excerpt', $excerpt);

            $postType = (string) $item->children($wp)->post_type;

            if ($postType !== 'post') {
                $progressBar->advance();
                continue;
            }

            $status = (string) $item->children($wp)->status;

            if ($status !== 'publish') {
                $progressBar->advance();
                continue;
            }

            $this->importPost($item, $wp, $content, $excerpt);
            $progressBar->advance();
        }

        $progressBar->finish();
        $this->info('');
        $this->info("✅ Imported {$this->stats['posts']} posts");
    }

    private function importPost($item, $wp, $content, $excerpt)
    {
        try {
            $title = (string) $item->title;
            $slug = (string) $item->children($wp)->post_name;

            if (Post::where('slug', $slug)->exists()) {
                $this->stats['skipped']++;
                return;
            }

            $postContent = (string) $item->children($content)->encoded;
            $postExcerpt = (string) $item->children($excerpt)->encoded;
            $postDate = (string) $item->children($wp)->post_date;
            $pubDate = (string) $item->pubDate;
            $creator = (string) $item->children('http://purl.org/dc/elements/1.1/')->creator;

            $postContent = $this->cleanHtmlContent($postContent);

            $userId = $this->userMap[$creator] ?? $this->userMap['default'] ?? User::where('role', 'admin')->first()->id;

            // Categories
            $categoryIds = [];
            $categories = $item->xpath('category[@domain="category"]');
            foreach ($categories as $cat) {
                $categoryName = (string) $cat;
                $categorySlug = Str::slug($categoryName);

                if (!isset($this->categoryMap[$categorySlug])) {
                    $category = Category::firstOrCreate(
                        ['slug' => $categorySlug],
                        ['name' => $categoryName]
                    );
                    $this->categoryMap[$categorySlug] = $category->id;
                    $this->stats['categories']++;
                }

                $categoryIds[] = $this->categoryMap[$categorySlug];
            }

            // Tags
            $tagIds = [];
            $tags = $item->xpath('category[@domain="post_tag"]');
            foreach ($tags as $tag) {
                $tagName = (string) $tag;
                $tagSlug = Str::slug($tagName);

                if (!isset($this->tagMap[$tagSlug])) {
                    $tagModel = Tag::firstOrCreate(
                        ['slug' => $tagSlug],
                        ['name' => $tagName]
                    );
                    $this->tagMap[$tagSlug] = $tagModel->id;
                    $this->stats['tags']++;
                }

                $tagIds[] = $this->tagMap[$tagSlug];
            }

            // Featured image
            $thumbnailPath = null;
            $attachmentUrl = $this->extractFeaturedImage($item, $wp);

            // Resolve thumbnail_id to actual URL via attachment map
            if (is_array($attachmentUrl) && isset($attachmentUrl['thumbnail_id'])) {
                $thumbnailId = $attachmentUrl['thumbnail_id'];
                $attachmentUrl = $this->attachmentMap[$thumbnailId] ?? null;
            }

            if ($attachmentUrl) {
                $thumbnailPath = $this->downloadImage($attachmentUrl, $slug);
                if ($thumbnailPath) {
                    $this->stats['images']++;
                }
            }

            // Excerpt
            $cleanExcerpt = strip_tags($postExcerpt);
            $cleanExcerpt = html_entity_decode($cleanExcerpt);
            $cleanExcerpt = trim($cleanExcerpt);

            if (empty($cleanExcerpt) && !empty($postContent)) {
                $cleanExcerpt = strip_tags($postContent);
                $cleanExcerpt = html_entity_decode($cleanExcerpt);
                $cleanExcerpt = Str::limit($cleanExcerpt, 200);
            }

            // Date
            $publishedDate = null;
            if (!empty($postDate) && $postDate !== '0000-00-00 00:00:00') {
                $publishedDate = Carbon::parse($postDate);
            } elseif (!empty($pubDate)) {
                $publishedDate = Carbon::parse($pubDate);
            } else {
                $publishedDate = now();
            }

            $post = Post::create([
                'title' => html_entity_decode($title),
                'slug' => $slug,
                'content' => $postContent,
                'excerpt' => $cleanExcerpt,
                'featured_image' => $thumbnailPath,
                'user_id' => $userId,
                'status' => 'published',
                'published_at' => $publishedDate,
                'views_count' => 0,
                'created_at' => $publishedDate,
                'updated_at' => $publishedDate,
            ]);

            if (!empty($categoryIds)) {
                $post->categories()->sync($categoryIds);
            }

            if (!empty($tagIds)) {
                $post->tags()->sync($tagIds);
            }

            $this->stats['posts']++;

        } catch (\Exception $e) {
            $this->stats['failed']++;
            $this->newLine();
            $this->error("❌ Failed to import: {$title}");
            $this->error("   Error: " . $e->getMessage());
        }
    }

    private function cleanHtmlContent($html)
    {
        if (empty($html)) {
            return '';
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);

        // Remove style attributes
        foreach ($xpath->query('//*[@style]') as $node) {
            $node->removeAttribute('style');
        }

        // Remove class attributes (keep on img)
        foreach ($xpath->query('//*[@class]') as $node) {
            if ($node->nodeName !== 'img') {
                $node->removeAttribute('class');
            }
        }

        // Remove id attributes
        foreach ($xpath->query('//*[@id]') as $node) {
            $node->removeAttribute('id');
        }

        // Remove width/height from images
        foreach ($xpath->query('//img') as $img) {
            $img->removeAttribute('width');
            $img->removeAttribute('height');
        }

        // Remove align attributes
        foreach ($xpath->query('//*[@align]') as $node) {
            $node->removeAttribute('align');
        }

        $cleanedHtml = $dom->saveHTML();
        $cleanedHtml = preg_replace('/^<!DOCTYPE.+?>/', '', $cleanedHtml);
        $cleanedHtml = str_replace(['<html>', '</html>', '<body>', '</body>'], '', $cleanedHtml);

        return trim($cleanedHtml);
    }

    private function extractFeaturedImage($item, $wp)
    {
        // Method 1: _thumbnail_id → resolve via attachment map
        $thumbnailMeta = $item->xpath('wp:postmeta[wp:meta_key="_thumbnail_id"]');
        if (!empty($thumbnailMeta)) {
            $thumbnailMeta[0]->registerXPathNamespace('wp', $wp);
            $thumbnailId = (string) $thumbnailMeta[0]->children($wp)->meta_value;
            if ($thumbnailId) {
                return ['thumbnail_id' => $thumbnailId];
            }
        }

        // Method 2: _wp_attached_file
        $postmeta = $item->xpath('wp:postmeta[wp:meta_key="_wp_attached_file"]');
        if (!empty($postmeta)) {
            $postmeta[0]->registerXPathNamespace('wp', $wp);
            $attachedFile = (string) $postmeta[0]->children($wp)->meta_value;
            if ($attachedFile) {
                return 'https://okfn.gr/wp-content/uploads/' . $attachedFile;
            }
        }

        // Method 3: First image in content
        $content = (string) $item->children('http://purl.org/rss/1.0/modules/content/')->encoded;
        if (preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function downloadImage($url, $postSlug)
    {
        try {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                return null;
            }

            $response = Http::timeout(30)->get($url);

            if (!$response->successful()) {
                return null;
            }

            $extension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
            if (empty($extension) || !in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $extension = 'jpg';
            }

            $filename = Str::slug($postSlug) . '-' . time() . '-' . Str::random(8) . '.' . $extension;
            $path = 'thumbnails/' . $filename;
            Storage::disk('public')->put($path, $response->body());

            return $path;

        } catch (\Exception $e) {
            return null;
        }
    }

    private function showSummary()
    {
        $this->info('');
        $this->info('════════════════════════════════════════');
        $this->info('📊 IMPORT SUMMARY');
        $this->info('════════════════════════════════════════');
        $this->info("📝 Posts imported:       {$this->stats['posts']}");
        $this->info("📂 Categories created:   {$this->stats['categories']}");
        $this->info("🏷️  Tags created:         {$this->stats['tags']}");
        $this->info("🖼️  Images downloaded:   {$this->stats['images']}");
        $this->info("⏭️  Posts skipped:       {$this->stats['skipped']} (already exist)");
        $this->info("❌ Posts failed:        {$this->stats['failed']}");
        $this->info('════════════════════════════════════════');
        $this->info('');
        $this->info('🎉 Import completed successfully!');
    }
}