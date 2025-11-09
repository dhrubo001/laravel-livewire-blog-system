<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboard()
    {
        $title = "Dashboard";
        $posts =  Post::with(['author:id,name'])->withCount('comments')->latest()->paginate(6);
        return view('pages.blog.dashboard', compact('title', 'posts'));
    }
}
