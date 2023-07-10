<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */


    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table("users")->insert([
            'name' => 'Test User',
            'mail' => 'test@example.com',
            'password' => bcrypt('asd123'),
            'status' => 1,
            'role_id' => 1
        ]);
        DB::table("users")->insert([
            'name' => 'Engin Boyner',
            'mail' => 'a@a.com',
            'password' => bcrypt('asd123'),
            'status' => 1,
            'role_id' => 1

        ]);
        DB::table("users")->insert([
            'name' => 'Cem Kaan',
            'mail' => 'b@b.com',
            'password' => bcrypt('asd123'),
            'status' => 1,
            'role_id' => 2

        ]);
        DB::table("users")->insert([
            'name' => 'Hasan Gül',
            'mail' => 'c@c.com',
            'password' => bcrypt('asd123'),
            'status' => 1,
            'role_id' => 3

        ]);
    }
}
