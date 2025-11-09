<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-6">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg p-10">
        <h1 class="text-3xl font-bold text-blue-600 mb-8 text-center">Update Blog Post</h1>

        @include('includes.flashMessages')

        <form wire:submit.prevent="update" class="space-y-6">
            <!-- Title -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2 text-lg">Post Title</label>
                <input wire:model.defer="title" type="text" name="title"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring focus:ring-blue-100 outline-none text-gray-800 text-base"
                    placeholder="Enter your title">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label class="block font-semibold text-gray-700 mb-2 text-lg">Content</label>
                <textarea wire:model.defer="content" name="content"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 h-80 focus:border-blue-500 focus:ring focus:ring-blue-100 outline-none text-gray-800 text-base resize-none"
                    placeholder="Write your content here..."></textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Button -->
            <div class="flex justify-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-base px-10 py-3 rounded-lg shadow-md transition-transform transform hover:scale-105">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
