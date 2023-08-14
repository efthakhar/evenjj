<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a user
        $created_user_id = DB::table('users')->insertGetId([
            'name' => 'superadmin',
            'email' => 'superadmin@evenjj.com',
            'password' => Hash::make('superadmin'),
        ]);

        // get the user by id
        $created_user = User::find($created_user_id);

        // assign super-admin role to created user
        $created_user->assignRole('super_admin');
    }
}
