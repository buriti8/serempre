<?php

use App\Models\City;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionHasRolesSeeder::class);

        factory(City::class, 50)->create();
        factory(Customer::class, 50)->create();
    }
}
