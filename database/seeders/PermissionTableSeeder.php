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
            ['id' => 1, 'parent_id' => null, 'name' => 'role', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 2, 'parent_id' => 1, 'name' => 'role-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 3, 'parent_id' => 1, 'name' => 'role-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 4, 'parent_id' => 1, 'name' => 'role-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 5, 'parent_id' => 1, 'name' => 'role-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 6, 'parent_id' => null, 'name' => 'user', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 7, 'parent_id' => 6, 'name' => 'user-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 8, 'parent_id' => 6, 'name' => 'user-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 9, 'parent_id' => 6, 'name' => 'user-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 10, 'parent_id' => 6, 'name' => 'user-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 11, 'parent_id' => 6, 'name' => 'user-show', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 12, 'parent_id' => null, 'name' => 'dashboard', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
        ]);
    }
}
