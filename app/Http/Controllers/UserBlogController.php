<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    // Display Only Logged-in User's Blogs
    public function index()
    {
        $blogs = auth()->user()
            ->blogs()
            ->with('category')
            ->latest()
            ->paginate(5);

        return view('user.blogs.index', compact('blogs'));
    }

    // Show Create Blog Form
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('user.blogs.create', compact('categories'));
    }

    // Save New Blog
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        auth()->user()->blogs()->create($validated);

        return redirect()
            ->route('user.blogs.index')
            ->with('success', 'Your blog was created successfully!');
    }

    // Show Edit Blog Form
    public function edit($id)
    {
        $blog = auth()->user()->blogs()->findOrFail($id);

        $categories = Category::orderBy('name')->get();

        return view('user.blogs.edit', compact('blog', 'categories'));
    }

    // Update Own Blog
    public function update(Request $request, $id)
    {
        $blog = auth()->user()->blogs()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $blog->update($validated);

        return redirect()
            ->route('user.blogs.index')
            ->with('success', 'Your blog was updated successfully!');
    }

    // Delete Own Blog
    public function destroy($id)
    {
        $blog = auth()->user()->blogs()->findOrFail($id);

        $blog->delete();

        return redirect()
            ->route('user.blogs.index')
            ->with('success', 'Your blog was deleted successfully!');
    }
}
