<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            ['name' => "NEWS"],
            ['name' => "PHP"],
            ['name' => "IOS"],
            ['name' => "ANDROID"]
        ]);
    }
}