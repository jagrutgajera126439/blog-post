
@extends('layouts.app')

@section('title', 'All Blogs')

@section('header', 'All Blog Posts')

@section('content')

<style>
    .all-blogs-page {
        width: 100%;
    }

    .blogs-heading {
        margin-bottom: 25px;
    }

    .blogs-heading h1 {
        color: #243247;
        margin: 0 0 8px;
        font-size: 27px;
    }

    .blogs-heading p {
        color: #777;
        margin: 0;
    }

    .blogs-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 22px;
    }

    .blogs-filter {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        flex: 1;
    }

    .blogs-filter input,
    .blogs-filter select {
        padding: 11px;
        border: 1px solid #d5dbe3;
        border-radius: 7px;
        background: white;
        font-size: 14px;
    }

    .blogs-filter input {
        min-width: 200px;
        flex: 1;
    }

    .blogs-filter button,
    .blogs-filter a,
    .blogs-add-btn {
        display: inline-block;
        padding: 11px 16px;
        border: none;
        border-radius: 7px;
        color: white;
        text-decoration: none;
        cursor: pointer;
        font-size: 14px;
    }

    .blogs-search-btn {
        background: #2563eb;
    }

    .blogs-reset-btn {
        background: #64748b;
    }

    .blogs-add-btn {
        background: #16a34a;
        white-space: nowrap;
    }

    .blog-view-card {
        background: white;
        padding: 23px;
        margin-bottom: 18px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .blog-view-card h2 {
        margin: 0 0 12px;
        color: #243247;
    }

    .blog-meta {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .blog-badges {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin: 12px 0;
    }

    .blog-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .blog-category {
        background: #e0e7ff;
        color: #3730a3;
    }

    .blog-published {
        background: #dcfce7;
        color: #166534;
    }

    .blog-draft {
        background: #fef3c7;
        color: #92400e;
    }

    .blog-description {
        line-height: 1.7;
        color: #444;
        margin-bottom: 15px;
    }

    .blog-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .blog-edit-btn,
    .blog-delete-btn {
        padding: 9px 15px;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 13px;
    }

    .blog-edit-btn {
        background: #2563eb;
    }

    .blog-delete-btn {
        background: #dc2626;
    }

    .blog-empty {
        background: white;
        padding: 35px;
        text-align: center;
        border-radius: 10px;
    }

    .blog-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 25px;
        padding: 14px 18px;
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .pagination-summary {
        margin: 0;
        color: #64748b;
        font-size: 14px;
    }

    .pagination-controls {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pagination-link,
    .pagination-disabled,
    .pagination-page {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 8px 13px;
        border: 1px solid #dbe2ea;
        border-radius: 7px;
        font-size: 14px;
        text-decoration: none;
    }

    .pagination-link {
        background: #ffffff;
        color: #1d4ed8;
        font-weight: 600;
    }

    .pagination-link:hover {
        background: #eff6ff;
        border-color: #93c5fd;
    }

    .pagination-disabled {
        background: #f8fafc;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .pagination-page {
        border-color: transparent;
        color: #334155;
        font-weight: 600;
        white-space: nowrap;
    }

    @media (max-width: 600px) {
        .blog-pagination {
            justify-content: center;
        }

        .pagination-summary {
            width: 100%;
            text-align: center;
        }

        .pagination-controls {
            justify-content: center;
            flex-wrap: wrap;
        }
        .blogs-filter {
            flex-direction: column;
            width: 100%;
        }

        .blogs-filter input,
        .blogs-filter select,
        .blogs-filter button,
        .blogs-filter a,
        .blogs-add-btn {
            width: 100%;
            text-align: center;
        }

        .blog-view-card {
            padding: 17px;
        }
    }
</style>

<div class="all-blogs-page">

    <div class="blogs-heading">
        <h1>📝 All Blog Posts</h1>
        <p>View and manage blog posts from all users.</p>
    </div>

    <div class="blogs-toolbar">

        <form action="{{ route('blogs.index') }}"
              method="GET"
              class="blogs-filter">

            <input
                type="text"
                name="search"
                placeholder="Search by title or author..."
                value="{{ $search ?? '' }}"
            >

            <select name="category">
                <option value="">All Categories</option>

                @foreach($categories as $item)
                    <option
                        value="{{ $item->id }}"
                        {{ (string)($category ?? '') === (string)$item->id ? 'selected' : '' }}
                    >
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>

            <select name="status">
                <option value="">All Status</option>

                <option value="published"
                    {{ ($status ?? '') === 'published' ? 'selected' : '' }}>
                    Published
                </option>

                <option value="draft"
                    {{ ($status ?? '') === 'draft' ? 'selected' : '' }}>
                    Draft
                </option>
            </select>

            <button type="submit" class="blogs-search-btn">
                Apply Filters
            </button>

            <a href="{{ route('blogs.index') }}" class="blogs-reset-btn">
                Reset
            </a>

        </form>

        <a href="{{ route('blogs.create') }}" class="blogs-add-btn">
            + Add Blog
        </a>

    </div>

    @forelse($blogs as $blog)

        <div class="blog-view-card">

            <h2>{{ $blog->title }}</h2>

            <div class="blog-meta">
                <strong>Author:</strong> {{ $blog->author }}
                &nbsp; | &nbsp;
                <strong>Account:</strong> {{ $blog->user?->name ?? 'Unknown / Deleted User' }}
                &nbsp; | &nbsp;
                <strong>Created:</strong> {{ $blog->created_at->format('d M Y') }}
            </div>

            <div class="blog-badges">

                @if($blog->category)
                    <span class="blog-badge blog-category">
                        {{ $blog->category->name }}
                    </span>
                @endif

                <span class="blog-badge {{ $blog->status === 'published' ? 'blog-published' : 'blog-draft' }}">
                    {{ ucfirst($blog->status) }}
                </span>

            </div>

            <p class="blog-description">
                {{ \Illuminate\Support\Str::limit($blog->content, 220) }}
            </p>

            <div class="blog-actions">

                <a href="{{ route('blogs.edit', $blog->id) }}"
                   class="blog-edit-btn">
                    Edit
                </a>

                <form action="{{ route('blogs.destroy', $blog->id) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this blog?');">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="blog-delete-btn">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="blog-empty">
            <h3>No blog posts found.</h3>
            <p>Try changing your search or filters, or create a new blog post.</p>
        </div>

    @endforelse

    @if($blogs->hasPages())
        <nav class="blog-pagination" aria-label="Blog pagination">
            <p class="pagination-summary">
                Showing {{ $blogs->firstItem() }} to {{ $blogs->lastItem() }} of {{ $blogs->total() }} results
            </p>

            <div class="pagination-controls">
                @if($blogs->onFirstPage())
                    <span class="pagination-disabled" aria-disabled="true">← Previous</span>
                @else
                    <a class="pagination-link" href="{{ $blogs->previousPageUrl() }}" rel="prev">← Previous</a>
                @endif

                <span class="pagination-page">Page {{ $blogs->currentPage() }} of {{ $blogs->lastPage() }}</span>

                @if($blogs->hasMorePages())
                    <a class="pagination-link" href="{{ $blogs->nextPageUrl() }}" rel="next">Next →</a>
                @else
                    <span class="pagination-disabled" aria-disabled="true">Next →</span>
                @endif
            </div>
        </nav>
    @endif

</div>

@endsection
