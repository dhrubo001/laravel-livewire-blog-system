<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Traits\LivewireActivityLogger;

class PostComment extends Component
{
    use LivewireActivityLogger;

    public $postId;
    public $commentText;
    public $comments;

    protected $rules = [
        'commentText' => 'required|min:3|max:500',
    ];

    public function mount($postId)
    {
        $this->postId = $postId;
    }

    public function postComment()
    {
        $this->validate();

        if (!Auth::check()) {
            session()->flash('error', 'You must be logged in to post a comment.');
            return;
        }

        Comment::create([
            'post_id' => $this->postId,
            'user_id' => Auth::id(),
            'content' => $this->commentText,
        ]);

        $this->reset('commentText');

        $this->dispatch('commentAdded');

        $this->logActivity('Posted a comment on post ID ' . $this->postId);

        session()->flash('success', 'Comment added successfully!');
    }

    public function render()
    {
        return view('livewire.post-comment');
    }
}