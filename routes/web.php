<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\OrderController;
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




Route::get('exls', function () {
    Excel::import(new ExcelFileImport, public_path('files/Data Structure.xlsx'));
});

Route::get('/grid', function () {
    return view('livewire.component.chetak-grid');
});
Route::get('/blog', function () {
    return view('blog');
});

Route::get('/customise-design', function () {
    return view('customise-design');
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
Route::middleware([
    'auth',
])->group(function () {
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/subscribers-excle', [HomeController::class, 'downloadExcle'])->name('downloadExcle');

    Route::get('orders', [OrderController::class, 'orders'])->name('orders');
    Route::get('/tracking/{id}', [OrderController::class, 'tracking'])->name('tracking');
    Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');
    Route::get('/invoice-pdf/{id}', [OrderController::class, 'downloadInvoice'])->name('downloadInvoice');
});
Route::get('/my-com', MyLiveComponent::class);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/hello', [HomeController::class, 'hello'])->name('hello');
Route::get('/shop/{category}/{style?}/{subCategory?}', [ProductController::class, 'producFront'])->name('products');
Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('recently-viewed', [ProductController::class, 'recentView'])->name('recent-view');
Route::get('/image/{id}/{cid}', [ProductController::class, 'singleImage']);
Route::get('wishlist', [WishlistController::class, 'wishList'])->name('wishlists');
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

Route::get('/details/{product}', [SingleController::class, 'single'])->name('single');
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
