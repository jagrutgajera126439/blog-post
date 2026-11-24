
@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')

<div class="page-header">
    <div>
        <h1>Edit Blog ✏️</h1>
        <p>Update your blog post details.</p>
    </div>

    <a href="{{ route('user.blogs.index') }}" class="btn btn-primary">
        ← Back to My Blogs
    </a>
</div>

<div class="content-card">
    <div class="section-header">
        <div>
            <h2>Update Blog Details</h2>
            <p>Make changes to your blog post below.</p>
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

    <form action="{{ route('user.blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Blog Title</label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="form-group">
            <label for="author">Author Name</label>
            <input type="text" id="author" name="author"
                   value="{{ old('author', $blog->author) }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="content">Blog Content</label>
            <textarea id="content" name="content" rows="8" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Blog Status</label>
            <select id="status" name="status" required>
                <option value="draft"
                    {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="published"
                    {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>
                    Published
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Update Blog
        </button>
    </form>
</div>

@endsection
