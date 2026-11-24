
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') | BlogSphere</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* RESET */
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f4f6fb;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* MAIN APP GRID */
        #bs-shell {
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
            width: 100%;
            min-height: 100vh;
        }

        /* SIDEBAR */
        #bs-sidebar {
            background: #172554;
            color: white;
            min-height: 100vh;
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .bs-brand {
            font-size: 25px;
            font-weight: 800;
            padding: 0 12px 38px;
            letter-spacing: -1px;
        }

        .bs-brand span {
            color: #60a5fa;
        }

        .bs-menu-label {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 700;
            letter-spacing: 1.5px;
            padding: 0 12px;
            margin-bottom: 13px;
        }

        .bs-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .bs-nav a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
        }

        .bs-nav a:hover {
            background: #263b70;
            color: white;
        }

        .bs-nav a.active {
            background: #2563eb;
            color: white;
            font-weight: 600;
        }

        .bs-nav-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .bs-sidebar-footer {
            margin-top: auto;
            padding: 16px 12px;
            border-top: 1px solid #334155;
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.6;
        }

        /* RIGHT SIDE */
        #bs-main {
            min-width: 0;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOP NAVBAR */
        #bs-topbar {
            width: 100%;
            min-height: 75px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
            gap: 15px;
        }

        .bs-page-heading {
            font-size: 19px;
            font-weight: 700;
            color: #172554;
        }

        .bs-admin {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .bs-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 800;
        }

        /* LOGOUT BUTTON */
        .bs-logout {
            background: #fee2e2;
            color: #b91c1c;
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            font-weight: 700;
            cursor: pointer;
            font-size: 12px;
            transition: 0.2s;
        }

        .bs-logout:hover {
            background: #fecaca;
        }

        /* CONTENT AREA */
        #bs-content {
            width: 100%;
            min-width: 0;
            flex: 1;
            padding: 32px 35px;
        }

        /* ALERTS */
        .bs-alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .bs-alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        /* TABLET AND MOBILE */
        @media (max-width: 768px) {
            #bs-shell {
                grid-template-columns: minmax(0, 1fr);
            }

            #bs-sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: auto;
                padding: 18px;
            }

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') | BlogSphere</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* RESET */
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f4f6fb;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* MAIN GRID */
        #bs-shell {
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
            width: 100%;
            min-height: 100vh;
        }

        /* SIDEBAR */
        #bs-sidebar {
            background: #172554;
            color: white;
            min-height: 100vh;
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .bs-brand {
            font-size: 25px;
            font-weight: 800;
            padding: 0 12px 38px;
            letter-spacing: -1px;
        }

        .bs-brand span {
            color: #60a5fa;
        }

        .bs-menu-label {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 700;
            letter-spacing: 1.5px;
            padding: 0 12px;
            margin-bottom: 13px;
        }

        .bs-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .bs-nav a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
        }

        .bs-nav a:hover {
            background: #263b70;
            color: white;
        }

        .bs-nav a.active {
            background: #2563eb;
            color: white;
            font-weight: 600;
        }

        .bs-nav-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .bs-sidebar-footer {
            margin-top: auto;
            padding: 16px 12px;
            border-top: 1px solid #334155;
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.6;
        }

        /* MAIN AREA */
        #bs-main {
            min-width: 0;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */
        #bs-topbar {
            width: 100%;
            min-height: 75px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
            gap: 15px;
        }

        .bs-page-heading {
            font-size: 19px;
            font-weight: 700;
            color: #172554;
        }

        .bs-admin {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .bs-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 800;
            flex-shrink: 0;
        }

        /* LOGOUT */
        .bs-logout {
            background: #fee2e2;
            color: #b91c1c;
            border: none;
            border-radius: 8px;
            padding: 10px 14px;
            font-weight: 700;
            cursor: pointer;
            font-size: 12px;
            transition: 0.2s;
        }

        .bs-logout:hover {
            background: #fecaca;
        }

        /* CONTENT */
        #bs-content {
            width: 100%;
            min-width: 0;
            flex: 1;
            padding: 32px 35px;
        }

        /* PAGE HEADER */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 28px;
        }

        .page-header h1 {
            font-size: 30px;
            color: #172554;
            margin: 0 0 8px;
            font-weight: 800;
        }

        .page-header p {
            color: #64748b;
            margin: 0;
            font-size: 15px;
            line-height: 1.6;
        }

        /* CONTENT CARD */
        .content-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
            margin-bottom: 24px;
            min-width: 0;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .section-header h2 {
            color: #172554;
            font-size: 22px;
            margin: 0 0 8px;
        }

        .section-header p {
            color: #64748b;
            margin: 0;
            font-size: 14px;
        }

        /* FORMS */
        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 9px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            display: block;
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            color: #1e293b;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .form-group textarea {
            min-height: 180px;
            resize: vertical;
            line-height: 1.6;
        }

        /* BUTTONS */
        .btn {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            font-family: inherit;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            color: white;
        }

        .btn-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        .btn-danger:hover {
            background: #fecaca;
        }

        /* ALERTS */
        .bs-alert-success,
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .bs-alert-error,
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        /* TABLES */
        .content-card table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .content-card th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .content-card th,
        .content-card td {
            padding: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .content-card td {
            font-size: 14px;
            color: #334155;
        }

        /* PAGINATION */
        .pagination {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-top: 22px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border-radius: 7px;
            background: white;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            color: #334155;
            font-size: 13px;
        }

        .pagination .active span {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        /* TABLET */
        @media (max-width: 768px) {
            #bs-shell {
                grid-template-columns: minmax(0, 1fr);
            }

            #bs-sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: auto;
                padding: 18px;
            }

            .bs-brand {
                padding: 0 5px 18px;
            }

            .bs-menu-label,
            .bs-sidebar-footer {
                display: none;
            }

            .bs-nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .bs-nav a {
                padding: 10px;
                font-size: 12px;
            }

            #bs-main {
                width: 100%;
            }

            #bs-topbar {
                min-height: 65px;
                padding: 0 18px;
            }

            #bs-content {
                padding: 22px 16px;
            }

            .content-card {
                padding: 20px;
            }

            .page-header h1 {
                font-size: 25px;
            }
        }

        /* SMALL MOBILE */
        @media (max-width: 480px) {
            #bs-topbar {
                padding: 0 12px;
            }

            .bs-page-heading {
                font-size: 15px;
            }

            .bs-admin {
                font-size: 11px;
                gap: 6px;
            }

            .bs-avatar {
                width: 32px;
                height: 32px;
            }

            .bs-logout {
                padding: 8px;
            }

            #bs-content {
                padding: 18px 12px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-header h1 {
                font-size: 23px;
            }

            .content-card {
                padding: 16px;
                overflow-x: auto;
            }

            .section-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div id="bs-shell">

        <!-- SIDEBAR -->
        <aside id="bs-sidebar">

            <div class="bs-brand">
                Blog<span>Sphere.</span>
            </div>

            <div class="bs-menu-label">MAIN MENU</div>

            <nav class="bs-nav">

                @if(auth()->user()->role === 'admin')

                    <!-- ADMIN MENU -->

                    <a href="{{ route('dashboard') }}"
                       class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="bs-nav-icon">▦</span>
                        Dashboard
                    </a>

                    <a href="{{ route('blogs.index') }}"
                       class="{{ request()->routeIs('blogs.index', 'blogs.show', 'blogs.edit') ? 'active' : '' }}">
                        <span class="bs-nav-icon">▤</span>
                        All Blogs
                    </a>

                    <a href="{{ route('blogs.create') }}"
                       class="{{ request()->routeIs('blogs.create') ? 'active' : '' }}">
                        <span class="bs-nav-icon">＋</span>
                        Create Blog
                    </a>

                    <a href="{{ route('categories.index') }}"
                       class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <span class="bs-nav-icon">▣</span>
                        Categories
                    </a>

                @else

                    <!-- USER MENU -->

                    <a href="{{ route('user.dashboard') }}"
                       class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <span class="bs-nav-icon">▦</span>
                        Dashboard
                    </a>

                    <a href="{{ route('user.blogs.index') }}"
                       class="{{ request()->routeIs('user.blogs.index', 'user.blogs.edit') ? 'active' : '' }}">
                        <span class="bs-nav-icon">▤</span>
                        My Blogs
                    </a>

                    <a href="{{ route('user.blogs.create') }}"
                       class="{{ request()->routeIs('user.blogs.create') ? 'active' : '' }}">
                        <span class="bs-nav-icon">＋</span>
                        Create Blog
                    </a>

                @endif

            </nav>

            <div class="bs-sidebar-footer">
                BlogSphere {{ auth()->user()->role === 'admin' ? 'Admin Panel' : 'User Panel' }}<br>
                Version 1.0
            </div>

        </aside>

        <!-- MAIN AREA -->
        <main id="bs-main">

            <!-- TOPBAR -->
            <header id="bs-topbar">

                <div class="bs-page-heading">
                    @yield('header', 'Dashboard')
                </div>

                <div class="bs-admin">

                    <div class="bs-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <span>{{ auth()->user()->name }}</span>

                    <!-- LOGOUT -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="bs-logout">
                            Logout
                        </button>
                    </form>

                </div>

            </header>

            <!-- PAGE CONTENT -->
            <section id="bs-content">

                @if(session('success'))
                    <div class="bs-alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bs-alert-error">
                        Please check the form for errors.
                    </div>
                @endif

                @yield('content')

            </section>

        </main>

    </div>

</body>
</html>
