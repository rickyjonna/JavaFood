@extends('layouts.index')

@section('main')
    <h1 class="text-center mx-5 my-5">Daftar Kota</h1>
    <div class="row row-cols-1 row-cols-md-3 ms-5 my-5">
        @foreach ($cities as $city)
            <div class="row mt-4">
                <div class="card">
                    @if ($city->image)
                        <img src="{{ asset('storage/' . $city->image) }}" alt="defaultimage" class="card-img-top mt-2"
                            height="250" width="100%">
                    @else
                        <img src="/images/defaultimage.jpg" alt="defaultimage" class="card-img-top mt-2">
                    @endif
                    <div class="card-body">
                        <a href="/menu?city={{ $city->slug }}">{{ $city->name }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
