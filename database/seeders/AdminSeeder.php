<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = User::create([
            'name' => 'cagri',
            'email' => 'mehmetcagrikaratas@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('669669bc'),
        ]);
        $user->assignRole('accounting','tuner', 'admin');

    }
}
