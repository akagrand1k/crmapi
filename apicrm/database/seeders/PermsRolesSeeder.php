<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perm_role')->insert(AppsPermsRoles::seeds('PermsRoles'));/*
        DB::table('perm_role')->insert([
            // student
            [
                'role_id' => 1, 'perm_id' => 4   // About.*
            ],
            // teacher
            [
                'role_id' => 2, 'perm_id' => 2   // Users.read
            ],[
                'role_id' => 2, 'perm_id' => 4   // About.*
            ],
            // admin
            [
                'role_id' => 3, 'perm_id' => 1   // Pages.*
            ],[
                'role_id' => 3, 'perm_id' => 2   // Users.read
            ],[
                'role_id' => 3, 'perm_id' => 3   // Users.update
            ],[
                'role_id' => 2, 'perm_id' => 4   // About.*
            ],
            // owner
            [
                'role_id' => 4, 'perm_id' => 1   // Pages.*
            ],[
                'role_id' => 4, 'perm_id' => 2   // Users.read
            ],[
                'role_id' => 4, 'perm_id' => 3   // Users.update
            ],[
                'role_id' => 4, 'perm_id' => 4   // About.*
            ],[
                'role_id' => 4, 'perm_id' => 6   // Roles.*
            ],[
                'role_id' => 4, 'perm_id' => 7   // Company.*
            ],[
                'role_id' => 4, 'perm_id' => 8   // Сourse.*
            ],[
                'role_id' => 4, 'perm_id' => 9   // Teachers.*
            ],[
                'role_id' => 4, 'perm_id' => 10   // Gangs.*
            ],
            // saleman
            [
                'role_id' => 5, 'perm_id' => 1   // Pages.*
            ],[
                'role_id' => 5, 'perm_id' => 2   // Users.read
            ],[
                'role_id' => 5, 'perm_id' => 4   // About.*
            ],
            // superadmin
            [
                'role_id' => 6, 'perm_id' => 1   // Pages.*
            ],[
                'role_id' => 6, 'perm_id' => 2   // Users.read
            ],[
                'role_id' => 6, 'perm_id' => 3   // Users.update
            ],[
                'role_id' => 6, 'perm_id' => 4   // About.*
            ],[
                'role_id' => 6, 'perm_id' => 5   // Test.*
            ],[
                'role_id' => 6, 'perm_id' => 6   // Roles.*
            ]
        ]);*/
    }
}
