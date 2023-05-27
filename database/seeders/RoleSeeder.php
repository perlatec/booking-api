<?php

namespace Database\Seeders;

use App\Enums\Constants;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(
            ['name' => Constants::ROLE_ADMIN]
        );
        Role::create(
            ['name' => Constants::ROLE_AGENT],
        );
        Role::create(
            ['name' => Constants::ROLE_CLIENT],
        );
        Role::create(
            ['name' => Constants::ROLE_COMERCIAL],
        );
        Role::create(
            ['name' => Constants::ROLE_DEVELOPER],
        );
    }
}
