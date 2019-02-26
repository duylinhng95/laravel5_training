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
        $userId = \DB::table('users')
            ->select('id')
            ->where('name', 'Admin')
            ->orWhere('name', 'like', '%Hoàng%')->get();

        $roleId = \DB::table('roles')
            ->select('id')
            ->where('name', 'admin')
            ->orWhere('name', 'user')->get();

        DB::table('user_roles')->truncate();

        \DB::table('user_roles')->insert([
            'user_id' => $userId[0]->id,
            'role_id' => $roleId[1]->id,
        ]);

        unset($userId[0]);

        foreach ($userId as $user) {
            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => $roleId[0]->id
            ]);
        }
    }
}
