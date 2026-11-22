<!DOCTYPE html>
<html>
<head>
    <title>Blog Post Management</title>

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
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .search-form {
            display: flex;
            gap: 8px;
        }

        input {
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button,
        .btn {
            padding: 11px 16px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .search-btn {
            background: #007bff;
        }

        .add-btn {
            background: #28a745;
        }

        .blog-card {
            background: white;
            padding: 22px;
            margin-bottom: 18px;
            border-radius: 10px;
            box-shadow: 0 2px 8px #ddd;
        }

        .blog-card h2 {
            margin-top: 0;
            color: #222;
        }

        .author {
            color: #666;
        }

        .actions {
            margin-top: 18px;
        }

        .edit-btn {
            background: #ffc107;
            color: #222;
        }

        .delete-btn {
            background: #dc3545;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .empty {
            background: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>📝 Blog Post Management</h1>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">

        <form
            action="{{ route('blogs.index') }}"
            method="GET"
            class="search-form"
        >

            <input
                type="text"
                name="search"
                placeholder="Search by title or author"
                value="{{ $search }}"
            >

            <button class="search-btn" type="submit">
                Search
            </button>

        </form>

        <a
            href="{{ route('blogs.create') }}"
            class="btn add-btn"
        >
            + Add Blog
        </a>

    </div>

    @forelse($blogs as $blog)

        <div class="blog-card">

            <h2>{{ $blog->title }}</h2>

            <p class="author">
                <strong>Author:</strong>
                {{ $blog->author }}
            </p>

            <p>
                {{ $blog->content }}
            </p>

            <small>
                Created:
                {{ $blog->created_at->format('d-m-Y') }}
            </small>

            <div class="actions">

                <a
                    href="{{ route('blogs.edit', $blog->id) }}"
                    class="btn edit-btn"
                >
                    ✏️ Edit
                </a>

                <form
                    action="{{ route('blogs.destroy', $blog->id) }}"
                    method="POST"
                    style="display:inline;"
                    onsubmit="return confirm('Are you sure you want to delete this blog?')"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="delete-btn"
                    >
                        🗑️ Delete
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="empty">
            <h3>No blog posts found.</h3>
            <p>Click "Add Blog" to create your first post.</p>
        </div>

    @endforelse

</div>

</body>
</html>