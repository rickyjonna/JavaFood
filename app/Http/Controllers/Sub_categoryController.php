<?php

namespace App\Http\Controllers;

use App\Models\Sub_category;

class Sub_categoryController extends Controller
{
    public function index()
    {
        // belum ada view
        return view('sub_categories', [
            "sub_categories" => Sub_category::get()->all()
        ]);
    }

    public function show(Sub_category $sub_category)
    {
        $title = '';
        if (request('sub_category')) {
            $title = ' di : ' . $sub_category->name;
        }
        $posts = $sub_category->posts()->latest()->paginate(6);
        return view('menu', [
            "title" => "Semua Menu" . $title,
            "posts" => $posts
        ]);
    }
}
