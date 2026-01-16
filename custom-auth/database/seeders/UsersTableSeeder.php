<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    User::factory()->createMany([
        [
            'username' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => 'senha123',
            'verified_at' => Carbon::now(),
            'active' => true,
        ],
        [
            'username' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => 'senha123',
            'verified_at' => Carbon::now(),
            'active' => true,
        ],
        [
            'username' => 'user3',
            'email' => 'user3@gmail.com',
            'password' => 'senha123',
            'verified_at' => Carbon::now(),
            'active' => true,
        ],
    ]);
}

}
