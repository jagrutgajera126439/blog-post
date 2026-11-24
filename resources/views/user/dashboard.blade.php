
@extends('layouts.app')

@section('title', 'User Dashboard')
@section('header', 'Dashboard')

@section('content')

<style>
    .user-dashboard {
        width: 100%;
    }

    .welcome-section {
        margin-bottom: 28px;
    }

    .welcome-section h1 {
        color: #1e293b;
        font-size: 28px;
        margin: 0 0 8px;
    }

    .welcome-section p {
        color: #64748b;
        margin: 0;
        font-size: 15px;
    }

    .user-stats-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .user-stat-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 13px;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.04);
    }

    .user-stat-card p {
        color: #64748b;
        font-size: 14px;
        margin: 0 0 10px;
    }

    .user-stat-card h2 {
        color: #1e293b;
        font-size: 30px;
        margin: 0;
    }

    .user-stat-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 25px;
    }

    .icon-blue { background: #dbeafe; }
    .icon-green { background: #dcfce7; }
    .icon-orange { background: #ffedd5; }

    .user-content-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 13px;
        padding: 26px;
        margin-bottom: 25px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.04);
    }

    .user-content-card h2 {
        color: #1e293b;
        font-size: 20px;
        margin: 0 0 8px;
    }

    .user-content-card > p {
        color: #64748b;
        margin: 0;
    }

    .user-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 22px;
    }

    .user-action-btn {
        display: inline-block;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
    }

    .user-primary-btn {
        background: #2563eb;
        color: white;
    }

    .user-primary-btn:hover {
        background: #1d4ed8;
    }

    .user-secondary-btn {
        background: #e2e8f0;
        color: #334155;
    }

    .user-secondary-btn:hover {
        background: #cbd5e1;
    }

    .recent-blog-list {
        margin-top: 22px;
    }

    .recent-blog-item {
        padding: 17px 0;
        border-bottom: 1px solid #edf0f5;
    }

    .recent-blog-item:last-child {
        border-bottom: none;
    }

    .recent-blog-item h3 {
        color: #1e293b;
        font-size: 16px;
        margin: 0 0 7px;
    }

    .recent-blog-item p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .recent-status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        margin-top: 9px;
        font-weight: 600;
    }

    .status-published {
        background: #dcfce7;
        color: #166534;
    }

    .status-draft {
        background: #fef3c7;
        color: #92400e;
    }

    .user-empty {
        text-align: center;
        padding: 25px 10px;
        color: #64748b;
    }

    @media(max-width: 850px) {
        .user-stats-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media(max-width: 550px) {
        .user-stats-grid {
            grid-template-columns: 1fr;
        }

        .user-content-card {
            padding: 20px;
        }

        .welcome-section h1 {
            font-size: 23px;
        }
    }
</style>

<div class="user-dashboard">

    <div class="welcome-section">
        <h1>Welcome to BlogSphere 👋</h1>
        <p>
            Hello, {{ auth()->user()->name }}!
            Manage your blogs from your personal dashboard.
        </p>
    </div>

    <div class="user-stats-grid">

        <div class="user-stat-card">
            <div>
                <p>My Blogs</p>
                <h2>{{ $totalBlogs }}</h2>
            </div>
            <div class="user-stat-icon icon-blue">📝</div>
        </div>

        <div class="user-stat-card">
            <div>
                <p>Published Blogs</p>
                <h2>{{ $publishedBlogs }}</h2>
            </div>
            <div class="user-stat-icon icon-green">🌐</div>
        </div>

        <div class="user-stat-card">
            <div>
                <p>Draft Blogs</p>
                <h2>{{ $draftBlogs }}</h2>
            </div>
            <div class="user-stat-icon icon-orange">📄</div>
        </div>

    </div>

    <div class="user-content-card">
        <h2>Get Started 🚀</h2>
        <p>
            Your personal blogging space is ready.
            Create and manage your stories easily.
        </p>

        <div class="user-actions">
            <a href="{{ route('user.blogs.create') }}"
               class="user-action-btn user-primary-btn">
                + Create New Blog
            </a>

            <a href="{{ route('user.blogs.index') }}"
               class="user-action-btn user-secondary-btn">
                Manage My Blogs
            </a>
        </div>
    </div>

    <div class="user-content-card">
        <h2>Recent Blogs</h2>
        <p>Your latest blog posts.</p>

        <div class="recent-blog-list">

            @forelse($recentBlogs as $blog)

                <div class="recent-blog-item">
                    <h3>{{ $blog->title }}</h3>

                    <p>
                        {{ $blog->category->name ?? 'Uncategorized' }}
                        &nbsp; | &nbsp;
                        {{ $blog->created_at->format('d M Y') }}
                    </p>

                    <span class="recent-status {{ $blog->status === 'published' ? 'status-published' : 'status-draft' }}">
                        {{ ucfirst($blog->status) }}
                    </span>
                </div>

            @empty

                <div class="user-empty">
                    <h3>No blogs created yet.</h3>
                    <p>Start by creating your first blog post!</p>
                </div>

            @endforelse

        </div>
    </div>

</div>

@endsection
