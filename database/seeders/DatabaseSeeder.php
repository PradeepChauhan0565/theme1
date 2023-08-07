<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\Menu;
use App\Models\Role;
use App\Models\User;
use App\Models\Url;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mantosh Nishad',
            'email' => 'mantosh@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        Role::create([
            'role_name' => 'Super Admin',
            'role_desc' => 'Super Admin'

        ]);
        Url::insert([

            [
                'menu_id' => 2,
                'text' => 'menu',
                'url' => 'master/menu',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 1,
                'created_by' => 1
            ],
            [
                'menu_id' => 2,
                'text' => 'Urls',
                'url' => 'master/urls',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 2,
                'created_by' => 1
            ],
            [
                'menu_id' => 2,
                'text' => 'RoleMapUrl',
                'url' => 'master/role-url',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 3,
                'created_by' => 1
            ],
            [
                'menu_id' => 2,
                'text' => 'RoleMapUser',
                'url' => 'master/role-user',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 4,
                'created_by' => 1
            ]
            ,
            [
                'menu_id' => 2,
                'text' => 'User',
                'url' => 'master/user',
                'icon' => 'fas fa-tachometer-alt',
                'label' => null,
                'label_color' => null,
                'order_by' => 4,
                'created_by' => 1
            ]
        ]);
        Menu::insert([
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

        ]);
        $roles = Role::all();
        $users = User::all();
        $urls = Url::all();

        foreach($users as $user)
        {
            $randomRoles = $roles->random(rand(1, 1));            
            $user->roles()->attach($randomRoles);
        }
        foreach($roles as $role)
        {         
            $role->urls()->attach([1,2,3,4,5]);
        }
        
    }
}
