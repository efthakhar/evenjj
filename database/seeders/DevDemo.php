<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DevDemo extends Seeder
{
    public function run(): void
    {
        Cache::flush();
        Schema::disableForeignKeyConstraints();

        // Permission::truncate();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Role::truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();

        DB::table('users')->truncate();
        DB::table('event_categories')->truncate();
        DB::table('events')->truncate();

        $this->call(PermissionSeeder::class);
        $this->call(SuperAdmin::class);
        $this->call(EventCategory::class);
        $this->call(EventSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
