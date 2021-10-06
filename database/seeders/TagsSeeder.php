<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 3; $i++) {
            DB::table('tags')->insert([
                'name' => 'Tag ' . $i,
                'slug' => "Tag-".$i,
                'description' => 'A tag is a keyword or label that categorizes your question with other, similar
                questions. Using the right tags makes it easier for others to find and answer your question.',
            ]);
        }
    }
}
