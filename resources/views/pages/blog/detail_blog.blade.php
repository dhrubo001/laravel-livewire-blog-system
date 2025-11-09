@extends('layouts.app')
@section('content')
    @include('includes.after_auth_header')

    <!-- 📝 Blog Content -->
    <main class="flex-1 mt-24 px-6 max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <!-- Blog Details -->
            @livewire('post', ['post' => $post])
        </div>

        <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Comments</h2>

            <!-- Add Comment Form -->
            @auth
                @livewire('post-comment', ['postId' => $post->id])
            @else
                <p class="text-gray-600">Please <a href="{{ route('getLogin') }}" class="text-blue-600 font-medium">login</a> to
                    add a comment.</p>
            @endauth

            <!-- Comments List -->
            @livewire('comment-list', ['postId' => $post->id])
        </div>

    </main>
@endsection
