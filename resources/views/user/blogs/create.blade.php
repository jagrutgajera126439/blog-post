
@extends('layouts.app')

@section('title', 'Create Blog')

@section('content')

<div class="page-header">
    <div>
        <h1>Create New Blog ✍️</h1>
        <p>Share your thoughts and stories with the world.</p>
    </div>

    <a href="{{ route('user.blogs.index') }}" class="btn btn-primary">
        ← Back to My Blogs
    </a>
</div>

<div class="content-card">
    <div class="section-header">
        <div>
            <h2>Blog Details</h2>
            <p>Fill in the information below.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.blogs.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Blog Title</label>
            <input type="text" id="title" name="title"
                   value="{{ old('title') }}"
                   placeholder="Enter blog title" required>
        </div>

        <div class="form-group">
            <label for="author">Author Name</label>
            <input type="text" id="author" name="author"
                   value="{{ old('author', auth()->user()->name) }}"
                   placeholder="Enter author name" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                <option value="">Select Category</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="content">Blog Content</label>
            <textarea id="content" name="content" rows="8"
                      placeholder="Write your blog here..."
                      required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Blog Status</label>
            <select id="status" name="status" required>
                <option value="draft"
                    {{ old('status') == 'draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="published"
                    {{ old('status') == 'published' ? 'selected' : '' }}>
                    Published
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Create Blog
        </button>
    </form>
</div>

@endsection
