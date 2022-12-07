<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'English',
            'uuid' => Str::uuid(),
            'flag' => 'test',
            'short_name' => 'en',
            'status' => 1,
            'is_default' => 'Yes'
        ]);
    }
}
