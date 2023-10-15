<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $adminUser = new User;
        $adminUser->name = 'admin';
        $adminUser->email = 'admin@mail.com';
        $adminUser->password = Hash::make('admin1234');
        $adminUser->is_admin = true;
        $adminUser->save();

    }
}
