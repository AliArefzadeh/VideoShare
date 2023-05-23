<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Video;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'path' =>"http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4",
            'length' => $this->faker->randomNumber(3),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->realText(),
            'thumbnail' => "https://loremflickr.com/446/240/world?random=" . rand(1, 99),
            'category_id' => Category::first() ?? Category::factory(),
            'user_id' => User::first() ?? User::factory(),
        ];
    }
}
