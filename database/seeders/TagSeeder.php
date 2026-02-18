<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            // Open Data & Technology
            [
                'name' => 'Ανοιχτά Δεδομένα',
                'slug' => 'anoichta-dedomena',
            ],
            [
                'name' => 'Open Data',
                'slug' => 'open-data',
            ],
            [
                'name' => 'Ανοιχτό Λογισμικό',
                'slug' => 'anoichto-logismiko',
            ],
            [
                'name' => 'Open Source',
                'slug' => 'open-source',
            ],
            [
                'name' => 'Διαφάνεια',
                'slug' => 'diafaneia',
            ],
            [
                'name' => 'Transparency',
                'slug' => 'transparency',
            ],

            // Technology
            [
                'name' => 'Τεχνολογία',
                'slug' => 'technologia',
            ],
            [
                'name' => 'Technology',
                'slug' => 'technology',
            ],
            [
                'name' => 'API',
                'slug' => 'api',
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
            ],
            [
                'name' => 'AI',
                'slug' => 'ai',
            ],

            // Education & Research
            [
                'name' => 'Εκπαίδευση',
                'slug' => 'ekpaidefsi',
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
            ],
            [
                'name' => 'Έρευνα',
                'slug' => 'erevna',
            ],
            [
                'name' => 'Research',
                'slug' => 'research',
            ],
            [
                'name' => 'Workshops',
                'slug' => 'workshops',
            ],

            // Community & Events
            [
                'name' => 'Κοινότητα',
                'slug' => 'koinotita',
            ],
            [
                'name' => 'Community',
                'slug' => 'community',
            ],
            [
                'name' => 'Εκδηλώσεις',
                'slug' => 'ekdiloseis',
            ],
            [
                'name' => 'Events',
                'slug' => 'events',
            ],
            [
                'name' => 'Hackathon',
                'slug' => 'hackathon',
            ],

            // Government & Policy
            [
                'name' => 'Δημόσια Διοίκηση',
                'slug' => 'dimosia-dioikisi',
            ],
            [
                'name' => 'Government',
                'slug' => 'government',
            ],
            [
                'name' => 'Πολιτική',
                'slug' => 'politiki',
            ],
            [
                'name' => 'Policy',
                'slug' => 'policy',
            ],
            [
                'name' => 'Νομοθεσία',
                'slug' => 'nomothesia',
            ],

            // Civic Tech
            [
                'name' => 'Civic Tech',
                'slug' => 'civic-tech',
            ],
            [
                'name' => 'Συμμετοχή Πολιτών',
                'slug' => 'symmetochi-politon',
            ],
            [
                'name' => 'Δημοκρατία',
                'slug' => 'dimokratia',
            ],
            [
                'name' => 'Democracy',
                'slug' => 'democracy',
            ],

            // Projects & Initiatives
            [
                'name' => 'Έργα',
                'slug' => 'erga',
            ],
            [
                'name' => 'Projects',
                'slug' => 'projects',
            ],
            [
                'name' => 'Πρωτοβουλίες',
                'slug' => 'protovoulies',
            ],
            [
                'name' => 'Initiatives',
                'slug' => 'initiatives',
            ],

            // Specific Topics
            [
                'name' => 'COVID-19',
                'slug' => 'covid-19',
            ],
            [
                'name' => 'Κλιματική Αλλαγή',
                'slug' => 'klimatiki-allagi',
            ],
            [
                'name' => 'Climate Change',
                'slug' => 'climate-change',
            ],
            [
                'name' => 'Προσβασιμότητα',
                'slug' => 'prosvassimotita',
            ],
            [
                'name' => 'Accessibility',
                'slug' => 'accessibility',
            ],

            // Media & Communication
            [
                'name' => 'Νέα',
                'slug' => 'nea',
            ],
            [
                'name' => 'News',
                'slug' => 'news',
            ],
            [
                'name' => 'Blog',
                'slug' => 'blog',
            ],
            [
                'name' => 'Podcast',
                'slug' => 'podcast',
            ],
            [
                'name' => 'Video',
                'slug' => 'video',
            ],
        ];

        foreach ($tags as $tag) {
            if (!Tag::where('slug', $tag['slug'])->exists()) {
                Tag::create($tag);
                $this->command->info("✓ Tag created: {$tag['name']}");
            } else {
                $this->command->warn("⚠ Tag '{$tag['name']}' already exists. Skipping...");
            }
        }

        $this->command->info('');
        $this->command->info("✅ Created " . count($tags) . " tags successfully!");
    }
}