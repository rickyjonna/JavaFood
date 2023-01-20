<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\City;
use App\Models\Sub_category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardPostController extends Controller
{
    public function index()
    {
        return view('dashboard.posts.newmenu', [
            "posts" => Post::latest()->filter(request(['search', 'category', 'city']))->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('dashboard.posts.newcreate', [
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'sub_categories' => Sub_category::all(),
            'cities' => City::all()
        ]);
    }

    public function store(Request $request)
    {
        //hubungkan storage - public
        //php artisan storage:link
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'city_id' => 'required',
            'image' => 'image|file|max:2048',
            'description' => 'required'
        ]);

        //tambah image
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        // tambah excerpt
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 200, '...');

        $post = Post::create($validatedData);

        // tambah pivot post_tag
        if($request->tags_id){
            $validatedData['tags_id'] = $request->tags_id;
            $post->tags()->attach($validatedData['tags_id']);
        }else{

        }

        // tambah pivot post_sub_category
        if($request->sub_categories_id){
            $validatedData['sub_categories_id'] = $request->sub_categories_id;
            $post->sub_categories()->attach($validatedData['sub_categories_id']);
        }else{
        }

        return redirect('/dashboard')->with('success', 'Menu Telah Ditambah');
    }

    public function show(Post $post)
    {
        return view('dashboard.posts.newdetail', [
            'post' => $post
        ]);
    }

    public function edit(Post $post)
    {
        return view ('dashboard.posts.newedit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'sub_categories' => Sub_category::all(),
            'cities' => City::all()
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $rules = [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'city_id' => 'required',
            'image' => 'image|file|max:2048',
            'description' => 'required'
        ];

        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 200, '...');
        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        Post::where('id', $post->id)->update($validatedData);
        $post->tags()->detach();
        $post->sub_categories()->detach();

        if($request->tags_id){
            $validatedData['tags_id'] = $request->tags_id;
            $post->tags()->attach($validatedData['tags_id']);
        }else{
        }

        if($request->sub_categories_id){
            $validatedData['sub_categories_id'] = $request->sub_categories_id;
            $post->sub_categories()->attach($validatedData['sub_categories_id']);
        }else{
        }

        return redirect('/dashboard')->with('success', 'Menu Telah Diubah');
    }

    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image);
        }

        // hapus semua row yang berelasi dengan tags dan sub_categories pada folder pivot
        $post->tags()->detach();
        $post->sub_categories()->detach();

        Post::destroy($post->id);
        return redirect('/dashboard')->with('success', 'Menu Telah Dihapus');
    }
}
