@extends('layouts.index')

@section('main')
    {{-- Carousel --}}
    <div bg-dark>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/bg.jpg" alt="..." height="600" width="100%">
                    <div class="carousel-caption d-none d-md-block col-md-5 p-lg-5 mx-auto my-5" style="color: red">
                        <h1 class="display-4 fw-normal">Selamat Datang!</h1>
                        <p class="lead fw-normal">JavaFood Website menyajikan berbagai macam resep makanan dan minuman khas
                            daerah jawa tengah</p>
                        <form action="/menu" class="d-flex mt-3 mt-lg-0" role="search">
                            <button class="invisible" type="submit">Search</button>
                            <input class="form-control me-5" type="search" placeholder="Search" aria-label="Search"
                                name="search">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cards --}}
    <div class="container px-4 py-5">
        <h2 class="pb-2 border-bottom">Jumlah Menu</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-50">
                    <img src="images/food1.jpg" class="card-img-top" alt="..." height="230">
                    <div class="card-body">
                        <h5 class="card-title">Makanan</h5>
                        <h3>{{ $posts->where('category_id', 1)->count() }}</h3>
                    </div>
                    <div class="card-footer">
                        <a href="/menu?category=makanan" class="btn btn-danger">Lihat Menu</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-50">
                    <img src="images/wedang.jpg" class="card-img-top" alt="..." height="230">
                    <div class="card-body">
                        <h5 class="card-title">Minuman</h5>
                        <h3>{{ $posts->where('category_id', 2)->count() }}</h3>
                    </div>
                        <div class="card-footer">
                            <a href="/menu?category=minuman" class="btn btn-danger">Lihat Menu</a>
                        </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-50">
                    <img src="images/snack.jpg" class="card-img-top" alt="..." height="230">
                    <div class="card-body">
                        <h5 class="card-title">Jajanan</h5>
                        <h3>{{ $posts->where('category_id', 3)->count() }}</h3>
                    </div>
                        <div class="card-footer">
                            <a href="/menu?category=lainnya" class="btn btn-danger">Lihat Menu</a>
                        </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Carousel --}}
    {{-- <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/khas.jpg" class="d-block w-100" alt="..." height="650" >
                <div class="carousel-caption d-none d-md-block">
                    <h5>Next Slide</h5>
                    <p>Temukan berbagai macam resep makanan dan minuman</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/menu1.jpg" class="d-block w-100" alt="..." height="650">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Next Slide</h5>
                    <p>Memudahkan pengguna mencari resep kuliner khas jawa tengah</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/test.jpg" class="d-block w-100" alt="..." height="650">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Next Slide</h5>
                    <p>Mari lestarikan masakan indonesia</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> --}}
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/menu1.jpg" alt="menu1" preserveAspectRatio="xMidYMid slice" focusable="false"
                    class="bd-placeholder-img" width="100%" height="650">

                <div class="container">
                    <div class="carousel-caption">
                        <h5>Next Slide</h5>
                        <p>Temukan berbagai macam resep makanan dan minuman</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/menu2.jpeg" alt="menu1" preserveAspectRatio="xMidYMid slice" focusable="false"
                    class="bd-placeholder-img" width="100%" height="650">

                <div class="container">
                    <div class="carousel-caption">
                        <h5>Next Slide</h5>
                        <p>Mari lestarikan masakan indonesia</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/menu3.jpeg" alt="menu1" preserveAspectRatio="xMidYMid slice" focusable="false"
                    class="bd-placeholder-img" width="100%" height="650">

                <div class="container">
                    <div class="carousel-caption">
                        <h5>Next Slide</h5>
                        <p>Memudahkan pengguna mencari resep kuliner khas jawa tengah</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
