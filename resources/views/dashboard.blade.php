
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogSphere | Dashboard</title>

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

        /* Navigation Bar */
        .navbar {
            background: #111827;
            color: white;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 25px;
            font-weight: bold;
            white-space: nowrap;
        }

        .logo span {
            color: #60a5fa;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 22px;
            flex-wrap: wrap;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.2s;
        }

        .nav a:hover {
            color: #60a5fa;
        }

        .nav .nav-create {
            background: #2563eb;
            padding: 10px 15px;
            border-radius: 8px;
        }

        .nav .nav-create:hover {
            background: #1d4ed8;
            color: white;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 35px auto;
            padding: 20px;
        }

        .welcome {
            margin-bottom: 30px;
        }

        .welcome h1 {
            margin: 0 0 10px;
            font-size: 32px;
        }

        .welcome p {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Statistics */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-icon {
            font-size: 30px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: bold;
            margin-top: 10px;
        }

        .stat-name {
            color: #6b7280;
            margin-top: 5px;
        }

        /* Sections */
        .section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
            margin-bottom: 25px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .section-header h2 {
            margin: 0;
            font-size: 22px;
        }

        .view-btn {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .view-btn:hover {
            text-decoration: underline;
        }

        /* Recent Blogs */
        .blog-row {
            padding: 18px 0;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .blog-row:last-child {
            border-bottom: none;
        }

        .blog-title {
            font-weight: bold;
            font-size: 17px;
            overflow-wrap: anywhere;
        }

        .blog-info {
            color: #6b7280;
            font-size: 13px;
            margin-top: 7px;
            line-height: 1.5;
        }

        .badge {
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
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
            padding: 30px 15px;
            color: #6b7280;
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .action-btn {
            display: inline-block;
            padding: 13px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }

        .create {
            background: #2563eb;
            color: white;
        }

        .create:hover {
            background: #1d4ed8;
        }

        .blogs {
            background: #e5e7eb;
            color: #111827;
        }

        .blogs:hover {
            background: #d1d5db;
        }

        .categories {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .categories:hover {
            background: #bfdbfe;
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .navbar {
                padding: 18px 25px;
            }
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 18px;
                align-items: flex-start;
            }

            .nav {
                gap: 15px;
            }

            .nav a {
                font-size: 14px;
            }

            .container {
                margin: 15px auto;
                padding: 15px;
            }

            .welcome h1 {
                font-size: 26px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .stat-card {
                padding: 20px;
            }

            .section {
                padding: 20px;
            }

            .blog-row {
                align-items: flex-start;
            }

            .blog-info {
                overflow-wrap: anywhere;
            }

            .quick-actions {
                flex-direction: column;
            }

            .action-btn {
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">
            Blog<span>Sphere</span>
        </div>

        <div class="nav">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('blogs.index') }}">All Blogs</a>
            <a href="{{ route('categories.index') }}">Categories</a>
            <a href="{{ route('blogs.create') }}" class="nav-create">
                + Create Blog
            </a>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <main class="container">

        <div class="welcome">
            <h1>👋 Welcome to BlogSphere</h1>
            <p>
                Smart Blog Management System — manage your content easily.
            </p>
        </div>

        <!-- Statistics Cards -->
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

        <!-- Recent Blog Posts -->
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
                            <div class="blog-title">
                                {{ $blog->title }}
                            </div>

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
                    <p>No blog posts yet.</p>

                    <a href="{{ route('blogs.create') }}" class="view-btn">
                        Create your first blog →
                    </a>
                </div>

            @endif

        </section>

        <!-- Quick Actions -->
        <section class="section">

            <div class="section-header">
                <h2>⚡ Quick Actions</h2>
            </div>

            <div class="quick-actions">

                <a href="{{ route('blogs.create') }}" class="action-btn create">
                    + Create New Blog
                </a>

                <a href="{{ route('blogs.index') }}" class="action-btn blogs">
                    📚 Manage Blogs
                </a>

                <a href="{{ route('categories.index') }}" class="action-btn categories">
                    🗂️ Manage Categories
                </a>

            </div>

        </section>

    </main>

</body>
</html>
