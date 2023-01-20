<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardCityController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardTagController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Sub_categoryController;
use App\Http\Controllers\TagController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home',[
        'posts' => Post::all()
    ]);
});

Route::get('/menu', [PostController::class, 'index']);

Route::get('/menu/{post:slug}', [PostController::class, 'show']);

Route::get('/cities', [CityController::class, 'index']);

//tidak dibuat viewnya, hanya jaga2 jika dibutuhkan
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/tags', [TagController::class, 'index']);
Route::get('/sub_categories', [Sub_categoryController::class, 'index']);

//N+1 belum di cek (clockwork rusak)
Route::get('/tags/{tag:slug}', [TagController::class, 'show']);
Route::get('/sub_categories/{sub_category:slug}', [Sub_categoryController::class, 'show']);

Route::get('/about', function () {
    return view('about');
});

//middleware guest : bisa diakses oleh yang belum login
//pelanggar dilempar ke / , defaultnya diubah di app-providers-routeserviceproviders
//route login diberi nama login agar middleware auth dilempar kesini cek app-http-middleware-auth
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

//middleware auth : bisa diakses oleh yang sudah login
//pelanggar dilempar ke login (defaultnya cek di app-http-middleware-authenticate)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

//sebelum menggunakan route resource, route keynya diubah dulu di model (defaultnya id->slug)
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/cities', DashboardCityController::class)->middleware('auth');

Route::resource('/dashboard/categories', DashboardCategoryController::class)->middleware('auth');

Route::resource('/dashboard/tags', DashboardTagController::class)->middleware('auth');
