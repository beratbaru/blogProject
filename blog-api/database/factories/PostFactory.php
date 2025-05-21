<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'image' => 'https://picsum.photos/200',
            'activationDate' => Carbon::today(),
            'deactivationDate' => Carbon::tomorrow(),
            'status' => 'active',
        ];
    }
}
