<?php

namespace Database\Factories;

use App\Models\Sender;
use App\Models\Tracking;
use Illuminate\Database\Eloquent\Factories\Factory;

class SenderFactory extends Factory
{
    protected $model = Sender::class;

    public function definition()
    {
        return [
            'tracking_id' => Tracking::factory(),
            'name' => $this->faker->name(),
            'street_address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'no_handphone' => $this->faker->phoneNumber(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Tanggal dibuat acak
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
