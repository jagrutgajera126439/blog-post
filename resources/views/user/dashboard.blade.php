
@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1>Welcome to BlogSphere 👋</h1>
        <p>Manage your blogs and explore new stories.</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <p>My Blogs</p>
            <h2>0</h2>
        </div>
        <div class="stat-icon">📝</div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p>Published Blogs</p>
            <h2>0</h2>
        </div>
        <div class="stat-icon">🌐</div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <p>Draft Blogs</p>
            <h2>0</h2>
        </div>
        <div class="stat-icon">📄</div>
    </div>
</div>

<div class="content-card">
    <div class="section-header">
        <div>
            <h2>Get Started</h2>
            <p>Start sharing your thoughts with the world.</p>
        </div>
    </div>

    <div style="padding: 25px 0;">
        <h3>Welcome, {{ auth()->user()->name }}!</h3>
        <p>Your personal blogging space is ready.</p>

        <a href="{{ route('register') }}"
           class="btn btn-primary"
           style="display:inline-block; margin-top:15px;">
            Explore BlogSphere
        </a>
    </div>
</div>
@endsection
