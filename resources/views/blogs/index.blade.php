
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs | BlogSphere</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 20px;
        }

        h1 {
            color: #243247;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 28px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            flex: 1;
        }

        input, select {
            padding: 11px;
            border: 1px solid #d5dbe3;
            border-radius: 6px;
            background: white;
            font-size: 14px;
        }

        input {
            min-width: 220px;
            flex: 1;
        }

        button, .btn {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .search-btn {
            background: #2563eb;
        }

        .reset-btn {
            background: #64748b;
        }

        .add-btn {
            background: #16a34a;
            white-space: nowrap;
        }

        .blog-card {
            background: white;
            padding: 23px;
            margin-bottom: 18px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .blog-card h2 {
            margin: 0 0 12px;
            color: #243247;
        }

        .meta {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .blog-content {
            line-height: 1.6;
            color: #444;
        }

        .badges {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin: 12px 0;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .category-badge {
            background: #e0e7ff;
            color: #3730a3;
        }

        .published {
            background: #dcfce7;
            color: #166534;
        }

        .draft {
            background: #fef3c7;
            color: #92400e;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
        }

        .edit-btn {
            background: #f59e0b;
            color: #222;
        }

        .delete-btn {
            background: #dc3545;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 13px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .empty {
            background: white;
            padding: 35px;
            text-align: center;
            border-radius: 10px;
        }

        .pagination {
            margin-top: 25px;
        }

        .pagination nav > div:first-child {
            margin-bottom: 12px;
        }

        .pagination svg {
            width: 18px;
            height: 18px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 15px auto;
                padding: 15px;
            }

            .filter-form {
                flex-direction: column;
                width: 100%;
            }

            input, select {
                width: 100%;
            }

            .add-btn {
                width: 100%;
                text-align: center;
            }

            .blog-card {
                padding: 17px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>📝 All Blog Posts</h1>
    <p class="subtitle">Manage, search and organize your blog posts.</p>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">

        <form action="{{ route('blogs.index') }}" method="GET" class="filter-form">

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

            <button type="submit" class="search-btn">
                Apply Filters
            </button>

            <a href="{{ route('blogs.index') }}" class="btn reset-btn">
                Reset
            </a>

        </form>

        <a href="{{ route('blogs.create') }}" class="btn add-btn">
            + Add Blog
        </a>

    </div>

    @forelse($blogs as $blog)

        <div class="blog-card">

            <h2>{{ $blog->title }}</h2>

            <div class="meta">
                <strong>Author:</strong> {{ $blog->author }}
                &nbsp; | &nbsp;
                <strong>Created:</strong> {{ $blog->created_at->format('d M Y') }}
            </div>

            <div class="badges">

                @if($blog->category)
                    <span class="badge category-badge">
                        {{ $blog->category->name }}
                    </span>
                @endif

                <span class="badge {{ $blog->status === 'published' ? 'published' : 'draft' }}">
                    {{ ucfirst($blog->status) }}
                </span>

            </div>

            <p class="blog-content">
                {{ \Illuminate\Support\Str::limit($blog->content, 220) }}
            </p>

            <div class="actions">

                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn edit-btn">
                    ✏️ Edit
                </a>

                <form
                    action="{{ route('blogs.destroy', $blog->id) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this blog?')"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete-btn">
                        🗑️ Delete
                    </button>
                </form>

            </div>

        </div>

    @empty

        <div class="empty">
            <h3>No blog posts found.</h3>
            <p>Try changing your search or filters, or create a new blog post.</p>
        </div>

    @endforelse

    <div class="pagination">
        {{ $blogs->links() }}
    </div>

</div>

</body>
</html>
