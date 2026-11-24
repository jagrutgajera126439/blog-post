
@extends('layouts.app')

@section('title', 'Create Blog')

@section('header', 'Create New Blog')

@section('content')

<!-- PAGE HEADER -->
<div class="page-header">

    <div>
        <h1>Create New Blog ✍️</h1>
        <p>Share your thoughts and stories with the BlogSphere community.</p>
    </div>

    <a href="{{ route('user.blogs.index') }}" class="btn btn-primary">
        ← Back to My Blogs
    </a>

</div>

<!-- BLOG FORM CARD -->
<div class="content-card">

    <div class="section-header">
        <div>
            <h2>Blog Details</h2>
            <p>Fill in the information below to create your blog post.</p>
        </div>
    </div>

    <!-- VALIDATION ERRORS -->
    @if ($errors->any())
        <div class="alert-danger">
            <strong>Please fix the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- CREATE BLOG FORM -->
    <form action="{{ route('user.blogs.store') }}" method="POST">

        @csrf

        <!-- BLOG TITLE -->
        <div class="form-group">

            <label for="title">Blog Title</label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Enter your blog title"
                required
            >

        </div>

        <!-- AUTHOR -->
        <div class="form-group">

            <label for="author">Author Name</label>

            <input
                type="text"
                id="author"
                name="author"
                value="{{ old('author', auth()->user()->name) }}"
                placeholder="Enter author name"
                required
            >

        </div>

        <!-- CATEGORY -->
        <div class="form-group">

            <label for="category_id">Category</label>

            <select id="category_id" name="category_id" required>

                <option value="">Select a category</option>

                @foreach ($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <!-- BLOG CONTENT -->
        <div class="form-group">

            <label for="content">Blog Content</label>

            <textarea
                id="content"
                name="content"
                rows="8"
                placeholder="Write your blog content here..."
                required
            >{{ old('content') }}</textarea>

        </div>

        <!-- BLOG STATUS -->
        <div class="form-group">

            <label for="status">Blog Status</label>

            <select id="status" name="status" required>

                <option
                    value="draft"
                    {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}
                >
                    Draft
                </option>

                <option
                    value="published"
                    {{ old('status') == 'published' ? 'selected' : '' }}
                >
                    Published
                </option>

            </select>

        </div>

        <!-- FORM BUTTONS -->
        <div style="display:flex; gap:12px; flex-wrap:wrap;">

            <button type="submit" class="btn btn-primary">
                🚀 Create Blog
            </button>

            <a href="{{ route('user.blogs.index') }}" class="btn btn-danger">
                Cancel
            </a>

        </div>

    </form>

</div>

@endsection
