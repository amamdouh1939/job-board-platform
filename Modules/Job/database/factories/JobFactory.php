<?php

namespace Modules\Job\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Company\Models\Company;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Job\Models\Job::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::inRandomOrder()->first()->id,
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->realText(),
            'location' => $this->faker->city(),
            'salary_range' => $this->faker->randomNumber(5) . '$ - ' . $this->faker->randomNumber(6) . '$',
            'is_remote' => $this->faker->boolean(),
            'published_at' => $this->faker->date(),
        ];
    }
}

