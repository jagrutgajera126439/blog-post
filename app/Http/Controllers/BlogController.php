<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalBlogs = Blog::count();

        $publishedBlogs = Blog::where('status', 'published')->count();

        $draftBlogs = Blog::where('status', 'draft')->count();

        $totalCategories = Category::count();

        $recentBlogs = Blog::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBlogs',
            'publishedBlogs',
            'draftBlogs',
            'totalCategories',
            'recentBlogs'
        ));
    }

    // Display all blogs with search, filters and pagination
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $status = $request->input('status');

        $blogs = Blog::with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('author', 'like', '%' . $search . '%');
                });
            })
            ->when($category, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('blogs.index', compact(
            'blogs',
            'search',
            'categories',
            'category',
            'status'
        ));
    }

    // Show create blog form
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('blogs.create', compact('categories'));
    }

    // Save new blog
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        Blog::create($validated);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    // Show edit blog form
    public function edit(Blog $blog)
    {
        $categories = Category::orderBy('name')->get();

        return view('blogs.edit', compact('blog', 'categories'));
    }

    // Update blog
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $blog->update($validated);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    // Delete blog
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}
