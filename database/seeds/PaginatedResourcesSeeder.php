<?php

use App\Models\PaginatedResource;

class PaginatedResourcesSeeder extends BaseSeeder
{
    /**
     * Run fake seeds - for non production environments
     *
     * @return mixed
     */
    public function runFake() {
        for ($i = 1; $i <= 100; ++$i) {
            PaginatedResource::create([
                'name' => $this->faker->word,
                'ordering' => $i,
            ]);
        }
    }

    /**
     * Run seeds to be ran only on production environments
     *
     * @return mixed
     */
    public function runProduction() {

    }

    /**
     * Run seeds to be ran on every environment (including production)
     *
     * @return mixed
     */
    public function runAlways() {

    }
}
