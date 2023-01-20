@extends('dashboard.layouts.newindex')

@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid py-1">

        @if (session()->has('success'))
            <div class="alert alert-success col-lg-6" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0 text-gray-800">Halo, Selamat Datang Admin!</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Makanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $posts->where('category_id', 1)->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons">ramen_dining</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Minuman</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $posts->where('category_id', 2)->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons">local_cafe</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Jajanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $posts->where('category_id', 3)->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons">lunch_dining</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row ">
            <div class="table-responsive col-md-9">
                <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Tambah Menu</a>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">City</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tableposts as $post)
                            <tr>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->city->name }}</td>
                                <td>
                                    <a href="/dashboard/posts/{{ $post->slug }}">
                                        <a class="btn btn-primary" href="/dashboard/posts/{{ $post->slug }}">
                                            Lihat
                                        </a>
                                    </a>
                                    <a href="/dashboard/posts/{{ $post->slug }}/edit">
                                        <a class="btn btn-warning" href="/dashboard/posts/{{ $post->slug }}/edit">
                                            Ubah
                                        </a>
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
                <br>
                <div class="col-md-11">
                    {{ $tableposts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
