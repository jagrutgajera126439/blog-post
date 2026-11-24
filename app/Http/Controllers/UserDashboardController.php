<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalBlogs = Blog::where('user_id', $userId)->count();

        $publishedBlogs = Blog::where('user_id', $userId)
            ->where('status', 'published')
            ->count();

        $draftBlogs = Blog::where('user_id', $userId)
            ->where('status', 'draft')
            ->count();

        return view('user.dashboard', compact(
            'totalBlogs',
            'publishedBlogs',
            'draftBlogs'
        ));
    }
}
