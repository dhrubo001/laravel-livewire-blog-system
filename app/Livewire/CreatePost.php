<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Traits\LivewireActivityLogger;
use Exception;

class CreatePost extends Component
{
    use LivewireActivityLogger;
    public $title;
    public $content;

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'content' => 'required|min:10',
    ];

    public function save()
    {
        $this->validate();

        try {
            $post = Post::create([
                'user_id' => Auth::id(),
                'title' => $this->title,
                'content' => $this->content,
            ]);

            $this->logActivity('Created a new blog post with ID ' . $post->id);


            $this->reset(['title', 'content']);

            session()->flash('success', 'Your blog post has been created successfully!');
        } catch (Exception $e) {
            \Log::error('Post creation failed: ' . $e->getMessage());
            session()->flash('error', 'Something went wrong while creating your post.');
        }
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
