@extends('dashboard.layouts.newindex')

@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid py-1">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">{{ $posts[0]->category->name }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="table-responsive col-md-9">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->name }}</td>
                                <td>
                                    <a href="/dashboard/posts/{{ $post->slug }}">
                                        <a class="btn btn-primary" href="/dashboard/posts/{{ $post->slug }}">
                                            Lihat
                                        </a>
                                    </a>
                                    <a class="btn btn-warning" href="/dashboard/posts/{{ $post->slug }}/edit">
                                        Ubah
                                    </a>
                                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button onclick="return confirm('Are You Sure?')" style="border: none"
                                            class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
