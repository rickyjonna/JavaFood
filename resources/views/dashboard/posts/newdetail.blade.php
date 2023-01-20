@extends('dashboard.layouts.newindex')

@section('main')
    <div class="row ml-4">
        <div class="col-lg-8">
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="h3 mb-0 text-Dar-800">{{ $post->name }}</h1>
            </div>
            <a href="/dashboard" class="btn btn-success"><span data-feather="arrow-left"
                    class="align-text-bottom"></span>Kembali</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"
                    class="align-text-bottom"></span> Ubah</a>
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"><span data-feather="x-circle"
                        class="align-text-bottom"></span> Hapus</button>
            </form>
            <div style="max-height:350px; overflow:hidden">
                @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="defaultimage" class="img-fluid mt-3">
                @else
                    <img src="/images/defaultimage.jpg" alt="defaultimage" class="img-fluid mt-3">
                @endif
            </div>

            <article class="my-3 fs-5">
                {!! $post->description !!}
            </article>

            {{-- category --}}
            <div class="container mt-3">
                <h5>Kategori :
                    <a href="/dashboard/posts?category={{ $post->category->slug }}">{{ $post->category->name }}
                    </a>
                </h5>
            </div>

            {{-- tags --}}
            <div class="container mt-3">
                <h5>Tags :
                    @foreach ($post->tags as $tag)
                        <a href="/tags/{{ $tag->slug }}">{{ $tag->name }},</a>
                    @endforeach
                </h5>
            </div>
        </div>
    </div>
@endsection
