<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use DB;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('permissions')->insert([


             // Frontend Module
            ['id' => 1, 'parent_id' => null, 'name' => 'frontend', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Dashboard Module
            ['id' => 2, 'parent_id' => null, 'name' => 'dashboard', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
           
            // Role Module
            ['id' => 3, 'parent_id' => null, 'name' => 'role', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'parent_id' => 3, 'name' => 'role-list', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'parent_id' => 3, 'name' => 'role-create', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'parent_id' => 3, 'name' => 'role-edit', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'parent_id' => 3, 'name' => 'role-delete', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // User Module
            ['id' => 8, 'parent_id' => null, 'name' => 'user', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'parent_id' => 8, 'name' => 'user-list', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'parent_id' => 8, 'name' => 'user-create', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'parent_id' => 8, 'name' => 'user-edit', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'parent_id' => 8, 'name' => 'user-delete', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'parent_id' => 8, 'name' => 'user-show', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Type Module
            ['id' => 14, 'parent_id' => null, 'name' => 'type', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 15, 'parent_id' => 14, 'name' => 'type-list', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'parent_id' => 14, 'name' => 'type-create', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 17, 'parent_id' => 14, 'name' => 'type-edit', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 18, 'parent_id' => 14, 'name' => 'type-delete', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],

            // Work Areas Module
            ['id' => 19, 'parent_id' => null, 'name' => 'work-areas', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 20, 'parent_id' => 19, 'name' => 'work-areas-list', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 21, 'parent_id' => 19, 'name' => 'work-areas-create', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 22, 'parent_id' => 19, 'name' => 'work-areas-edit', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 23, 'parent_id' => 19, 'name' => 'work-areas-delete', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
