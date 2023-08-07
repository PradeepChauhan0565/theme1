<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\RoleUrl;
use App\Models\url;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {

        Builder::macro('search', function ($field, $string) {
            return $this->where($field, 'LIKE', '%' . $string . '%');
        });



        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $urls = [];
            $menus = Menu::orderBy('order_by', 'asc')->get();
            $urls = url::whereIn(
                'id',
                RoleUrl::whereIn(
                    'role_id',
                    User::find(Auth::user()->id)->roles->pluck('id')
                )->pluck('url_id')
            )
                ->where('deleted_at', null)
                ->orderBy('created_at', 'asc')
                ->get();

            foreach ($menus as $menu) {
                $arrayMenu = [];
                if (count($urls->where('menu_id', $menu->id)) > 0) {
                    foreach ($urls->where('menu_id', $menu->id) as $url) {
                        $arrayMenu[] = array(
                            'text' =>  $url->text,
                            'url' => $menu->url . '/' . $url->url,
                            'icon' => $url->icon
                        );
                    }
                    foreach ($urls as $url) {

                        if ($url->menu_id == null) {
                            $event->menu->add([
                                'text' => $url->text,
                                'url' => $url->url,
                                'icon' => $url->icon,
                            ]);
                        }
                    }
                    $event->menu->add([
                        'text' => $menu->text,
                        'url' => $menu->url,
                        'icon' => $menu->icon,
                        'submenu' => $arrayMenu,
                    ]);
                } else {
                    $roles = User::find(Auth::user()->id)->roles->pluck('id')->toArray();
                    if (($menu->url && $menu->url != '#') || in_array(1, $roles)) {
                        $event->menu->add([
                            'text' => $menu->text,
                            'url' => $menu->url,
                            'icon' => $menu->icon,
                        ]);
                    }
                }
            }
        });
    }
}
