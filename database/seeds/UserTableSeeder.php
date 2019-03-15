<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();

        \DB::table('users')->insert([
            [
                'name'     => 'Admin',
                'email'    => 'admin@neo-lab.vn',
                'password' => bcrypt('password'),
            ],
            [
                'name'     => 'Hoàng thượng',
                'email'    => 'king@neo-lab.vn',
                'password' => bcrypt('kingpass'),
            ],
            [
                'name'     => 'Hoàng Kim',
                'email'    => 'jewerly@neo-lab.vn',
                'password' => bcrypt('jewerlypass'),
            ],
            [
                'name'     => 'Hoàng Hà',
                'email'    => 'river@neo-lab.vn',
                'password' => bcrypt('riverpassword'),
            ],
            [
                'name'     => 'Hoàng Sơn',
                'email'    => 'm@neo-lab.vn',
                'password' => bcrypt('mountainpassword'),
            ]
        ]);

        factory(App\Entities\User::class, 50)
            ->create();
    }
}
