<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'a@a.a',
            'user_type' => 1,
        ]);
        User::factory()->create([
            'name' => 'teacher',
            'email' => 't@t.t',
            'user_type' => 2,
        ]);
        User::factory()->create([
            'name' => 'student',
            'email' => 's@s.s',
            'user_type' => 3,
        ]);
        User::factory()->create([
            'name' => 'parent',
            'email' => 'p@p.p',
            'user_type' => 4,
        ]);
    }
}
