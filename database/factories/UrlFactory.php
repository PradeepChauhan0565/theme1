<?php

namespace Database\Factories;

use App\Models\Url;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UrlFactory extends Factory
{

    protected $model = Url::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            [
                'menu_id' => 0,
                'text' => 'Dashboard',
                'url' => '/',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 0,
                'created_by' => 1
            ],
            [
                'menu_id' => 1,
                'text' => 'Masters',
                'url' => '#',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 2,
                'created_by' => 1
            ],
            [
                'menu_id' => 2,
                'text' => 'menu',
                'url' => 'master/menu',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 2,
                'created_by' => 1
            ],
            [
                'menu_id' => 2,
                'text' => 'Urls',
                'url' => 'master/urls',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 3,
                'created_by' => 1
            ],
            [
                'menu_id' => 1,
                'text' => 'RoleMapUrl',
                'url' => 'master/role-url',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 2,
                'created_by' => 1
            ],
            [
                'menu_id' => 1,
                'text' => 'RoleMapUser',
                'url' => 'master/role-user',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 2,
                'created_by' => 1
            ]

        ];
    }
}
