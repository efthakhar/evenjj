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

        Permission::truncate();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Role::truncate();
        DB::table('users')->truncate();
        DB::table('event_categories')->truncate();

        $this->call(PermissionSeeder::class);
        $this->call(SuperAdmin::class);
        $this->call(EventCategory::class);

        Schema::enableForeignKeyConstraints();
    }
}
