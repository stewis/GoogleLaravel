<?php

use Illuminate\Database\Seeder;

class RestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Restaurant::class, 30)->create()->each(function ($restaurant) {
            $restaurant->addresses()->saveMany(factory(App\Address::class, mt_rand(1,6))->make());
        });
    }
}
