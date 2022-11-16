<?php

namespace Database\Seeders;

use App\Models\Auth\User;
use Faker\Factory as Faker;
use App\Models\Market\Vendor;
use App\Models\Auth\Character;
use App\Models\Market\VendorBD;
use Illuminate\Database\Seeder;
use App\Models\Market\VendorBank;

class Users_and_Characters extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        User::create([
            'username' => 'admin',
            'email' => 'admin@anthaleja.ovh',
            'password' => bcrypt('password', ['rounds' => 12]),
            'status' => 1,
        ])->assignRole('user', 'admin');

        User::create([
            'username' => 'jjnhytros',
            'email' => 'jjnhytros@anthaleja.ovh',
            'password' => bcrypt('password', ['rounds' => 12]),
            'status' => 1,
        ])->assignRole('user', 'governor');

        Character::create([
            'user_id' => 2,
            'first_name' => 'Jerome',
            'last_name' => 'Nhytros',
            'username' => 'jjnhytros',
            'gender' => 'male',
            'height' => '186',
            'date_of_birth' => '1973-09-24',
            'bank_account' => 'ATH-6743244',
            'bank_amount' => $faker->numberBetween(5e5, 10e8) / 100,
            'cash' => $faker->numberBetween(5e5, 10e8) / 100,
            'metals' => $faker->numberBetween(1, 100),
            'has_phone' => true,
            'phone_no' => '000-9238',
            'avatar' => null,
            'thirst' => 0,
            'hunger' => 0,
            'energy' => 100,
            'status' => true,
        ]);
        $users = User::count();

        for ($u = $users + 1; $u <= 36; $u++) {
            $is_vendor = $faker->boolean(15);
            $user = User::create([
                'id' => $u,
                'username' => $faker->unique()->userName(),
                'email' => $faker->unique()->email(),
                'password' => bcrypt('password', ['rounds' => 12]),
                'status' => 1,
            ])->assignRole('user');

            $gender = $faker->boolean(50) ? 'male' : 'female';

            $ch = Character::create([
                'user_id' => $u,
                'first_name' => $faker->firstName($gender),
                'last_name' => $faker->lastName(),
                'username' => $faker->userName(),
                'gender' => $gender,
                'height' => $faker->numberBetween(160, 210),
                'date_of_birth' => $faker->dateTimeBetween('-60 Years', '-18 Years'),
                'bank_account' => 'ATH-' . $faker->numberBetween(1000000, 3999999),
                'bank_amount' => 500,
                'cash' => 0,
                'metals' => 0,
                'has_phone' => true,
                'phone_no' => $faker->numerify('888-####'),
                'avatar' => null,
                'thirst' => $thirst = $faker->numberBetween(0, 30),
                'hunger' => $hunger = $faker->numberBetween(0, 10),
                'energy' => 100 - ($thirst / 2) - ($hunger * 2),
                'status' => $faker->boolean(12) ? false : true,
            ]);

            // Vendor
            if ($is_vendor) {
                $user->assignRole('vendor');

                // Vendor
                $v = Vendor::create([
                    'character_id' => $ch->id,
                    'status' => $vstatus = $faker->boolean(40),
                ]);

                // Vendor Businness Details
                $vbd = VendorBD::create([
                    'vendor_id' => $v->id,
                    'shop_name' => $faker->unique()->company(),
                    'shop_address' => $faker->unique()->streetAddress(),
                    'shop_phone' => $faker->unique()->numerify('900-####'),
                    'shop_website' => $faker->unique()->url(),
                    'shop_email' => $faker->domainWord() . '@' . $faker->unique()->domainName(),
                    'address_proof' => null,
                    'address_proof_image' => null,
                    'license_code' => genLicence($faker->unique()->numberBetween(1000000, 9999999)),
                    'status' => $vstatus,
                ]);

                // Vendor Bank Details
                $vbank = VendorBank::create([
                    'vendor_id' => $v->id,
                    'bank_account' => 'ATH-' . $faker->unique()->numberBetween(44444444, 66666666),
                    'bank_amount' => 0,
                    'status' => $vstatus,
                ]);
            }
        }
    }
}
