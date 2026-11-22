<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BlogSphere | Edit Blog</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f6fb;
            color: #1f2937;
        }

        .navbar {
            background: #111827;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .logo span {
            color: #60a5fa;
        }

        .nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            max-width: 850px;
            margin: 40px auto;
            padding: 20px;
        }

        .form-card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 13px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        textarea {
            min-height: 180px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            gap: 12px;
        }

        .btn {
            border: none;
            padding: 13px 22px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
        }

        .update {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #e5e7eb;
            color: #111827;
        }

        .update:hover {
            background: #1d4ed8;
        }

        .back:hover {
            background: #d1d5db;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 15px 20px;
            }

            .nav a {
                margin-left: 8px;
                font-size: 14px;
            }

            .container {
                margin: 20px auto;
            }

            .form-card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">

        <div class="logo">
            Blog<span>Sphere</span>
        </div>

        <div class="nav">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('blogs.index') }}">All Blogs</a>
        </div>

    </div>

    <div class="container">

        <div class="form-card">

            <h1>✏️ Edit Blog</h1>

            <p class="subtitle">
                Update your blog post information.
            </p>

            @if ($errors->any())
                <div class="error">
                    <strong>Please fix the following:</strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('blogs.update', $blog->id) }}" method="POST">

                @csrf
                @method('PUT')

                <label>Blog Title</label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $blog->title) }}"
                    placeholder="Enter your blog title"
                >

                <label>Author</label>

                <input
                    type="text"
                    name="author"
                    value="{{ old('author', $blog->author) }}"
                    placeholder="Enter author name"
                >

                <label>Category</label>

                <select name="category_id">

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

                <label>Content</label>

                <textarea
                    name="content"
                    placeholder="Write your blog content here..."
                >{{ old('content', $blog->content) }}</textarea>

                <label>Status</label>

                <select name="status">

                    <option value="published"
                        {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>
                        Published
                    </option>

                    <option value="draft"
                        {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>

                </select>

                <div class="buttons">

                    <button type="submit" class="btn update">
                        💾 Update Blog
                    </button>

                    <a href="{{ route('blogs.index') }}" class="btn back">
                        ← Back
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>
