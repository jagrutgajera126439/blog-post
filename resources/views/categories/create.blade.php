@extends('layouts.app')
@section('title', 'Add Category')
@section('header', 'Add Category')
@section('content')
<style>
    .category-form { max-width:720px; }
    .category-form .content-card { padding:28px; }
    .category-error { margin-bottom:16px; padding:13px 16px; border-radius:10px; background:#fef2f2; color:#991b1b; }
    .category-error ul { margin:7px 0 0; padding-left:20px; }
    .category-form-actions { display:flex; flex-wrap:wrap; gap:10px; margin-top:20px; }
    .category-secondary { display:inline-flex; align-items:center; justify-content:center; padding:11px 16px; border-radius:8px; background:#e2e8f0; color:#1e293b; text-decoration:none; font-weight:600; }
    @media(max-width:600px) { .category-form .content-card { padding:20px; } }
</style>
<div class="page-header"><div><h1>➕ Add New Category</h1><p>Create a category to keep related blog posts together.</p></div></div>
<div class="category-form"><section class="content-card">
    @if($errors->any())<div class="category-error"><strong>Please fix the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    <form action="{{ route('categories.store') }}" method="POST">@csrf
        <div class="form-group"><label for="name">Category name</label><input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Example: Technology" maxlength="100" required autofocus>@error('name')<small class="field-error">{{ $message }}</small>@enderror</div>
        <div class="category-form-actions"><button type="submit" class="btn btn-primary">Save Category</button><a href="{{ route('categories.index') }}" class="category-secondary">Cancel</a></div>
    </form>
</section></div>
@endsection
