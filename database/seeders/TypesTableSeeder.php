<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('types')->insert([
            ['name' => 'Trust and Foundation', 'description' => 'Trust and Foundation', 'status' => 1],
            ['name' => 'Corporate Foundation ', 'description' => 'Corporate Foundation', 'status' => 1],
            ['name' => 'Competitors', 'description' => 'Competitors', 'status' => 1],
        ]);
    }
}
