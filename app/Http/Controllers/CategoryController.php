<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display all categories
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    // Show create category form
    public function create()
    {
        return view('categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully!');
    }

    // Show edit category form
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy(Category $category)
    {
        if (Blog::where('category_id', $category->id)->exists()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'This category is assigned to blog posts. Reassign those posts before deleting it.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
