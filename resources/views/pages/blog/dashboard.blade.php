@extends('layouts.app')
@section('content')
    <!-- Top Header -->
    @include('includes.after_auth_header')


    <main class="flex-1 mt-5 px-2 max-w-4xl mx-auto">
        @include('includes.flashMessages')
        @if (Auth::user()->role === 'admin')
            <div class="max-w-6xl mx-auto p-6">
                <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>
                <livewire:admin-dashboard-stats />
            </div>
        @endif

        @if (Auth::user()->role === 'user')
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Blog Posts</h1>
                <a href="{{ route('getPostCreate') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                    + Create Post
                </a>
            </div>
        @endif

        <!-- Dynamic Posts -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Post 1 -->
            @foreach ($posts as $post)
                @include('pages.blog.single_blog_post')
            @endforeach
        </div>
        <div class="mt-5">
            {{ $posts->links() }}
        </div>
    </main>
@endsection
