<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions by category
        $this->createUserPermissions();
        $this->createQuotePermissions();
        $this->createBookingPermissions();
        $this->createProviderPermissions();
        $this->createCustomerPermissions();
        $this->createFinancialPermissions();
        $this->createSystemPermissions();
        $this->createEmailPermissions();
        $this->createTaskPermissions();

        // Create roles and assign permissions
        $this->createAdminRole();
        $this->createManagerRole();
        $this->createAccountsRole();
        $this->createStaffRole();
        $this->createProviderRole();
        $this->createCustomerRole();

        $this->command->info('Roles and permissions created successfully!');
    }

    /**
     * Create user management permissions
     */
    private function createUserPermissions(): void
    {
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage users',
            'assign roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create quote management permissions
     */
    private function createQuotePermissions(): void
    {
        $permissions = [
            'view quotes',
            'create quotes',
            'edit quotes',
            'delete quotes',
            'approve quotes',
            'view all quotes',
            'view own quotes',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create booking management permissions
     */
    private function createBookingPermissions(): void
    {
        $permissions = [
            'view bookings',
            'create bookings',
            'edit bookings',
            'delete bookings',
            'view all bookings',
            'view own bookings',
            'manage booking status',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create provider management permissions
     */
    private function createProviderPermissions(): void
    {
        $permissions = [
            'view providers',
            'create providers',
            'edit providers',
            'delete providers',
            'manage provider assignments',
            'submit provider responses',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create customer management permissions
     */
    private function createCustomerPermissions(): void
    {
        $permissions = [
            'view customers',
            'create customers',
            'edit customers',
            'delete customers',
            'view all customers',
            'view own customer data',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create financial management permissions
     */
    private function createFinancialPermissions(): void
    {
        $permissions = [
            'view payments',
            'process payments',
            'issue refunds',
            'view invoices',
            'create invoices',
            'edit invoices',
            'view financial reports',
            'manage payouts',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create system management permissions
     */
    private function createSystemPermissions(): void
    {
        $permissions = [
            'view settings',
            'edit settings',
            'manage system',
            'view logs',
            'view activity',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create email management permissions
     */
    private function createEmailPermissions(): void
    {
        $permissions = [
            'view email logs',
            'manage email logs',
            'send emails',
            'view email templates',
            'edit email templates',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create task management permissions
     */
    private function createTaskPermissions(): void
    {
        $permissions = [
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'assign tasks',
            'complete tasks',
            'view all tasks',
            'view own tasks',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }

    /**
     * Create Admin role with all permissions
     */
    private function createAdminRole(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
    }

    /**
     * Create Manager role with operational permissions
     */
    private function createManagerRole(): void
    {
        $role = Role::firstOrCreate(['name' => 'manager']);
        
        $permissions = [
            // Quote permissions
            'view quotes', 'create quotes', 'edit quotes', 'approve quotes', 'view all quotes',
            
            // Booking permissions
            'view bookings', 'create bookings', 'edit bookings', 'view all bookings', 'manage booking status',
            
            // Provider permissions
            'view providers', 'edit providers', 'manage provider assignments', 'submit provider responses',
            
            // Customer permissions
            'view customers', 'create customers', 'edit customers', 'view all customers',
            
            // Task permissions
            'view tasks', 'create tasks', 'edit tasks', 'assign tasks', 'view all tasks',
            
            // Email permissions
            'view email logs', 'send emails', 'view email templates',
            
            // System permissions
            'view activity',
            
            // Financial permissions (limited)
            'view payments', 'view invoices',
        ];
        
        $role->givePermissionTo($permissions);
    }

    /**
     * Create Accounts role with financial permissions
     */
    private function createAccountsRole(): void
    {
        $role = Role::firstOrCreate(['name' => 'accounts']);
        
        $permissions = [
            // Financial permissions
            'view payments', 'process payments', 'issue refunds', 
            'view invoices', 'create invoices', 'edit invoices', 
            'view financial reports', 'manage payouts',
            
            // Limited booking permissions
            'view bookings', 'view all bookings',
            
            // Limited customer permissions
            'view customers', 'view all customers',
            
            // Email permissions
            'view email logs', 'send emails',
        ];
        
        $role->givePermissionTo($permissions);
    }

    /**
     * Create Staff role with day-to-day operational permissions
     */
    private function createStaffRole(): void
    {
        $role = Role::firstOrCreate(['name' => 'staff']);
        
        $permissions = [
            // Quote permissions
            'view quotes', 'create quotes', 'edit quotes', 'view all quotes',
            
            // Booking permissions
            'view bookings', 'create bookings', 'edit bookings', 'view all bookings',
            
            // Provider permissions
            'view providers', 'submit provider responses',
            
            // Customer permissions
            'view customers', 'create customers', 'edit customers', 'view all customers',
            
            // Task permissions
            'view tasks', 'create tasks', 'edit tasks', 'complete tasks', 'view own tasks',
            
            // Email permissions
            'view email logs', 'send emails',
        ];
        
        $role->givePermissionTo($permissions);
    }

    /**
     * Create Provider role with limited access
     */
    private function createProviderRole(): void
    {
        $role = Role::firstOrCreate(['name' => 'provider']);
        
        $permissions = [
            // Quote permissions
            'view own quotes',
            
            // Booking permissions
            'view own bookings',
            
            // Task permissions
            'view own tasks', 'complete tasks',
            
            // Limited permissions
            'submit provider responses',
        ];
        
        $role->givePermissionTo($permissions);
    }

    /**
     * Create Customer role with limited access
     */
    private function createCustomerRole(): void
    {
        $role = Role::firstOrCreate(['name' => 'customer']);
        
        $permissions = [
            // Limited permissions
            'view own quotes',
            'view own bookings',
            'view own customer data',
        ];
        
        $role->givePermissionTo($permissions);
    }
}
