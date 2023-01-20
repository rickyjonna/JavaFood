<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' di : ' . $category->name;
        }

        if (request('city')) {
            $city = City::firstWhere('slug', request('city'));
            $title = ' di : ' . $city->name;
        }

        return view('menu', [
            "title" => "Semua Menu" . $title,
            "posts" => Post::latest()->filter(request(['search', 'category', 'city']))->paginate(6)->withQueryString()
        ]);
    }


        public function show(Post $post)
    {
        $category_id = $post->category->id;
        return view('detail', [
            "title" => "Single Post",
            "posts" => Post::where('category_id','=', $category_id)->take(3)->get(),
            "post" => $post
        ]);
    }

}
