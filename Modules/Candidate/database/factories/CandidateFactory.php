<?php

namespace Modules\Candidate\Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Candidate\Models\Candidate;

class CandidateFactory extends Factory
{

    protected $model = Candidate::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->e164PhoneNumber(),
            'password' => bcrypt('password'),
            'occupation' => $this->faker->jobTitle(),
        ];
    }
}
