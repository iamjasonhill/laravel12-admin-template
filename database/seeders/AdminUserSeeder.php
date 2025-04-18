<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user or find existing one
        $admin = User::firstOrCreate(
            ['email' => 'jason@jasonhill.com.au'],
            [
                'name' => 'Jason Hill',
                'password' => Hash::make('Hulksmash123!!!'),
                'email_verified_at' => now(),
            ]
        );
        
        // Update password if user already exists
        if (!$admin->wasRecentlyCreated) {
            $admin->update([
                'password' => Hash::make('Hulksmash123!!!')
            ]);
        }
        
        // Get the admin role (should be created by RolesAndPermissionsSeeder)
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        
        // Assign admin role to user
        $admin->assignRole($adminRole);
        
        $this->command->info('Admin user created successfully!');
    }
}
