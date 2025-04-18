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
        
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        
        // Define permissions
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage users',
            'view email logs',
            'manage email logs',
            'view customers',
            'edit customers',
            'view quotes',
            'edit quotes',
        ];
        
        // Create permissions if they don't exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
        
        // Assign all permissions to admin role
        $adminRole->givePermissionTo(Permission::all());
        
        // Assign admin role to user
        $admin->assignRole($adminRole);
        
        $this->command->info('Admin user created successfully!');
    }
}
