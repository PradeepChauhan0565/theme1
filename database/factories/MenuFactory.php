<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            [
                'text' => 'Dashboard',
                'url' => '/',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 0,
                'created_by' => 1
            ],
            [
                'text' => 'Masters',
                'url' => '#',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 2,
                'created_by' => 1
            ]

        ];
    }
}
