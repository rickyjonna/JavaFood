@extends('dashboard.layouts.newindex')

@section('main')
    <div class="container ml-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tambah Menu</h1>
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

                {{-- Kota --}}
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <select class="form-select" name="city_id">
                        @foreach ($cities as $city)
                            @if (old('city_id') == $city->id)
                                <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                            @else
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endif
                        @endforeach
                    </select>
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

                {{-- sub category --}}
                <p class="form-label flsc">Sub_category</p>
                <div class="mb-3 sc">
                    @foreach ($sub_categories as $sub_category)
                        <div class="form-check">
                            <input class="form-check-input" name="sub_categories_id[]" type="checkbox"
                                value="{{ $sub_category->id }}" id="checkbox_{{ $sub_category->id }}_sc"
                                {{ is_array(old('sub_categories_id')) && in_array($sub_category->id, old('sub_categories_id')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkbox_{{ $sub_category->id }}_sc">
                                {{ $sub_category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                {{-- Tag --}}
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
                        name="image" onchange="previewImage()" style="height: 45px">
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

        // sub_categories hide/show
        // Get the category select element
        var categorySelect = document.querySelector('select[name="category_id"]');
        // Get the subcategory form container element
        var subCategoryFormContainer = document.querySelector('.sc');
        // Get the label for the subcategory form
        var subCategoryLabel = document.querySelector('.flsc');
        // Add an event listener to the category select element
        categorySelect.addEventListener('change', function() {
            // Get the selected value of the category select element
            var selectedCategory = this.value;

            // If the selected category is not 1:
            if (selectedCategory != '1') {
                // Get all the subcategory checkboxes
                var subCategoryCheckboxes = document.querySelectorAll('input[name="sub_categories_id[]"]');
                // Loop through the subcategory checkboxes
                for (var i = 0; i < subCategoryCheckboxes.length; i++) {
                    // Uncheck the checkbox
                    subCategoryCheckboxes[i].checked = false;
                }
                // Hide the contents of the subcategory form container
                subCategoryFormContainer.style.display = 'none';
                // Hide the label for the subcategory form
                subCategoryLabel.style.display = 'none';
            } else {
                // Otherwise, show the contents of the subcategory form container
                subCategoryFormContainer.style.display = 'block';
                // Show the label for the subcategory form
                subCategoryLabel.style.display = 'block';
            }
        });
    </script>
@endsection
