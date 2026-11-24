<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Total blogs created by logged-in user
        $totalBlogs = Blog::where('user_id', $userId)->count();

        // Published blogs
        $publishedBlogs = Blog::where('user_id', $userId)
            ->where('status', 'published')
            ->count();

        // Draft blogs
        $draftBlogs = Blog::where('user_id', $userId)
            ->where('status', 'draft')
            ->count();

        // Latest 5 blogs
        $recentBlogs = Blog::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'totalBlogs',
            'publishedBlogs',
            'draftBlogs',
            'recentBlogs'
        ));
    }
}
