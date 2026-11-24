
@extends('layouts.app')

@section('title', 'My Blogs')

@section('content')

<div class="page-header">
    <div>
        <h1>My Blogs 📝</h1>
        <p>Manage all your blog posts in one place.</p>
    </div>

    <a href="{{ route('user.blogs.create') }}"
       class="btn btn-primary">
        + Create New Blog
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="content-card">
    <div class="section-header">
        <div>
            <h2>Your Blog Posts</h2>
            <p>All blogs created by you.</p>
        </div>
    </div>

    @forelse($blogs as $blog)
        <div style="padding:20px 0; border-bottom:1px solid #eee;">

            <h3>{{ $blog->title }}</h3>

            <p>
                Category:
                {{ $blog->category->name ?? 'Uncategorized' }}
            </p>

            <p>
                Status:
                <strong>{{ ucfirst($blog->status) }}</strong>
            </p>

            <p>{{ Str::limit($blog->content, 150) }}</p>

            <a href="{{ route('user.blogs.edit', $blog->id) }}"
               class="btn btn-primary">
                Edit
            </a>

            <form action="{{ route('user.blogs.destroy', $blog->id) }}"
                  method="POST"
                  style="display:inline;"
                  onsubmit="return confirm('Are you sure you want to delete this blog?')">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </form>

        </div>
    @empty
        <div style="padding:30px 0; text-align:center;">
            <h3>No Blogs Yet!</h3>
            <p>Start writing your first blog post.</p>
        </div>
    @endforelse

    <div style="margin-top:20px;">
        {{ $blogs->links() }}
    </div>
</div>

@endsection
