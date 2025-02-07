<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'berat barulay',
            'email' => 'berat123@gmail.com',
            'password' => password_hash('berat123', PASSWORD_DEFAULT)
        ])->assignRole('super-admin');
        User::factory()->create([
            'name' => 'poyraz boran',
            'email' => 'poyraz@gmail.com',
            'password' => password_hash('berat123', PASSWORD_DEFAULT)
        ])->assignRole('author');
        $this->call([
            PolicySeeder::class,
        ]);
    }
}
