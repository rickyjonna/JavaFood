@extends('layouts.index')

@section('main')
    <h1 class="text-center mx-5 my-5">{{ $title }}</h1>
    @if ($posts->count())
        <div class="row row-cols-1 row-cols-md-3 ms-5 my-5">
            @foreach ($posts as $post)
                <div class="row mt-4">
                    <div class="card">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="defaultimage" class="card-img-top mt-2"
                                height="250" width="100%">
                        @else
                            <img src="/images/defaultimage.jpg" alt="defaultimage" class="card-img-top mt-2">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->name }}</h5>
                            <p class="card-text mb-auto">{{ substr($post->excerpt, 0, 100) }}....</p>
                            <p class="card-text">
                                @foreach ($post->tags as $tag)
                                    <a href="/tags/{{ $tag->slug }}">#{{ $tag->name }},</a>
                                @endforeach
                            </p>
                            <a href="/menu/{{ $post->slug }}" class="btn btn-primary">Lihat Menu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center fs-4">Tidak Ada Yang Ditemukan.</p>
    @endif
    <div class="container">
        {{ $posts->links() }}
        <a href="/menu" class="d-block mt-3 mb-3">Kembali ke Daftar Menu</a>
    </div>
@endsection
