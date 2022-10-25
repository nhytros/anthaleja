<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Roles_and_Permissions::class);
        $this->call(Users_and_Characters::class);
        $this->call(Market_Sections_and_Categories::class);
        $this->call(Market_Brands::class);
        $this->call(Market_Products::class);
        // $this->call(Korfball::class);
    }
}
