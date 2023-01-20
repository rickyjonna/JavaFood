@extends('dashboard.layouts.newindex')

@section('main')
    <div class="container ml-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Ubah Menu</h1>
        </div>
        <div class="col-lg-8">
            <form method="post" action="/dashboard/posts/{{ $post->slug }}" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                {{-- nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" required autofocus value="{{ old('name', $post->name) }}"
                        id="name"
                        class="form-control
                    @error('name')
                    is-invalid
                    @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- slug --}}
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" required value="{{ old('slug', $post->slug) }}"
                        {{-- more option : disabled readonly --}}
                        class="form-control
                        @error('slug')
                            is-invalid
                        @enderror">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- City --}}
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <select class="form-select" name="city_id">
                        @foreach ($cities as $city)
                            @if (old('city_id', $post->city_id) == $city->id)
                                <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                            @else
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- Category --}}
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" name="category_id">
                        @foreach ($categories as $category)
                            @if (old('category_id', $post->category_id) == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                {{-- Sub Category --}}
                <p class="form-label flsc">Sub_category</p>
                <div class="mb-3 sc">
                    @foreach ($sub_categories as $sub_category)
                        <div class="form-check">
                            <input class="form-check-input" name="sub_categories_id[]" type="checkbox"
                                value="{{ $sub_category->id }}" id="checkbox_{{ $sub_category->id }}_sc"
                                {{ $post->sub_categories->contains($sub_category) || (is_array(old('sub_categories_id')) && in_array($sub_category->id, old('sub_categories_id'))) ? 'checked' : '' }}>
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
                                {{ $post->tags->contains($tag) || (is_array(old('tags_id')) && in_array($tag->id, old('tags_id'))) ? 'checked' : '' }}>
                            <label class="form-check-label" for="checkbox_{{ $tag->id }}">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                {{-- image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Post Image</label>
                    <input type="hidden" name="oldImage" value="{{ $post->image }}">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                            class="img-preview img-fluid mb-3 col-sm-5 d-block">
                    @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                    @endif
                    <input
                        class="form-control
                    @error('image')
                    is-invalid
                    @enderror"
                        type="file" id="image" name="image" onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- isi --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    @error('description')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                    <input id="description" type="hidden" name="description"
                        value="{{ old('description', $post->description) }}">
                    <trix-editor input="description"></trix-editor>
                </div>
                <button type="submit" class="btn btn-primary">Edit Post</button>
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

            function previewImage() {
                const image = document.querySelector('#image');
                const imgPreview = document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }

            // sub_categories hide/show
            (function() {
                // Get the category select element
                var categorySelect = document.querySelector('select[name="category_id"]');
                // Get the subcategory form container element
                var subCategoryFormContainer = document.querySelector('.sc');
                // Get the label for the subcategory form
                var subCategoryLabel = document.querySelector('.flsc');
                // Get the selected value of the category select element
                var selectedCategory = categorySelect.value;

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
            })();
        </script>
    </div>
@endsection
