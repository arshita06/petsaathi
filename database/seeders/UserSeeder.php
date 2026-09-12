<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hasEmailVerifiedAt = Schema::hasColumn('users', 'email_verified_at');
        $hasIsActive = Schema::hasColumn('users', 'is_active');

        $users = [
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '9876500001',
                'address' => 'Sector 3, Mumbai, Maharashtra',
            ],
            [
                'name' => 'Kavya Sharma',
                'email' => 'kavya@example.com',
                'phone' => '9876500002',
                'address' => 'Andheri West, Mumbai, Maharashtra',
            ],
            [
                'name' => 'Gaven Dsouza',
                'email' => 'gaven@example.com',
                'phone' => '9876500003',
                'address' => 'Bandra, Mumbai, Maharashtra',
            ],
            [
                'name' => 'Priya Mehta',
                'email' => 'priya@example.com',
                'phone' => '9876500004',
                'address' => 'Koregaon Park, Pune, Maharashtra',
            ],
        ];

        foreach ($users as $user) {
            $attributes = [
                ...$user,
                'password' => Hash::make('password'),
            ];

            if ($hasEmailVerifiedAt) {
                $attributes['email_verified_at'] = now();
            }

            if ($hasIsActive) {
                $attributes['is_active'] = true;
            }

            User::updateOrCreate(
                ['email' => $user['email']],
                $attributes,
            );
        }
    }
}
