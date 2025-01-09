<?php

namespace Database\Factories;

use App\Models\Receiver;
use App\Models\Tracking;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceiverFactory extends Factory
{
    protected $model = Receiver::class;

    public function definition()
    {
        return [
            'tracking_id' => Tracking::factory(),
            'name' => $this->faker->name(),
            'street_address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'no_handphone' => $this->faker->phoneNumber(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Tanggal dibuat acak
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
