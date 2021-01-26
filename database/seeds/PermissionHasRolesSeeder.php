<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permission_has_role = config('modules.permission_has_role');

        foreach ($permission_has_role as $role => $permission) {
            foreach ($permission as $p) {
                DB::table('role_has_permissions')
                    ->insert([
                        'role_id' => $role,
                        'permission_id' => $p
                    ]);
            }
        }

        DB::table('role_has_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 1
        ]);

        DB::table('role_has_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 2
        ]);

        DB::table('role_has_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 5
        ]);

        DB::table('role_has_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 6
        ]);
    }
}
