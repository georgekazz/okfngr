<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        $adminExists = User::where('email', 'grkazz98@gmail.com')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'George Kazlaris',
                'email' => 'grkazz98@gmail.com',
                'password' => Hash::make('1998@Sfinas'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);

            $this->command->info('✓ Admin user created: George Kazlaris');
        } else {
            $this->command->warn('⚠ Admin user already exists. Skipping...');
        }
    }
}