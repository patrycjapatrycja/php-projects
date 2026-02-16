<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class PublicProfileController extends Controller
{
    public function show(User $user) {
        $posts = $user->posts()->where('published_at', '<=', now())->latest()->paginate();

        $followers = $user->followers;

        return view('profile.show', compact('user', 'posts'));
    }
}
