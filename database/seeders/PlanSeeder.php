<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Plan::factory(30)->create();
    }
}
