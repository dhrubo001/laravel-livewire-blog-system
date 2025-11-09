<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getPostCreate()
    {
        $title = "Post Create";
        return view('pages.blog.create_blog', compact('title'));
    }

    public function getPostRead($slug)
    {

        $post = Post::with(['author:id,name', 'comments'])->where('slug', $slug)->firstOrFail();
        $title = "Post Detail - " . $post->slug;
        return view('pages.blog.detail_blog', compact('title', 'post'));
    }

    public function getPostUpdate($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $title = "Update Detail - " . $post->slug;
        $postId = $post->id;
        return view('pages.blog.update_blog', compact('title', 'postId'));
    }
}
