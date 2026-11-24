
@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('header', 'Admin Dashboard')

@section('content')

<style>
    .welcome {
        margin-bottom: 28px;
    }

    .welcome h1 {
        font-size: 30px;
        color: #172554;
        margin-bottom: 10px;
    }

    .welcome p {
        color: #64748b;
        font-size: 15px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: white;
        padding: 24px;
        border-radius: 14px;
        border: 1px solid #e8edf5;
        box-shadow: 0 4px 15px rgba(0,0,0,.04);
    }

    .stat-icon {
        font-size: 28px;
        margin-bottom: 12px;
    }

    .stat-number {
        font-size: 30px;
        font-weight: 800;
        color: #172554;
    }

    .stat-name {
        color: #64748b;
        font-size: 14px;
        margin-top: 5px;
    }

    .section {
        background: white;
        padding: 25px;
        border-radius: 14px;
        border: 1px solid #e8edf5;
        box-shadow: 0 4px 15px rgba(0,0,0,.04);
        margin-bottom: 24px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }

    .section-header h2 {
        font-size: 19px;
        color: #172554;
    }

    .view-btn {
        color: #2563eb;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .blog-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        padding: 17px 0;
        border-bottom: 1px solid #edf0f5;
    }

    .blog-row:last-child {
        border-bottom: none;
    }

    .blog-title {
        font-weight: 600;
        color: #263247;
        overflow-wrap: anywhere;
    }

    .blog-info {
        color: #8993a4;
        font-size: 13px;
        margin-top: 6px;
    }

    .badge {
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .published {
        background: #dcfce7;
        color: #166534;
    }

    .draft {
        background: #fef3c7;
        color: #92400e;
    }

    .empty {
        text-align: center;
        padding: 30px;
        color: #64748b;
    }

    .quick-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .action-btn {
        display: inline-block;
        padding: 12px 17px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .create {
        background: #2563eb;
        color: white;
    }

    .manage {
        background: #edf2f8;
        color: #263247;
    }

    @media (max-width: 1000px) {
        .stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 550px) {
        .stats {
            grid-template-columns: 1fr;
        }

        .welcome h1 {
            font-size: 24px;
        }

        .section {
            padding: 17px;
        }

        .quick-actions {
            flex-direction: column;
        }

        .action-btn {
            text-align: center;
        }

        .blog-row {
            align-items: flex-start;
        }
    }
</style>

<!-- WELCOME -->
<div class="welcome">
    <h1>👋 Welcome, {{ auth()->user()->name }}!</h1>
    <p>Manage all blog posts, categories, and publication status.</p>
</div>

<!-- STATISTICS -->
<div class="stats">

    <div class="stat-card">
        <div class="stat-icon">📚</div>
        <div class="stat-number">{{ $totalBlogs }}</div>
        <div class="stat-name">Total Blogs</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🟢</div>
        <div class="stat-number">{{ $publishedBlogs }}</div>
        <div class="stat-name">Published</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📝</div>
        <div class="stat-number">{{ $draftBlogs }}</div>
        <div class="stat-name">Drafts</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🗂️</div>
        <div class="stat-number">{{ $totalCategories }}</div>
        <div class="stat-name">Categories</div>
    </div>

</div>

<!-- RECENT BLOGS -->
<section class="section">

    <div class="section-header">
        <h2>🕒 Recent Blog Posts</h2>
        <a href="{{ route('blogs.index') }}" class="view-btn">
            View All →
        </a>
    </div>

    @if($recentBlogs->count() > 0)

        @foreach($recentBlogs as $blog)

            <div class="blog-row">

                <div>
                    <div class="blog-title">{{ $blog->title }}</div>

                    <div class="blog-info">
                        By {{ $blog->author }}

                        @if($blog->category)
                            · {{ $blog->category->name }}
                        @endif

                        · {{ $blog->created_at->format('d M Y') }}
                    </div>
                </div>

                @if($blog->status === 'published')
                    <span class="badge published">Published</span>
                @else
                    <span class="badge draft">Draft</span>
                @endif

            </div>

        @endforeach

    @else

        <div class="empty">
            <p>No blog posts have been created yet.</p>
            <a href="{{ route('blogs.create') }}" class="view-btn">
                Create a blog →
            </a>
        </div>

    @endif

</section>

<!-- QUICK ACTIONS -->
<section class="section">

    <div class="section-header">
        <h2>⚡ Quick Actions</h2>
    </div>

    <div class="quick-actions">

        <a href="{{ route('blogs.create') }}" class="action-btn create">
            + Create Blog
        </a>

        <a href="{{ route('blogs.index') }}" class="action-btn manage">
            📚 Manage Blogs
        </a>

    </div>

</section>

@endsection
