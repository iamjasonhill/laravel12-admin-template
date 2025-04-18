<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    use WithPagination;
    
    public $stats = [
        'users' => 0,
        'emails' => 0,
        'customers' => 0
    ];
    
    public function mount()
    {
        $this->loadStats();
    }
    
    public function loadStats()
    {
        // Get user count
        $this->stats['users'] = User::count();
        
        // Use placeholders for tables that don't exist yet
        $this->stats['emails'] = 0; // Placeholder for email logs count
        $this->stats['customers'] = 0; // Placeholder for customers count
    }
    
    public function render()
    {
        // Get recent users for the dashboard
        $recentUsers = User::latest()->take(5)->get();
        
        return view('livewire.admin.dashboard', [
            'recentUsers' => $recentUsers
        ])->layout('livewire.layout.admin', ['title' => 'Admin Dashboard']);
    }
}
