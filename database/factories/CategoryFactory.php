<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['active' , 'draft'];
        $random = DB::table('categories')->inRandomOrder()->limit(1)->first(['id']);
        return [
            'name'=>$this->faker->words(2 , true),
            'slug'=> Str::slug($this->faker->words(2 , true)),
            'parent_id'=>$random? $random->id : null,
            'description'=>$this->faker->words(200 , true),
            'image'=>$this->faker->imageUrl(),
            'status'=>$status[rand(0,1)],
        ];
    }
}
