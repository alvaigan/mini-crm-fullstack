<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'admin',    'label' => 'Administrator'],
            ['id' => 2, 'name' => 'manager',  'label' => 'Manager'],
            ['id' => 3, 'name' => 'staff',    'label' => 'Staff'],
            ['id' => 4, 'name' => 'customer', 'label' => 'Customer'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['id' => $role['id']],
                $role
            );
        }
    }
}
