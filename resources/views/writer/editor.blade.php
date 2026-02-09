<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($post) ? __('writer.edit_post') : __('writer.create_post') }} - OKFN Greece</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/writer-dashboard.css') }}">
    <!-- TinyMCE Editor -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <a href="{{ route('writer.dashboard') }}">
                    <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                </a>
                <h1>{{ isset($post) ? __('writer.edit_post') : __('writer.create_post') }}</h1>
            </div>
            <div class="header-right">
                <a href="{{ route('writer.dashboard') }}" class="back-btn">
                    ← {{ __('writer.back_to_dashboard') }}
                </a>
            </div>
        </div>
    </header>

    <div class="editor-layout">
        <form action="{{ isset($post) ? route('writer.posts.update', $post) : route('writer.posts.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="editor-form">
            @csrf
            @if(isset($post))
                @method('PUT')
            @endif

            <!-- Main Editor -->
            <div class="editor-main">
                
                @if ($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Title -->
                <div class="form-group">
                    <input type="text" 
                           name="title" 
                           id="title"
                           class="title-input @error('title') error @enderror" 
                           placeholder="{{ __('writer.post_title_placeholder') }}"
                           value="{{ old('title', $post->title ?? '') }}"
                           required>
                    @error('title')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div class="form-group">
                    <label for="excerpt">{{ __('writer.excerpt') }}</label>
                    <textarea name="excerpt" 
                              id="excerpt" 
                              rows="3"
                              class="excerpt-input @error('excerpt') error @enderror"
                              placeholder="{{ __('writer.excerpt_placeholder') }}">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                    @error('excerpt')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Content Editor -->
                <div class="form-group">
                    <label for="content">{{ __('writer.content') }}</label>
                    <textarea name="content" 
                              id="content" 
                              class="@error('content') error @enderror">{{ old('content', $post->content ?? '') }}</textarea>
                    @error('content')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="editor-sidebar">
                
                <!-- Publish Box -->
                <div class="sidebar-box">
                    <h3>{{ __('writer.publish') }}</h3>
                    
                    <div class="publish-actions">
                        <button type="submit" name="status" value="draft" class="btn-secondary">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M14.25 15.75H3.75C3.35218 15.75 2.97064 15.592 2.68934 15.3107C2.40804 15.0294 2.25 14.6478 2.25 14.25V3.75C2.25 3.35218 2.40804 2.97064 2.68934 2.68934C2.97064 2.40804 3.35218 2.25 3.75 2.25H11.25L15.75 6.75V14.25C15.75 14.6478 15.592 15.0294 15.3107 15.3107C15.0294 15.592 14.6478 15.75 14.25 15.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ __('writer.save_draft') }}
                        </button>
                        
                        <button type="submit" name="status" value="published" class="btn-primary">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M15.75 3.75L6.75 12.75L2.25 8.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ isset($post) && $post->status === 'published' ? __('writer.update') : __('writer.publish') }}
                        </button>
                    </div>

                    @if(isset($post))
                    <div class="post-info">
                        <small>{{ __('writer.created') }}: {{ $post->created_at->format('d/m/Y H:i') }}</small>
                        @if($post->updated_at != $post->created_at)
                        <small>{{ __('writer.updated') }}: {{ $post->updated_at->format('d/m/Y H:i') }}</small>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Categories -->
                <div class="sidebar-box">
                    <h3>{{ __('writer.categories') }}</h3>
                    <div class="checkbox-group">
                        @foreach($categories as $category)
                        <label class="checkbox-label">
                            <input type="checkbox" 
                                   name="categories[]" 
                                   value="{{ $category->id }}"
                                   {{ (isset($post) && $post->categories->contains($category->id)) || (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'checked' : '' }}>
                            <span>{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Tags -->
                <div class="sidebar-box">
                    <h3>{{ __('writer.tags') }}</h3>
                    <div class="checkbox-group">
                        @foreach($tags as $tag)
                        <label class="checkbox-label">
                            <input type="checkbox" 
                                   name="tags[]" 
                                   value="{{ $tag->id }}"
                                   {{ (isset($post) && $post->tags->contains($tag->id)) || (is_array(old('tags')) && in_array($tag->id, old('tags'))) ? 'checked' : '' }}>
                            <span>{{ $tag->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="sidebar-box">
                    <h3>{{ __('writer.featured_image') }}</h3>
                    
                    @if(isset($post) && $post->featured_image)
                    <div class="current-image">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remove_image" value="1">
                            <span>{{ __('writer.remove_image') }}</span>
                        </label>
                    </div>
                    @endif

                    <input type="file" 
                           name="featured_image" 
                           id="featured_image"
                           accept="image/*"
                           class="file-input">
                    <small>{{ __('writer.image_formats') }}</small>
                </div>

            </aside>
        </form>
    </div>

    <script>
        // Initialize TinyMCE
        tinymce.init({
            selector: '#content',
            height: 600,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | \
                     alignleft aligncenter alignright alignjustify | \
                     bullist numlist outdent indent | removeformat | help',
            content_style: 'body { font-family: Roboto, Arial, sans-serif; font-size: 16px; }',
            language: '{{ app()->getLocale() === "el" ? "el" : "en" }}'
        });

        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function(e) {
            const title = e.target.value;
            // You can add slug preview here if needed
        });
    </script>
</body>
</html>