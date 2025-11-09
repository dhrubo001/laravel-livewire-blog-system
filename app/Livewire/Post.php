<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post as PostModel;
use Illuminate\Support\Facades\Auth;
use App\Traits\LivewireActivityLogger;
use Illuminate\Support\Facades\Crypt;

class Post extends Component
{
    use LivewireActivityLogger;

    public $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function deletePost($id)
    {
        $postId = decrypt($id);
        $post = PostModel::find($postId);

        // Authorization: only the creator can delete their post (except admin)
        if (!$post || Auth::id() !== $post->user_id || Auth::user()->role === 'admin') {
            session()->flash('error', 'You are not authorized to delete this post.');
            return $this->redirectBasedOnRole();
        }

        // Soft delete
        $post->delete();

        // Log activity
        $this->logActivity('Blog post soft deleted with ID ' . $post->id . ' by USER ID ' . Auth::id());

        session()->flash('success', 'Post deleted successfully.');

        return $this->redirectBasedOnRole();
    }


    private function redirectBasedOnRole()
    {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/user/dashboard');
    }

    public function render()
    {
        return view('livewire.post');
    }
}
