@extends('dashboard.layouts.index')

@section('main')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Tag</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/tags" class="mb-5" enctype="multipart/form-data">
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

            <button type="submit" class="btn btn-primary">Create Tag</button>
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
    </script>
@endsection
