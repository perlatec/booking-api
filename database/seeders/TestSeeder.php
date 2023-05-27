<?php

namespace Database\Seeders;

use App\Enums\Constants;
use App\Models\Booking\Offer;
use App\Models\Booking\Provider;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            DatabaseSeeder::class
        ]);

        $this->seedUsers();
        $this->seedBookingProviders();
        $this->seedBookingOffers(10, 10);
    }

    /**
     * seedBookingOffers
     *
     * @param  int $limit
     * @param  int $repeat
     * @return void
     */
    private function seedBookingOffers(int $limit = 10, int $repeat = 1)
    {
        $faker = Factory::create();

        for ($r = 0; $r < $repeat; $r++) {
            $data = [];
            for ($l = 0; $l < $limit; $l++) {
                array_push($data, [
                    'provider_id' => $faker->numberBetween(1, Provider::count()),
                    'name' => $faker->words(4, true),
                    'description' => $faker->text(),
                    'type' => $faker->word,
                    'max_adults' => $faker->numberBetween(1, 5),
                    'max_childs' => $faker->numberBetween(1, 5),
                    'price_adult' => $faker->numberBetween(50, 200),
                    'price_child' => $faker->numberBetween(50, 200),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            Offer::query()->insert($data);
        }
    }

    /**
     * seedBookingProviders
     *
     * @param  int $limit
     * @param  int $repeat
     * @return void
     */
    private function seedBookingProviders(int $limit = 10, int $repeat = 1)
    {
        $faker = Factory::create();

        for ($r = 0; $r < $repeat; $r++) {
            $data = [];
            for ($l = 0; $l < $limit; $l++) {
                array_push($data, [
                    'name' => $faker->city,
                    'description' => $faker->text(),
                    'api_token' => bcrypt('api_token'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            Provider::query()->insert($data);
        }
    }

    /**
     * seedUsers
     *
     * @param  int $limit
     * @param  int $repeat
     * @return void
     */
    private function seedUsers(int $limit = 10, int $repeat = 1)
    {
        $developer = User::create([
            'name' => 'Developer',
            'email' => 'developer@perlatec.tech',
            'password' => bcrypt('password')
        ]);
        $developer->assignRole(Constants::ROLE_DEVELOPER);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@perlatec.tech',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole(Constants::ROLE_ADMIN);

        $faker = Factory::create();
        for ($r = 0; $r < $repeat; $r++) {
            for ($l = 0; $l < $limit; $l++) {
                $user = User::create([
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'password' => bcrypt('password')
                ]);

                $user->assignRole($faker->randomElement([
                    Constants::ROLE_AGENT,
                    Constants::ROLE_COMERCIAL,
                ]));
            }
        }
    }
}
