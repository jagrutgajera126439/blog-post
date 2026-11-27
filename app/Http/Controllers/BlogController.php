<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        $totalBlogs = Blog::count();

        $publishedBlogs = Blog::where('status', 'published')->count();

        $draftBlogs = Blog::where('status', 'draft')->count();

        $totalCategories = Category::count();

        $registeredUsers = User::where('role', 'user')
            ->withCount('blogs')
            ->with(['blogs' => function ($query) {
                $query->with('category')->latest();
            }])
            ->orderBy('name')
            ->get();

        return view('dashboard', compact(
            'totalBlogs',
            'publishedBlogs',
            'draftBlogs',
            'totalCategories',
            'registeredUsers'
        ));
    }

    // All Blogs is read-only; editing is available on the separate Manage Blogs page.
    public function index(Request $request)
    {
        return $this->blogList($request, false);
    }

    public function manage(Request $request)
    {
        return $this->blogList($request, true);
    }

    private function blogList(Request $request, bool $canManage)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $status = $request->input('status');

        $blogs = Blog::with(['category', 'user'])
            ->when($search, function ($query, $search) use ($canManage) {
                $query->where(function ($q) use ($search, $canManage) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('author', 'like', '%' . $search . '%');

                    if ($canManage) {
                        $q->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%');
                        });
                    }
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
            'status',
            'canManage'
        ));
    }

    // Show Create Blog Form
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('blogs.create', compact('categories'));
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

        // Admin-created blog is assigned to the admin
        $validated['user_id'] = auth()->id();

        Blog::create($validated);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog post created successfully!');
    }

    // Show Edit Blog Form
    public function edit(Blog $blog)
    {
        $categories = Category::orderBy('name')->get();

        return view('blogs.edit', compact('blog', 'categories'));
    }

    // Update Any Blog
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        // Keep the original blog owner unchanged
        $blog->update($validated);

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog post updated successfully!');
    }

    // Delete Any Blog
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}
