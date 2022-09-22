<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $username = $this->faker->userName;
        $discriminator = $this->faker->randomNumber(4);

        return [
            'id' => $this->faker->uuid,
            'username' => $username,
            'discriminator' => $discriminator,
            'email' => $this->faker->email,
            'avatar' => "doesntmatter",
            'verified' => $this->faker->boolean,
            'locale' => $this->faker->locale,
            'mfa_enabled' => $this->faker->boolean,
            'refresh_token' => $this->faker->uuid,
            'slug' => Str::slug($username . "-" . $discriminator),
        ];
    }
}
