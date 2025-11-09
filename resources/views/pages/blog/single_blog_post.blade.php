<div class="bg-white rounded-xl shadow hover:shadow-lg transition duration-300 p-5 flex flex-col justify-between">
    <div>
        <h2 class="text-xl font-semibold text-blue-700 mb-2">{{ $post->title }}</h2>
        <p class="text-sm text-gray-500 mb-3">
            By <span class="font-medium">{{ $post->author->name }}</span> • {{ $post->created_at->diffForHumans() }}
        </p>
        <p class="text-gray-700 text-sm leading-relaxed">
            {{ Str::words($post->content, 20, '...') }}
        </p>
    </div>
    <div class="mt-4 flex justify-between items-center text-sm">
        @php
            $routeName = Auth::user()->role === 'admin' ? 'admin.getPostRead' : 'getPostRead';
        @endphp

        <a href="{{ route($routeName, ['slug' => $post->slug]) }}" class="text-blue-600 hover:underline">
            Read More
        </a>


        <span class="text-gray-500">
            {{ $post->comments_count }}
            {{ $post->comments_count > 1 ? 'comments' : 'comment' }}
        </span>
    </div>
</div>
