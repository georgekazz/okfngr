<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($post) ? 'Επεξεργασία Άρθρου' : 'Δημιουργία Άρθρου' }} - OKFN Greece</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- TinyMCE Editor -->
<script src="https://cdn.tiny.cloud/1/5seorlrf0fc75ossjv7xrxelfgubizejfpbn3bhrasuppiwa/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Header -->
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <a href="{{ url('/el/writer/dashboard') }}">
                    <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                </a>
                <h1>{{ isset($post) ? 'Επεξεργασία Άρθρου' : 'Δημιουργία Άρθρου' }}</h1>
            </div>
            <div class="header-right">
                <a href="{{ url('/el/writer/dashboard') }}" class="back-btn">
                    ← Επιστροφή στον Πίνακα
                </a>
            </div>
        </div>
    </header>

    <div class="editor-layout">
        <form action="{{ isset($post) ? url('/el/writer/posts/' . $post->id) : url('/el/writer/posts') }}" 
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
                           placeholder="Εισάγετε τον τίτλο..."
                           value="{{ old('title', $post->title ?? '') }}"
                           required>
                    @error('title')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div class="form-group">
                    <label for="excerpt">Περίληψη</label>
                    <textarea name="excerpt" 
                              id="excerpt" 
                              rows="3"
                              class="excerpt-input @error('excerpt') error @enderror"
                              placeholder="Σύντομη περιγραφή του άρθρου...">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                    @error('excerpt')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Content Editor -->
                <div class="form-group">
                    <label for="content">Περιεχόμενο</label>
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
                    <h3>Δημοσίευση</h3>
                    
                    <div class="publish-actions">
                        <button type="submit" name="status" value="draft" class="btn-secondary">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M14.25 15.75H3.75C3.35218 15.75 2.97064 15.592 2.68934 15.3107C2.40804 15.0294 2.25 14.6478 2.25 14.25V3.75C2.25 3.35218 2.40804 2.97064 2.68934 2.68934C2.97064 2.40804 3.35218 2.25 3.75 2.25H11.25L15.75 6.75V14.25C15.75 14.6478 15.592 15.0294 15.3107 15.3107C15.0294 15.592 14.6478 15.75 14.25 15.75Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Αποθήκευση Προχείρου
                        </button>
                        
                        <button type="submit" name="status" value="published" class="btn-primary">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M15.75 3.75L6.75 12.75L2.25 8.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ isset($post) && $post->status === 'published' ? 'Ενημέρωση' : 'Δημοσίευση' }}
                        </button>
                    </div>

                    @if(isset($post))
                    <div class="post-info">
                        <small>Δημιουργήθηκε: {{ $post->created_at->format('d/m/Y H:i') }}</small>
                        @if($post->updated_at != $post->created_at)
                        <small>Ενημερώθηκε: {{ $post->updated_at->format('d/m/Y H:i') }}</small>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Categories -->
                <div class="sidebar-box">
                    <h3>Κατηγορίες</h3>
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
                    <h3>Ετικέτες</h3>
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
                    <h3>Εικόνα Επικεφαλίδας</h3>
                    
                    @if(isset($post) && $post->featured_image)
                    <div class="current-image">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remove_image" value="1">
                            <span>Αφαίρεση εικόνας</span>
                        </label>
                    </div>
                    @endif

                    <input type="file" 
                           name="featured_image" 
                           id="featured_image"
                           accept="image/*"
                           class="file-input">
                    <small>JPG, PNG, GIF - Max 5MB</small>
                </div>

            </aside>
        </form>
    </div>

   <script>
    const uploadImageUrl = "{{ route('writer.upload-image', ['locale' => app()->getLocale()]) }}";

    tinymce.init({
        selector: '#content',
        height: 600,
        menubar: true,
        convert_urls: false,
        relative_urls: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | \
                 alignleft aligncenter alignright alignjustify | \
                 bullist numlist outdent indent | removeformat | help',
        content_style: 'body { font-family: Roboto, Arial, sans-serif; font-size: 16px; }',
        language: 'el',
        paste_data_images: false,
        images_file_types: 'jpg,jpeg,png,gif,webp',
        automatic_uploads: true,
        images_reuse_filename: false,
        images_upload_url: uploadImageUrl,
        images_upload_handler: function (blobInfo, progress) {
            return new Promise(function (resolve, reject) {
                let formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                fetch(uploadImageUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.location) {
                        resolve(data.location);
                    } else {
                        reject('Upload failed: ' + JSON.stringify(data));
                    }
                })
                .catch(err => reject('Upload error: ' + err));
            });
        }
    });
</script>
</body>
</html>