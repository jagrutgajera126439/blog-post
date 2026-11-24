
@extends('layouts.app')

@section('title', 'My Blogs')

@section('header', 'My Blogs')

@section('content')

<style>
    .my-blogs-page {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .my-blogs-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 28px;
    }

    .my-blogs-header h1 {
        color: #172554;
        font-size: 28px;
        margin: 0 0 8px;
    }

    .my-blogs-header p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
    }

    .my-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #2563eb;
        color: white;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: 0.2s;
    }

    .my-create-btn:hover {
        background: #1d4ed8;
    }

    .my-blogs-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 28px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    }

    .my-blogs-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 10px;
    }

    .my-blogs-card-header h2 {
        color: #172554;
        font-size: 20px;
        margin: 0 0 6px;
    }

    .my-blogs-card-header p {
        color: #64748b;
        font-size: 13px;
        margin: 0;
    }

    .my-blog-item {
        padding: 23px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .my-blog-item:last-child {
        border-bottom: none;
    }

    .my-blog-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 12px;
    }

    .my-blog-title {
        color: #172554;
        font-size: 19px;
        font-weight: 700;
        margin: 0;
        line-height: 1.5;
    }

    .my-blog-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin: 12px 0;
        color: #64748b;
        font-size: 13px;
    }

    .my-blog-category {
        background: #eff6ff;
        color: #1d4ed8;
        padding: 6px 10px;
        border-radius: 6px;
        font-weight: 600;
    }

    .my-blog-status {
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .my-blog-status.published {
        background: #dcfce7;
        color: #166534;
    }

    .my-blog-status.draft {
        background: #fef3c7;
        color: #92400e;
    }

    .my-blog-content {
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
        margin: 12px 0 18px;
        overflow-wrap: anywhere;
    }

    .my-blog-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .my-edit-btn,
    .my-delete-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 9px 16px;
        border: none;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .my-edit-btn {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .my-edit-btn:hover {
        background: #bfdbfe;
    }

    .my-delete-btn {
        background: #fee2e2;
        color: #b91c1c;
    }

    .my-delete-btn:hover {
        background: #fecaca;
    }

    .my-empty-state {
        text-align: center;
        padding: 55px 20px;
    }

    .my-empty-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .my-empty-state h3 {
        color: #172554;
        font-size: 21px;
        margin: 0 0 10px;
    }

    .my-empty-state p {
        color: #64748b;
        font-size: 14px;
        margin: 0 0 22px;
    }

    .my-pagination {
        margin-top: 25px;
    }

    @media (max-width: 600px) {
        .my-blogs-header h1 {
            font-size: 23px;
        }

        .my-blogs-card {
            padding: 18px;
        }

        .my-create-btn {
            width: 100%;
        }

        .my-blog-title {
            font-size: 17px;
        }
    }
</style>

<div class="my-blogs-page">

    <!-- PAGE HEADER -->
    <div class="my-blogs-header">

        <div>
            <h1>My Blogs 📝</h1>
            <p>Manage all your blog posts in one place.</p>
        </div>

        <a href="{{ route('user.blogs.create') }}" class="my-create-btn">
            ＋ Create New Blog
        </a>

    </div>

    <!-- BLOGS CARD -->
    <div class="my-blogs-card">

        <div class="my-blogs-card-header">

            <div>
                <h2>Your Blog Posts</h2>
                <p>All blog posts created by you.</p>
            </div>

            <span style="color:#64748b; font-size:13px;">
                Total: {{ $blogs->total() }} Blogs
            </span>

        </div>

        <!-- BLOG LIST -->
        @forelse($blogs as $blog)

            <div class="my-blog-item">

                <div class="my-blog-top">

                    <h3 class="my-blog-title">
                        {{ $blog->title }}
                    </h3>

                    <span class="my-blog-status {{ $blog->status === 'published' ? 'published' : 'draft' }}">
                        {{ ucfirst($blog->status) }}
                    </span>

                </div>

                <!-- BLOG INFORMATION -->
                <div class="my-blog-meta">

                    <span class="my-blog-category">
                        {{ $blog->category->name ?? 'Uncategorized' }}
                    </span>

                    <span>
                        ✍️ {{ $blog->author }}
                    </span>

                    <span>
                        📅 {{ $blog->created_at->format('d M Y') }}
                    </span>

                </div>

                <!-- BLOG CONTENT -->
                <p class="my-blog-content">
                    {{ \Illuminate\Support\Str::limit($blog->content, 200) }}
                </p>

                <!-- ACTION BUTTONS -->
                <div class="my-blog-actions">

                    <a
                        href="{{ route('user.blogs.edit', $blog->id) }}"
                        class="my-edit-btn"
                    >
                        ✏️ Edit Blog
                    </a>

                    <form
                        action="{{ route('user.blogs.destroy', $blog->id) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this blog?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="my-delete-btn">
                            🗑️ Delete Blog
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <!-- EMPTY STATE -->
            <div class="my-empty-state">

                <div class="my-empty-icon">📝</div>

                <h3>No Blogs Yet!</h3>

                <p>
                    You haven't created any blog posts.
                    Start writing your first blog today!
                </p>

                <a
                    href="{{ route('user.blogs.create') }}"
                    class="my-create-btn"
                >
                    ＋ Create Your First Blog
                </a>

            </div>

        @endforelse

        <!-- PAGINATION -->
        @if($blogs->hasPages())

            <div class="my-pagination">
                {{ $blogs->links() }}
            </div>

        @endif

    </div>

</div>

@endsection
