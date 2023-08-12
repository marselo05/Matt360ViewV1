<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'title'      => $this->faker->sentence(),
             'url_size_1' => $this->faker->image('public/assets/images/small/', 400, 300, null, false),
             'url_size_2' => $this->faker->image('public/assets/images/medium/', 400, 300, null, false),
             'tag_id'     => $this->faker->randomElement([1,2,3]),
             'user_id'    => $this->faker->randomElement([1,2,3]),
             'state'      => $this->faker->randomElement([0,1])
        ];
    }
}


// 'first_name'  => $this->faker->firstName,
// 'last_name'   => $this->faker->lastName,
// 'email'       => $this->faker->unique()->safeEmail,
// 'phone'       => $this->faker->phoneNumber,
// 'image'       => $this->faker->image('public/assets/images/uploaded/clients', 400, 300, null, false),
// 'address'     => $this->faker->streetAddress,
// 'city'        => $this->faker->city,
// 'state'       => $this->faker->stateAbbr,
// 'zip'         => $this->faker->postcode,
// 'country'     => $this->faker->country,
// 'description' => $this->faker->paragraph