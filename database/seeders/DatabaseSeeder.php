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
            'name' => 'Admin',
            'email' => config('app.env') === 'local' ? 'admin@gmail.com' : 'admin@realigndental.com',
            'password' => config('app.env') === 'local' ? bcrypt('123') : bcrypt('Realigndental@#2025'),
        ]);

        $this->call([
            ServiceSeeder::class,
            TeamSeeder::class,
            ReviewSeeder::class,
            ReelSeeder::class,
            YoutubeVideoSeeder::class,
            BranchSeeder::class,
            FaqSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
