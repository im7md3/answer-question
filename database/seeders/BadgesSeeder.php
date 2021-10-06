<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            DB::table('badges')->insert([
                'name' => 'badge ' . $i,
                'type' => "1",
                'score' => 15*$i,
            ]);
        }
    }
}
