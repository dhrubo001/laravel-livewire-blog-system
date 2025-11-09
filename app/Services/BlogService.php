<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class BlogService
{
    /**
     * Get total posts count.
     */
    public function getTotalPosts()
    {
        return Post::count();
    }

    /**
     * Get total comments count.
     */
    public function getTotalComments()
    {
        return Comment::count();
    }

    /**
     * Get total users with role = 'user'.
     */
    public function getTotalUsers()
    {
        return User::where('role', 'user')->count();
    }

    /**
     * Get recent posts.
     */
    public function getRecentPosts($limit = 5)
    {
        return Post::latest()->take($limit)->get();
    }
}
