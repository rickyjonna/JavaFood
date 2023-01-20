@extends('dashboard.layouts.newindex')

@section('main')
    <div class="container ml-3">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit City</h1>
        </div>
        <div class="col-lg-8">
            <form method="Post" action="/dashboard/cities/{{ $city->slug }}" class="mb-5" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" required autofocus value="{{ old('name', $city->name) }}"
                        id="name"
                        class="form-control
                        @error('name')
                        is-invalid
                        @enderror">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" required value="{{ old('slug', $city->slug) }}"
                        {{-- more option : disabled readonly --}}
                        class="form-control
                            @error('slug')
                                is-invalid
                            @enderror">
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">City Image</label>
                    <input type="hidden" name="oldImage" value="{{ $city->image }}">
                    @if ($city->image)
                        <img src="{{ asset('storage/' . $city->image) }}"
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

                <button type="submit" class="btn btn-primary">Edit City</button>
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
    </script>
@endsection
