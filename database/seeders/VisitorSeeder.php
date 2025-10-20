<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 40 gun ucun random visitor elave et

        $data = [];
        for ($i = 0; $i < 10000; $i++) {
            $data[] = [
                'ip_address' => fake()->ipv4(),
                'created_at' => fake()->dateTimeBetween('-40 days', 'now'),
                'updated_at' => fake()->dateTimeBetween('-40 days', 'now')
            ];

        }

        Visitor::insert($data);
    }
}
