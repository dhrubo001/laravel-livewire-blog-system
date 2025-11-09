<div wire:poll.20s="loadComments">
    <div class="space-y-5">
        @include('includes.flashMessages')
        @forelse($comments as $comment)
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 shadow-sm relative group">
                <div class="flex items-start justify-between mb-1">
                    <div>
                        <div class="font-semibold text-gray-800">
                            {{ $comment->user->name ?? 'Anonymous' }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                    </div>


                    @if (auth()->id() === $comment->user_id)
                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition">


                            <button wire:click="deleteComment({{ $comment->id }})"
                                class="text-red-600 hover:text-red-800" title="Delete Comment"
                                wire:confirm="Are you sure you want to delete this comment?">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    @endif
                </div>

                <p class="text-gray-700 leading-relaxed mt-2">{{ $comment->content }}</p>
            </div>
        @empty
            <p class="text-gray-500 italic">
                <center>No comments yet. Be the first to share your thoughts!</center>
            </p>
        @endforelse
    </div>
</div>
