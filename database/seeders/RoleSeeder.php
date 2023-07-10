<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $list = [
            [
                'name' => 'Admin',
                'permission' => ["report", "stock", "user", "sales", "product", "category", "customers"]
            ],
            [
                'name' => 'Depocu',
                'permission' => ["stock"]
            ],
            [
                'name' => 'Satış',
                'permission' => ["sales"]
            ]
        ];

        foreach ($list as $item)
            Role::create($item);
    }
}
