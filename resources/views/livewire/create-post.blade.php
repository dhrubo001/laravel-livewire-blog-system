<div>
    <main class="flex-1 mt-24 px-8 max-w-6xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-10 w-full">
            <h1 class="text-3xl font-bold text-blue-600 mb-6 text-center">Create a New Blog Post</h1>

            @include('includes.flashMessages')

            <form wire:submit.prevent="save" class="space-y-6">
                <!-- Title -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1 text-lg">Post Title</label>
                    <input wire:model.defer="title" type="text" name="title"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring focus:ring-blue-100 outline-none text-gray-800 text-base"
                        placeholder="Enter your title">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label class="block font-semibold text-gray-700 mb-1 text-lg">Content</label>
                    <textarea wire:model.defer="content" name="content"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 h-60 focus:border-blue-500 focus:ring focus:ring-blue-100 outline-none text-gray-800 text-base resize-none"
                        placeholder="Write your content here..."></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-base px-6 py-3 rounded-lg shadow-md transition">
                        Publish
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
