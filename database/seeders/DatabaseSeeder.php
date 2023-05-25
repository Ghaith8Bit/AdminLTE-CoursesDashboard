<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(CourseSeeder::class);

        \App\Models\User::factory(25)->create();

        \App\Models\User::create([
            'name' => 'Super User',
            'email' => 'admin@ibp.com',
            'password' => bcrypt('password'),
            'role_id' => 2
        ]);
    }
}
