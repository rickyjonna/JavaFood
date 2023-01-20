<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        // belum ada view
        return view('tags', [
            "tags" => Tag::get()->all()
        ]);
    }

    public function show(Tag $tag)
    {
        $title = '';
        if (request('tag')) {
            $title = ' di : ' . $tag->name;
        }
        $posts = $tag->posts()->latest()->paginate(6);
        return view('menu', [
            "title" => "Semua Menu" . $title,
            "posts" => $posts
        ]);
    }
}
