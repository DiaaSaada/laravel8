<?php

namespace Database\Factories;

use App\Models\Copoun;
use Illuminate\Database\Eloquent\Factories\Factory;

class CopounFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Copoun::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code'
        ];
    }
}
