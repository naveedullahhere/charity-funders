<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('work_areas')->insert([
            ['name' => 'Children, young people and families', 'description' => 'Description for Children, young people and families', 'status' => 1],
            ['name' => 'General charitable purposes', 'description' => 'Description for General charitable purposes', 'status' => 1],
            ['name' => 'Older people', 'description' => 'Description for Older people', 'status' => 1],
            ['name' => 'Health', 'description' => 'Description for Religion', 'status' => 1],
            ['name' => 'Disability', 'description' => 'Description for Disability', 'status' => 1],
            ['name' => 'Unemployed', 'description' => 'Description for Unemployed', 'status' => 1],
            ['name' => 'Physical disabilities', 'description' => 'Description for Physical disabilities', 'status' => 1],
            ['name' => 'Females and women', 'description' => 'Description for Females and women', 'status' => 1],
            ['name' => 'Mental health', 'description' => 'Description for Mental health', 'status' => 1],
            ['name' => 'Substance misuse/abusers', 'description' => 'Description for Substance misuse/abusers', 'status' => 1],
            ['name' => 'Victims of disasters and famine', 'description' => 'Description for Victims of disasters and famine', 'status' => 1],
            ['name' => 'Victims of war and torture', 'description' => 'Description for Victims of war and torture', 'status' => 1],
        ]);
    }
}
