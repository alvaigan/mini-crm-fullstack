<?php

namespace Database\Seeders;

use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Roles::get();

        foreach($roles as $role) {
            $phone = fake()->phoneNumber();
            $name = fake()->name();
            $company = fake()->company();
            $now = Carbon::now();

            DB::table('contacts')->updateOrInsert(
                ['phone' => $phone],
                [
                    'name' => $name,
                    'company' => $company,
                    'role_id' => $role->id,
                    'phone' => $phone, // <- Important to include
                    'updated_at' => $now,
                    'created_at' => $now,
                ]
            );
        }
    }
}
