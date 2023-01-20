<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.newhome',[
            'posts' => Post::all(),
            'tableposts' => Post::latest()->paginate(5)->withQueryString()
        ]);
    }
}
