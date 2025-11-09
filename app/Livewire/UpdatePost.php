<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Traits\LivewireActivityLogger;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class UpdatePost extends Component
{
    use LivewireActivityLogger;

    public $postId;
    public $title;
    public $content;
    public $post;

    protected $rules = [
        'title' => 'required|string|min:3|max:255',
        'content' => 'required|string|min:10',
    ];

    public function mount($postId)
    {
        try {

            $this->post = Post::findOrFail($postId);

            if ($this->post->user_id !== Auth::id()) {
                session()->flash('error', 'Unauthorized to edit this post.');
            }

            $this->postId = $postId;
            $this->title = $this->post->title;
            $this->content = $this->post->content;
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Post not found.');
            return redirect()->route('getDashboard');
        } catch (Exception $e) {
            \Log::error('Error mounting UpdatePost component: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong while loading the post.');
            return redirect()->route('getDashboard');
        }
    }

    public function update()
    {
        $validatedData = $this->validate();

        try {
            $this->post->update($validatedData);

            $this->logActivity('Blog updated: ID ' . $this->post->id . ' by USER ID - ' . Auth::user()->id);

            session()->flash('success', 'Your blog post has been updated successfully!');
        } catch (Exception $e) {
            \Log::error('Post update failed: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong while updating your post.');
        }
    }

    public function render()
    {
        return view('livewire.update-post');
    }
}
