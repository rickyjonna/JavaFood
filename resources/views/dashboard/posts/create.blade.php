@extends('dashboard.layouts.index')

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Post</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" required autofocus value="{{ old('name') }}" id="name"
                    class="form-control
                    @error('name')
                    is-invalid
                    @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Slug --}}
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" id="slug" name="slug" required value="{{ old('slug') }}"
                    {{-- more option : disabled readonly --}}
                    class="form-control
                        @error('slug')
                            is-invalid
                        @enderror">
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        @if (old('category_id') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            {{-- Tag = belajar lagi cara old tag --}}
            <p class="form-label">Tag</p>
            <div class="mb-3">
                @foreach ($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" name="tags_id[]" type="checkbox" value="{{ $tag->id }}"
                            id="checkbox_{{ $tag->id }}"
                            {{ is_array(old('tags_id')) && in_array($tag->id, old('tags_id')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="checkbox_{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            {{-- image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                <br>
                <img class="img-preview img-fluid mb-3 col-sm-4">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                @error('description')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
                <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                <trix-editor input="description"></trix-editor>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>

    <script>
        // auto fill name slug
        const name = document.querySelector("#name");
        const slug = document.querySelector("#slug");

        name.addEventListener("keyup", function() {
            let preslug = name.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });

        // No upload from trix
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })

        //Image Preview
        function previewImage() {
            // Get the input element and the preview container
            const inputElement = document.getElementById('image');
            const previewContainer = document.querySelector('.img-preview');

            // Check if there are any files selected
            if (inputElement.files && inputElement.files.length > 0) {
                // Get the first file (assuming only one is selected)
                const selectedFile = inputElement.files[0];

                // Create a URL that can be used to reference the selected file
                const previewUrl = URL.createObjectURL(selectedFile);

                // Set the src attribute of the preview container to the preview URL
                previewContainer.src = previewUrl;
            }
        }
    </script>
@endsection
