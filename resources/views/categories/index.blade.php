@extends('layouts.app')

@section('title', 'Categories')
@section('header', 'Categories')

@section('content')
<style>
    .category-list { display:grid; gap:14px; }
    .category-page-header { display:flex; align-items:center; justify-content:space-between; gap:20px; margin-bottom:28px; }
    .category-page-header h1 { margin:0 0 8px; color:#172554; font-size:30px; font-weight:800; }
    .category-page-header p { margin:0; color:#64748b; font-size:15px; line-height:1.6; }
    .category-add-button { display:inline-flex !important; align-items:center; justify-content:center; flex:none; min-height:46px; padding:12px 18px !important; border:0; border-radius:9px; background:#2563eb !important; color:#fff !important; text-decoration:none !important; font-family:inherit; font-size:14px; font-weight:600; line-height:1.2; white-space:nowrap; box-shadow:0 3px 8px rgba(37,99,235,.2); transition:background .2s, transform .2s; }
    .category-add-button:hover { background:#1d4ed8 !important; color:#fff !important; transform:translateY(-1px); }
    .category-item { display:flex; align-items:center; justify-content:space-between; gap:20px; padding:20px 22px; background:#fff; border:1px solid #e5e7eb; border-radius:14px; box-shadow:0 4px 14px rgba(15,23,42,.04); }
    .category-info { display:flex; align-items:center; gap:14px; min-width:0; }
    .category-icon { display:grid; place-items:center; width:46px; height:46px; flex:none; border-radius:12px; background:#eff6ff; font-size:22px; }
    .category-name { font-size:17px; font-weight:700; overflow-wrap:anywhere; }
    .category-meta { margin-top:4px; color:#64748b; font-size:13px; }
    .category-actions { display:flex; align-items:center; gap:9px; flex:none; }
    .category-actions form { margin:0; }
    .category-actions .btn { display:inline-flex; align-items:center; justify-content:center; min-height:40px; padding:9px 14px; border:0; border-radius:8px; text-decoration:none; font-family:inherit; font-size:14px; font-weight:600; cursor:pointer; }
    .category-edit { background:#eff6ff; color:#1d4ed8; }
    .category-delete { background:#fef2f2; color:#b91c1c; }
    .category-empty { padding:42px 24px; text-align:center; }
    .category-empty p { color:#64748b; margin:8px 0 20px; }
    .category-form { max-width:720px; }
    .category-form .content-card { padding:28px; }
    .category-error { margin-bottom:16px; padding:13px 16px; border-radius:10px; background:#fef2f2; color:#991b1b; }
    .category-error ul { margin:7px 0 0; padding-left:20px; }
    .category-form-actions { display:flex; flex-wrap:wrap; gap:10px; margin-top:20px; }
    .category-secondary { display:inline-flex; align-items:center; justify-content:center; padding:11px 16px; border-radius:8px; background:#e2e8f0; color:#1e293b; text-decoration:none; font-weight:600; }
    @media(max-width:600px) { .category-page-header { align-items:flex-start; flex-direction:column; } .category-page-header h1 { font-size:25px; } .category-item { align-items:flex-start; flex-direction:column; } .category-actions { width:100%; } .category-actions .btn { flex:1; } .category-form .content-card { padding:20px; } }
</style>
<div class="category-page-header"><div><h1>🗂️ Categories</h1><p>Organize blog posts with clear, reusable categories.</p></div><a href="{{ route('categories.create') }}" class="category-add-button">+ Add Category</a></div>
@if(session('error'))<div class="category-error">{{ session('error') }}</div>@endif
@if($errors->any())<div class="category-error"><strong>Please fix the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<div class="category-list">
    @forelse($categories as $category)
        <article class="category-item"><div class="category-info"><div class="category-icon" aria-hidden="true">🗂️</div><div><div class="category-name">{{ $category->name }}</div><div class="category-meta">{{ $category->blogs_count }} {{ $category->blogs_count === 1 ? 'blog post' : 'blog posts' }}</div></div></div>
            <div class="category-actions"><a href="{{ route('categories.edit', $category) }}" class="btn category-edit">Edit</a><form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category? Categories used by blog posts cannot be deleted.');">@csrf @method('DELETE')<button type="submit" class="btn category-delete">Delete</button></form></div>
        </article>
    @empty
        <section class="content-card category-empty"><h2>No categories yet</h2><p>Create your first category to organize your blog posts.</p><a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a></section>
    @endforelse
</div>
@endsection
