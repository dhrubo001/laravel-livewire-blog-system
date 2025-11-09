<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\BlogService;

class AdminDashboardStats extends Component
{
    public $totalUsers;
    public $totalPosts;
    public $totalComments;

    public function mount(BlogService $blogService)
    {
        $this->totalUsers = $blogService->getTotalUsers();
        $this->totalPosts = $blogService->getTotalPosts();
        $this->totalComments = $blogService->getTotalComments();
    }

    public function render()
    {
        return view('livewire.admin-dashboard-stats');
    }
}
