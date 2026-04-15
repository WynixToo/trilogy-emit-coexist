<?php

namespace Database\Seeders;

use App\Models\Announcements;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Customer 1',
            'email' => 'testCustomer_1@example.com',
        ]);

        User::factory()->create([
            'name' => 'Test Customer 2',
            'email' => 'testCustomer_2@example.com',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            Announcements::create([
                'title' => 'Test Announcement '.$i,
                'description' => 'Test Announcement Description '.$i,
            ]);
        }

        DB::table('announcement_read')->insert([
            'announcement_id' => 1,
            'user_id' => 1,
            'read_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);





    }
}
