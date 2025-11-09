<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class CommentList extends Component
{
    public $postId;
    public $comments;

    protected $listeners = ['commentAdded' => 'refreshComments'];

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = Comment::where('post_id', $this->postId)
            ->with('user:id,name')
            ->latest()
            ->get();
    }

    public function refreshComments()
    {
        $this->loadComments();
    }

    public function deleteComment(int $id)
    {
        $comment = Comment::find($id);

        if ($comment && $comment->user_id === Auth::id()) {
            $comment->delete();
            $this->refreshComments();
            session()->flash('success', 'Comment deleted successfully.');
        } else {
            session()->flash('error', 'Comment not found or access denied.');
        }
    }


    public function render()
    {
        return view('livewire.comment-list');
    }
}
