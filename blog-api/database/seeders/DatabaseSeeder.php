<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ShieldSeeder::class);
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'berat',
            'email' => 'berat12@gmail.com',
            'password' => password_hash('berat123', PASSWORD_DEFAULT)
        ])->assignRole('super-admin');
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT)
        ])->assignRole('super-admin');

        User::factory()->create([
            'name' => 'author',
            'email' => 'author@gmail.com',
            'password' => password_hash('author123', PASSWORD_DEFAULT)
        ])->assignRole('author');
        $this->call([
            PolicySeeder::class,
        ]);
        //could use this to create posts
        // \App\Models\Post::factory()->count(30)->create();

    }
}
