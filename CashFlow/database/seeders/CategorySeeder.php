<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            'Salary',
            'Freelance',
            'Food',
            'Rent',
            'Utilities',
            'Transport',
            'Health',
            'Education',
            'Entertainment',
            'Shopping',
            'Savings',
            'Other',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
