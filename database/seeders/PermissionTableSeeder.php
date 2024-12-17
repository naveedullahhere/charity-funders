<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions based on the provided SQL data
        DB::table('permissions')->insert([
            ['id' => 1, 'parent_id' => NULL, 'name' => 'role', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 2, 'parent_id' => 1, 'name' => 'role-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 3, 'parent_id' => 1, 'name' => 'role-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 4, 'parent_id' => 1, 'name' => 'role-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 5, 'parent_id' => 1, 'name' => 'role-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 6, 'parent_id' => NULL, 'name' => 'user', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 7, 'parent_id' => 6, 'name' => 'user-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 8, 'parent_id' => 6, 'name' => 'user-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 9, 'parent_id' => 6, 'name' => 'user-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 10, 'parent_id' => 6, 'name' => 'user-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 11, 'parent_id' => 6, 'name' => 'user-show', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 12, 'parent_id' => NULL, 'name' => 'airport', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 13, 'parent_id' => 12, 'name' => 'airport-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 14, 'parent_id' => 12, 'name' => 'airport-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 15, 'parent_id' => 12, 'name' => 'airport-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 16, 'parent_id' => 12, 'name' => 'airport-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 17, 'parent_id' => NULL, 'name' => 'page', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 18, 'parent_id' => 17, 'name' => 'page-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 19, 'parent_id' => 17, 'name' => 'page-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 20, 'parent_id' => 17, 'name' => 'page-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 21, 'parent_id' => 17, 'name' => 'page-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 22, 'parent_id' => NULL, 'name' => 'type', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 23, 'parent_id' => 22, 'name' => 'type-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 24, 'parent_id' => 22, 'name' => 'type-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 25, 'parent_id' => 22, 'name' => 'type-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 26, 'parent_id' => 22, 'name' => 'type-show', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 27, 'parent_id' => 22, 'name' => 'type-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 39, 'parent_id' => NULL, 'name' => 'product', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 40, 'parent_id' => 39, 'name' => 'product-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 41, 'parent_id' => 39, 'name' => 'product-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 42, 'parent_id' => 39, 'name' => 'product-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 43, 'parent_id' => 39, 'name' => 'product-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 44, 'parent_id' => NULL, 'name' => 'provider', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 45, 'parent_id' => 44, 'name' => 'provider-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 46, 'parent_id' => 44, 'name' => 'provider-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 47, 'parent_id' => 44, 'name' => 'provider-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 48, 'parent_id' => 44, 'name' => 'provider-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 50, 'parent_id' => NULL, 'name' => 'discount', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 51, 'parent_id' => 50, 'name' => 'discount-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 52, 'parent_id' => 50, 'name' => 'discount-create', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 53, 'parent_id' => 50, 'name' => 'discount-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 54, 'parent_id' => 50, 'name' => 'discount-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:10', 'updated_at' => '2024-04-03 11:09:10'],
            ['id' => 55, 'parent_id' => NULL, 'name' => 'frontend', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 56, 'parent_id' => NULL, 'name' => 'newsletter', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 57, 'parent_id' => 56, 'name' => 'newsletter-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 58, 'parent_id' => NULL, 'name' => 'bookings', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 59, 'parent_id' => 58, 'name' => 'bookings-list', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 60, 'parent_id' => 58, 'name' => 'bookings-delete', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 61, 'parent_id' => 58, 'name' => 'bookings-edit', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
            ['id' => 62, 'parent_id' => NULL, 'name' => 'dashboard', 'guard_name' => 'web', 'created_at' => '2024-04-03 11:09:09', 'updated_at' => '2024-04-03 11:09:09'],
        ]);

    }
}
