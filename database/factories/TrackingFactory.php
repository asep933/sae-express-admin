<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tracking;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackingFactory extends Factory
{
    protected $model = Tracking::class;

    public function definition()
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'awb_number' => $this->faker->unique()->numerify('##########'), // 10 digit angka acak
            'status' => $this->faker->randomElement(['In Transit', 'Delivered', 'Pending', 'Returned']),
            'location' => $this->faker->city(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'), // Tanggal dibuat acak
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
