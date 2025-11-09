<div>
    @include('includes.flashMessages')
    <form wire:submit.prevent="postComment" class="mb-8 space-y-4">
        <textarea wire:model.defer="commentText"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 h-24 focus:border-blue-500 focus:ring focus:ring-blue-100 outline-none resize-none"
            placeholder="Write a comment..."></textarea>
        @error('commentText')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                Post Comment
            </button>
        </div>
    </form>
</div>
