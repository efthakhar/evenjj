<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public $permissions = [
        'create_user', 'view_user', 'edit_user', 'delete_user',
        'create_event_category', 'view_event_category', 'edit_event_category', 'delete_event_category',
        'create_event', 'view_event', 'edit_own_event', 'edit_all_event', 'delete_own_event', 'delete_all_event',
    ];

    public function run(): void
    {

        $super_admin_role = Role::create(['name' => 'super_admin']);
        $user_role = Role::create(['name' => 'user']);

        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $super_admin_role->givePermissionTo($this->permissions);
        $user_role->givePermissionTo([
            'view_user',
            'view_event_category',
            'create_event',
            'view_event',
            'edit_own_event',
            'delete_own_event',
        ]);
    }
}
