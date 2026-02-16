<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')
        ->withCount('claps')
        ->orderBy('created_at', 'DESC')
        ->paginate(20);

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        $image = $data['image'];
        unset($data['image']);
        $data['user_id'] = auth()->user()->id;

        $imagePath = $image->store('post', 'public');
        $data['image'] = $imagePath;

        Post::create($data);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        //
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if($post->user_id != auth()->id()) {
            abort(403);
        }
        $categories = Category::get();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if($post->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validated();

        if (isset($data['image'])) {
            $image = $data['image'];
            unset($data['image']);
            $imagePath = $image->store('post', 'public');
            $data['image'] = $imagePath;
        }

        $post->update($data);
        return redirect()->route('myPosts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->user_id !== auth()->id()) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('myPosts');
    }

    public function category(Category $category) {
        $posts = $category->posts()
        ->with('user')->withCount('claps')
        ->latest()
        ->paginate(15);

        return view('post.index', compact('posts'));
    }

    public function followed() {
        $user = auth()->user();
        $query = Post::with('user')
        ->withCount('claps')
        ->latest()
        ->paginate(15);

        if ($user) {
            $followingIds = $user->following()->pluck('users.id');
            $query->where('user_id', $followingIds);
        }

        $posts = $query->paginate(20);
        return view('post.index', compact('posts'));
    }

    public function myPosts() {
        $user = auth()->user();

        $posts = $user->posts()->with('user')->withCount('claps')->latest()->paginate(5);

        return view('post.index', compact('posts'));
    }
}
