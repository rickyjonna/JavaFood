@extends('dashboard.layouts.newindex')

@section('main')
    <div class="container-fluid py-1">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between px-3 mb-3">
            <h1 class="h3 mb-0 text-gray-800">Cities</h1>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive col-lg-8">
            <a href="/dashboard/cities/create" class="btn btn-primary mb-4">Tambah Kota</a>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $city->name }}</td>
                            <td>
                                <a class="btn btn-warning" href="/dashboard/cities/{{ $city->slug }}/edit">
                                    Ubah
                                </a>
                                <form action="/dashboard/cities/{{ $city->slug }}" method="POST" class="d-inline ">
                                    @method('delete')
                                    @csrf
                                    <button class="btn
                                    btn-danger"
                                        onclick="return confirm('Are You Sure?')" style="border: none">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
