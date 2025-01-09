<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Models\Tracking;
use App\Models\Sender;
use App\Models\Receiver;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition()
    {
        $tracking = Tracking::factory()->create();
        $sender = Sender::factory()->create(['tracking_id' => $tracking->id]);
        $receiver = Receiver::factory()->create(['tracking_id' => $tracking->id]);

        return [
            'package_description' => $this->faker->sentence(),
            'tracking_id' => $tracking->id,
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'type' => $this->faker->randomElement(['Elektronik', 'Extra/Sensitive', 'Komoditi Umum', 'Kosmetik, Makanan atau Herbal']),
            'weight' => $this->faker->randomFloat(2, 0.5, 50),
            'quantity' => $this->faker->numberBetween(1, 10),
            'height' => $this->faker->randomFloat(2, 10, 100),
            'width' => $this->faker->randomFloat(2, 10, 100),
            'length' => $this->faker->randomFloat(2, 10, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
