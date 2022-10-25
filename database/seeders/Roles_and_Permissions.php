<?php

namespace Database\Seeders;

use App\Models\Auth\{Role, Permission};
use Illuminate\Database\Seeder;

class Roles_and_Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        Role::create(['name' => 'admin', 'priority' => -24]);
        Role::create(['name' => 'governor', 'priority' => -12]);
        Role::create(['name' => 'staff', 'priority' => -6]);
        Role::create(['name' => 'vendor']);
        Role::create(['name' => 'user']);

        // Permissions
        // -- Users
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'users-list']);
        Permission::create(['name' => 'users-show']);
        Permission::create(['name' => 'users-edit']);
        Permission::create(['name' => 'users-update']);
        Permission::create(['name' => 'users-delete']);
        Permission::create(['name' => 'users-restore']);
        Permission::create(['name' => 'users-destroy']);

        // -- Characters
        Permission::create(['name' => 'characters']);
        Permission::create(['name' => 'characters-list']);
        Permission::create(['name' => 'characters-show']);
        Permission::create(['name' => 'characters-edit']);
        Permission::create(['name' => 'characters-update']);
        Permission::create(['name' => 'characters-delete']);
        Permission::create(['name' => 'characters-restore']);
        Permission::create(['name' => 'characters-destroy']);

        // -- Market
        Permission::create(['name' => 'market']);

        // -- Market > Sections
        Permission::create(['name' => 'market-sections']);
        Permission::create(['name' => 'market-sections-list']);
        Permission::create(['name' => 'market-sections-show']);
        Permission::create(['name' => 'market-sections-edit']);
        Permission::create(['name' => 'market-sections-update']);
        Permission::create(['name' => 'market-sections-delete']);
        Permission::create(['name' => 'market-sections-restore']);
        Permission::create(['name' => 'market-sections-destroy']);

        // -- Market > Categories
        Permission::create(['name' => 'market-categories']);
        Permission::create(['name' => 'market-categories-list']);
        Permission::create(['name' => 'market-categories-show']);
        Permission::create(['name' => 'market-categories-edit']);
        Permission::create(['name' => 'market-categories-update']);
        Permission::create(['name' => 'market-categories-delete']);
        Permission::create(['name' => 'market-categories-restore']);
        Permission::create(['name' => 'market-categories-destroy']);
    }
}
