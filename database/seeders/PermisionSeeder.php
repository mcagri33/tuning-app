<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'create language']);
        Permission::create(['name' => 'settings']);
        Permission::create(['name' => 'create car brands']);
        Permission::create(['name' => 'create car models']);
        Permission::create(['name' => 'create car brains']);

    }
}
