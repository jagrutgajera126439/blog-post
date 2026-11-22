<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BlogSphere | Edit Category</title>

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
            max-width: 650px;
            margin: 50px auto;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
        }

        h1 {
            margin-top: 0;
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

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            margin-bottom: 20px;
        }

        input:focus {
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
            gap: 10px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            text-decoration: none;
            cursor: pointer;
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

        @media (max-width: 600px) {
            .navbar {
                padding: 15px 20px;
            }

            .nav a {
                margin-left: 10px;
                font-size: 14px;
            }

            .container {
                margin: 25px auto;
            }

            .card {
                padding: 25px;
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
            <a href="{{ route('blogs.index') }}">Blogs</a>
            <a href="{{ route('categories.index') }}">Categories</a>
        </div>

    </div>


    <div class="container">

        <div class="card">

            <h1>✏️ Edit Category</h1>

            <p class="subtitle">
                Update the category name below.
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


            <form action="{{ route('categories.update', $category->id) }}" method="POST">

                @csrf

                @method('PUT')


                <label for="name">
                    Category Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    required
                >


                <div class="buttons">

                    <button type="submit" class="btn update">
                        💾 Update Category
                    </button>

                    <a
                        href="{{ route('categories.index') }}"
                        class="btn back"
                    >
                        ← Back
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>