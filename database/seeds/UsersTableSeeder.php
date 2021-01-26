<?php

use Illuminate\Database\Seeder;
use App\User;

use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'username' => 'admin',
            'password' => bcrypt('Admin$%'),
            'email' => 'admin@serempre.com.co',
            'is_admin' => 1
        ]);

        $user = User::where('username', 'admin')->first();
        $user->assignRole('Administrador');

        DB::table('users')->insert([
            'name' => 'Manuel',
            'last_name' => 'Buriticá',
            'username' => 'mburitica',
            'password' => bcrypt('Manuel$%'),
            'email' => 'mburitica@serempre.com.co',
            'is_admin' => 0
        ]);

        $user = User::where('username', 'mburitica')->first();
        $user->assignRole(2);
    }
}
