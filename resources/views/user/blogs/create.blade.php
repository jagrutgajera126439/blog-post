
@extends('layouts.app')

@section('title', 'Create Blog')

@section('header', 'Create New Blog')

@section('content')

<style>
    .user-blog-page {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
    }

    .user-blog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .user-blog-header h1 {
        color: #172554;
        font-size: 28px;
        margin: 0 0 8px;
    }

    .user-blog-header p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .user-blog-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    }

    .user-blog-card h2 {
        color: #172554;
        font-size: 21px;
        margin: 0 0 8px;
    }

    .user-blog-description {
        color: #64748b;
        font-size: 14px;
        margin: 0 0 25px;
    }

    .user-form-group {
        margin-bottom: 22px;
    }

    .user-form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 9px;
    }

    .user-form-group input,
    .user-form-group select,
    .user-form-group textarea {
        display: block;
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #dbe1ea;
        border-radius: 8px;
        background: #ffffff;
        color: #1e293b;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        transition: 0.2s;
    }

    .user-form-group input:focus,
    .user-form-group select:focus,
    .user-form-group textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
    }

    .user-form-group textarea {
        min-height: 190px;
        resize: vertical;
        line-height: 1.6;
    }

    .user-form-buttons {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 28px;
    }

    .user-save-btn,
    .user-cancel-btn,
    .user-back-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .user-save-btn {
        background: #2563eb;
        color: #ffffff;
    }

    .user-save-btn:hover {
        background: #1d4ed8;
    }

    .user-cancel-btn,
    .user-back-btn {
        background: #e2e8f0;
        color: #334155;
    }

    .user-cancel-btn:hover,
    .user-back-btn:hover {
        background: #cbd5e1;
    }

    .user-form-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 22px;
    }

    .user-form-error ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    @media (max-width: 600px) {
        .user-blog-card {
            padding: 20px;
        }

        .user-blog-header h1 {
            font-size: 23px;
        }

        .user-save-btn,
        .user-cancel-btn,
        .user-back-btn {
            width: 100%;
        }
    }
</style>

<div class="user-blog-page">

    <!-- PAGE HEADER -->
    <div class="user-blog-header">

        <div>
            <h1>Create New Blog ✍️</h1>
            <p>Share your thoughts with the BlogSphere community.</p>
        </div>

        <a href="{{ route('user.blogs.index') }}" class="user-back-btn">
            ← Back to My Blogs
        </a>

    </div>

    <!-- FORM CARD -->
    <div class="user-blog-card">

        <h2>Blog Details</h2>

        <p class="user-blog-description">
            Fill in the information below to create your blog post.
        </p>

        <!-- VALIDATION ERRORS -->
        @if ($errors->any())

            <div class="user-form-error">

                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif

        <!-- USER CREATE BLOG FORM -->
        <form action="{{ route('user.blogs.store') }}" method="POST">

            @csrf

            <!-- BLOG TITLE -->
            <div class="user-form-group">

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
            <div class="user-form-group">

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
            <div class="user-form-group">

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
            <div class="user-form-group">

                <label for="content">Blog Content</label>

                <textarea
                    id="content"
                    name="content"
                    placeholder="Write your blog content here..."
                    required
                >{{ old('content') }}</textarea>

            </div>

            <!-- BLOG STATUS -->
            <div class="user-form-group">

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

            <!-- BUTTONS -->
            <div class="user-form-buttons">

                <button type="submit" class="user-save-btn">
                    🚀 Create Blog
                </button>

                <a href="{{ route('user.blogs.index') }}" class="user-cancel-btn">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
