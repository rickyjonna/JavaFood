@extends('layouts.index')

@section('main')
    <div class="container text-center py-5">
        <h1>{{ $post->name }}</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                {{-- image --}}
                <div class="container text-center mb-5">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="defaultimage" class="img-fluid">
                    @else
                        <img src="/images/defaultimage.jpg" alt="defaultimage" class="img-fluid">
                    @endif
                </div>
                {{-- tags --}}
                <article class="my-3 fs-5">
                    {!! $post->description !!}
                </article>
                <br>
                {{-- category --}}
                <div class="container">
                    <h5>Kategori :
                        <a href="/menu?{{ $post->category->slug }}">{{ $post->category->name }}
                        </a>
                    </h5>
                </div>
                <div class="container">
                    <h5>Tags :
                        @foreach ($post->tags as $tag)
                            <a href="/tags/{{ $tag->slug }}">{{ $tag->name }},</a>
                        @endforeach
                    </h5>
                </div>
                <div class="position-relative mt-5">
                    <a href="/menu" class="btn btn-primary position-absolute bottom-0 end-0">Kembali ke Daftar Menu</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col">
                @if ($posts->count())
                    <hr>
                    <h3 class="ms-3 pt-3">Menu Lainnya :
                    </h3>
                    <div class="row row-cols-1 row-cols-md-3 ms-3 my-3">
                        @foreach ($posts as $post)
                            <div class="row mt-4">
                                <div class="card">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="defaultimage"
                                            class="card-img-top mt-2" width="100%" height="250">
                                    @else
                                        <img src="/images/defaultimage.jpg" alt="defaultimage" class="card-img-top mt-2">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->name }}</h5>
                                        <p class="card-text mb-auto">{{ substr($post->excerpt, 0, 70) }}....</p>
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
                @endif
            </div>
        </div>
    </div>
@endsection
