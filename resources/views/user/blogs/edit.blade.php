
@extends('layouts.app')

@section('title', 'Edit Blog')
@section('header', 'Edit Blog')

@section('content')

<style>
    .edit-page {
        max-width: 950px;
        margin: 0 auto;
    }

    .edit-heading {
        margin-bottom: 25px;
    }

    .edit-heading h1 {
        font-size: 28px;
        color: #1e293b;
        margin: 0 0 8px;
    }

    .edit-heading p {
        color: #64748b;
        margin: 0;
    }

    .edit-card {
        background: #fff;
        padding: 32px;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.06);
        border: 1px solid #e8edf5;
    }

    .edit-card h2 {
        color: #1e293b;
        font-size: 21px;
        margin: 0 0 8px;
    }

    .edit-description {
        color: #64748b;
        margin: 0 0 28px;
    }

    .edit-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        color: #334155;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 9px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #dbe2ea;
        border-radius: 8px;
        background: #fff;
        color: #1e293b;
        font-size: 14px;
        outline: none;
        transition: 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
    }

    .form-group textarea {
        min-height: 220px;
        resize: vertical;
        line-height: 1.7;
    }

    .error-box {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 14px 18px;
        border-radius: 9px;
        margin-bottom: 22px;
    }

    .error-box ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    .edit-buttons {
        display: flex;
        gap: 12px;
        margin-top: 8px;
        flex-wrap: wrap;
    }

    .edit-btn {
        display: inline-block;
        padding: 12px 22px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .update-btn {
        background: #2563eb;
        color: #fff;
    }

    .update-btn:hover {
        background: #1d4ed8;
    }

    .back-btn {
        background: #e2e8f0;
        color: #334155;
    }

    .back-btn:hover {
        background: #cbd5e1;
    }

    @media (max-width: 650px) {
        .edit-card {
            padding: 20px;
        }

        .edit-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .form-group.full {
            grid-column: auto;
        }

        .edit-btn {
            text-align: center;
            flex: 1;
        }
    }
</style>

<div class="edit-page">

    <div class="edit-heading">
        <h1>✏️ Edit Blog</h1>
        <p>Update your blog post information and keep your content fresh.</p>
    </div>

    <div class="edit-card">

        <h2>Update Blog Details</h2>
        <p class="edit-description">Make changes to your blog post below.</p>

        @if ($errors->any())
            <div class="error-box">
                <strong>Please fix the following errors:</strong>
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

            <div class="edit-grid">

                <div class="form-group">
                    <label for="title">Blog Title</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $blog->title) }}"
                        placeholder="Enter your blog title"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="author">Author Name</label>
                    <input
                        type="text"
                        id="author"
                        name="author"
                        value="{{ old('author', $blog->author) }}"
                        placeholder="Enter author name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" required>
                        <option value="">Select a category</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Blog Status</label>
                    <select id="status" name="status" required>
                        <option value="published"
                            {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>
                            Published
                        </option>

                        <option value="draft"
                            {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>
                    </select>
                </div>

                <div class="form-group full">
                    <label for="content">Blog Content</label>
                    <textarea
                        id="content"
                        name="content"
                        placeholder="Write your blog content here..."
                        required
                    >{{ old('content', $blog->content) }}</textarea>
                </div>

            </div>

            <div class="edit-buttons">
                <button type="submit" class="edit-btn update-btn">
                    💾 Update Blog
                </button>

                <a href="{{ route('user.blogs.index') }}" class="edit-btn back-btn">
                    ← Back to Blogs
                </a>
            </div>

        </form>
    </div>
</div>

@endsection
