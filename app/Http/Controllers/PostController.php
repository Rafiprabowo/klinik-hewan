<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Post;
use Carbon\Carbon;
use Creativeorange\Gravatar\Facades\Gravatar;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avatar = Gravatar::get(auth()->user()->email);
        $title = 'Post';
        $post = Post::all();
        return view('dashboard.author.post.index', [
            'avatar' => $avatar,
            'page_title' => $title,
            'post' => $post
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Categories::all();
        $avatar = Gravatar::get(auth()->user()->email);
        $title = 'Create Post';
        return view('dashboard.author.post.create', [
            'avatar' => $avatar,
            'page_title' => $title,
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO : Create Validation
        $category = $request->id_category;
        $id_category_array = array_map('intval', explode(',', $category));

        $data = [
            'slug' => $request->slug,
            'title' => $request->title,
            'body' => $request->body,
            'author_id' => auth()->user()->id,
            'published_at' => Carbon::now(),
        ];

        Post::create($data);
        $data_id = Post::latest()->first()->id;
        $new_category_relation = [
            'post_id' => $data_id,
            'category_id' => $category
        ];
        return redirect()->route('post.create-new-post', [
            'post_id' => $new_category_relation['post_id'],
            'category_id' => $new_category_relation['category_id']
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
