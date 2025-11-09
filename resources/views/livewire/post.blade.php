<div>
    <div class="p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 leading-tight">{{ $post->title }}</h1>

        <div class="flex items-center text-sm text-gray-500 mb-6">
            <span>By <span class="font-medium text-blue-600">{{ $post->author->name ?? 'Unknown' }}</span></span>
            <span class="mx-2">•</span>
            <span>{{ $post->created_at->diffForHumans() }}</span>
        </div>

        <!-- ✅ Edit/Delete Buttons (Visible only to post creator) -->
        @auth
            @if (Auth::id() === $post->user_id || Auth::user()->role === 'admin')
                <div class="flex space-x-3 mb-6">
                    @php
                        $role = Auth::user()->role;
                        $routeName = match ($role) {
                            'admin' => 'admin.getPostUpdate',
                            'user' => 'getPostUpdate',
                            default => 'getPostUpdate',
                        };
                    @endphp

                    <a href="{{ route($routeName, ['slug' => $post->slug]) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold shadow transition">
                        ✏️ Edit
                    </a>



                    <button wire:click="deletePost('{{ encrypt($post->id) }}')"
                        wire:confirm="Are you sure you want to delete this post?" type="button"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-semibold shadow transition">
                        🗑️ Delete
                    </button>

                </div>
            @endif
        @endauth

        <!-- Content -->
        <div class="prose max-w-none text-gray-700 leading-relaxed">
            {!! nl2br(e($post->content)) !!}
        </div>

        <!-- Divider -->
        <hr class="my-8 border-gray-200">

        <!-- Back Button -->
        <div class="text-center">
            <a href="{{ route('getDashboard') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold shadow transition">
                ← Back to All Blogs
            </a>
        </div>
    </div>
</div>
