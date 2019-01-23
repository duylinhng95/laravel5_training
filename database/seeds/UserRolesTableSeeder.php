<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = \DB::table('users')->select('id')->where('name', 'Admin')->first();
        $roleId = \DB::table('roles')->select('id')->where('name', 'admin')->first();
        \DB::table('user_roles')->insert([
            'user_id' => $userId->id,
            'role_id' => $roleId->id,
        ]);
    }
}
