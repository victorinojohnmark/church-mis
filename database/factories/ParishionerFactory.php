<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Parishioner;

class ParishionerFactory extends Factory
{
    protected $model = Parishioner::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date,
            'address' => $this->faker->address,
            'contact_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('pass'),
            'is_admin' => false,
        ];
    }
}
