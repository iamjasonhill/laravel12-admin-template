<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManagement extends Component
{
    use WithPagination;
    
    public $name;
    public $email;
    public $password;
    public $role;
    public $userId;
    public $isEditing = false;
    public $confirmingUserDeletion = false;
    public $searchTerm = '';
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|min:8',
        'role' => 'required|exists:roles,name',
    ];
    
    public function mount()
    {
        $this->resetInputFields();
    }
    
    public function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'user';
        $this->userId = null;
        $this->isEditing = false;
        $this->confirmingUserDeletion = false;
        $this->resetErrorBag();
    }
    
    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name',
        ]);
        
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'email_verified_at' => now(),
        ]);
        
        $user->assignRole($this->role);
        
        session()->flash('message', 'User created successfully.');
        
        $this->resetInputFields();
        $this->dispatch('user-saved');
    }
    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->role = $user->roles->first()->name ?? 'user';
        $this->isEditing = true;
        
        // Dispatch browser event to scroll to form and ensure it's open
        $this->dispatch('user-edit-started');
    }
    
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:8',
            'role' => 'required|exists:roles,name',
        ]);
        
        $user = User::findOrFail($this->userId);
        
        $userData = [
            'name' => $this->name,
            'email' => $this->email,
        ];
        
        if (!empty($this->password)) {
            $userData['password'] = Hash::make($this->password);
        }
        
        $user->update($userData);
        
        // Sync roles
        $user->syncRoles([$this->role]);
        
        session()->flash('message', 'User updated successfully.');
        
        $this->resetInputFields();
        $this->dispatch('user-saved');
    }
    
    public function confirmUserDeletion($id)
    {
        $this->confirmingUserDeletion = $id;
    }
    
    public function deleteUser()
    {
        $user = User::findOrFail($this->confirmingUserDeletion);
        
        // Prevent deleting your own account
        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot delete your own account.');
            $this->confirmingUserDeletion = false;
            return;
        }
        
        $user->delete();
        
        session()->flash('message', 'User deleted successfully.');
        $this->confirmingUserDeletion = false;
    }
    
    public function cancel()
    {
        $this->resetInputFields();
    }
    
    public function showAddUserForm()
    {
        $this->resetInputFields();
        $this->dispatch('user-form-show');
    }
    
    public function render()
    {
        $roles = Role::all();
        
        $users = User::where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('livewire.admin.user-management', [
            'users' => $users,
            'roles' => $roles,
        ])->layout('livewire.layout.admin', ['title' => 'User Management']);
    }
}
