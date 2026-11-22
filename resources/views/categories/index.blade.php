<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogSphere | Categories</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6fb;
            color: #172033;
        }

        .navbar {
            background: #111827;
            color: white;
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
        }

        .logo span {
            color: #3b82f6;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-size: 16px;
        }

        .container {
            max-width: 1100px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
            font-size: 32px;
        }

        .subtitle {
            color: #6b7280;
            margin-top: 8px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-edit {
            background: #f59e0b;
            color: white;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .category-card {
            background: white;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 15px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.06);

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .icon {
            width: 48px;
            height: 48px;
            background: #eff6ff;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }

        .category-name {
            font-size: 19px;
            font-weight: bold;
        }

        .category-id {
            color: #6b7280;
            font-size: 13px;
            margin-top: 4px;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .empty {
            background: white;
            padding: 60px 20px;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.06);
        }

        @media (max-width: 700px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links a {
                margin: 0 8px;
            }

            .top-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .category-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 18px;
            }

            .actions {
                width: 100%;
            }

            .actions .btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">
            Blog<span>Sphere</span>
        </div>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('blogs.index') }}">All Blogs</a>
            <a href="{{ route('blogs.create') }}">Create Blog</a>
        </div>
    </nav>

    <div class="container">

        <div class="top-section">
            <div>
                <h1>🗂️ Categories</h1>
                <div class="subtitle">
                    Organize your blog posts by category.
                </div>
            </div>

            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                + Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @forelse($categories as $category)

            <div class="category-card">

                <div class="category-info">

                    <div class="icon">
                        🗂️
                    </div>

                    <div>
                        <div class="category-name">
                            {{ $category->name }}
                        </div>

                        <div class="category-id">
                            Category ID: {{ $category->id }}
                        </div>
                    </div>

                </div>

                <div class="actions">

                    <a
                        href="{{ route('categories.edit', $category) }}"
                        class="btn btn-edit">
                        ✏️ Edit
                    </a>

                    <form
                        action="{{ route('categories.destroy', $category) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this category?');">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-delete">
                            🗑️ Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div class="empty">
                <h2>📂 No Categories Found</h2>
                <p>Create your first category to organize your blog posts.</p>

                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    + Create Category
                </a>
            </div>

        @endforelse

    </div>

</body>
</html>