<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\MasterController;
use App\Http\Livewire\MyLiveComponent;
use App\Imports\ExcelFileImport;
use App\Models\Role;
use App\Models\RoomUser;
use App\Models\Subscribe;
use App\Models\url;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/

Route::get('test', function () {
});

Route::get('exls', function () {
    Excel::import(new ExcelFileImport, public_path('files/Data Structure.xlsx'));
});

Route::get('/grid', function () {
    return view('livewire.component.chetak-grid');
});

Route::get('update-url', function () {
    $data = Url::all();
    foreach ($data as $d) {
        $url = str_replace("admin/", "", $d->url);
        Url::find($d->id)->update([
            'url' => $url,
        ]);
    }
});

Auth::routes();

Route::get('/my-com', MyLiveComponent::class);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop/{category}/{style?}/{subCategory?}', [ProductController::class, 'producFront'])->name('products');
Route::get('recently-viewed', [ProductController::class, 'recentView'])->name('recent-view');
Route::get('wishlist', [WishlistController::class, 'wishList'])->name('wishlists');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('single', [SingleController::class, 'single'])->name('single');
// Route::get('/url1', [HomeController::class, 'index1'])->name('home1');
Route::get('/popup', [HomeController::class, 'popup']);
Route::get('/accept', [HomeController::class, 'Accept'])->name('accept');

Route::post('/subscribe', [HomeController::class, 'newsletter'])->name('newsletter');
Route::get('/unsubscribe/{email}', [HomeController::class, 'nonewsletter'])->name('nonewsletter');
Route::post('unsubscribe', [HomeController::class, 'unsubscribe'])->name('unsubscribe');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [HomeController::class, 'dashboard'])->name('home');
    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers', 'index')->name('customers');
    });

    Route::controller(EmployeeController::class)->group(function () {
        Route::get('employees', 'index')->name('employees');
    });
    Route::controller(ComplaintController::class)->group(function () {
        Route::get('complaints/{status?}', 'index')->name('complaints');
    });

    Route::controller(MasterController::class)->group(function () {
        Route::get('master/{component}', 'index')->name('master.index');
    });
});
Route::get('message', function () {
    return Role::find(4)->users;
    $rooms = User::find(1)->rooms()->where('has_group', 0)->pluck('room_id');
    return $rooms;
    $room = RoomUser::whereIn('room_id', $rooms)->where('user_id', 1)->first();
});
