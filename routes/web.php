<?php

use App\Http\Controllers\FrontHomeController;

use App\Http\Controllers\TypeController;
use App\Http\Controllers\WorkAreaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return redirect('/dashboard');
//});

Route::get('/', [App\Http\Controllers\FrontHomeController::class, 'index'])->name('/');
Route::get('page/{slug}', [App\Http\Controllers\FrontHomeController::class, 'PageSlug'])->name('page');
Route::get('preview_page/{slug}', [App\Http\Controllers\FrontHomeController::class, 'PageSlugPreview'])->name('preview_page');
Route::get('airport/{slug}', [App\Http\Controllers\FrontHomeController::class, 'AirportSlug'])->name('airport');
Route::get('/event/{slug}', [App\Http\Controllers\FrontHomeController::class, 'singleEvent'])->name('event');

Route::get('/file/{filename}', function ($filename) {
    //    dd($filename);
    $path = storage_path('app/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);
    return $response;
});

Auth::routes();
Route::fallback(function () {
    return view('404');
});
Route::get('adminpanel', function () {
    return redirect('/admin/dashboard');
});

Route::get('/about', [FrontHomeController::class, 'about']);
Route::get('/subscribe', [FrontHomeController::class, 'subscribe']);
Route::get('/faqs', [FrontHomeController::class, 'faq']);
Route::get('/contact', [FrontHomeController::class, 'contact']);
Route::get('/search', [FrontHomeController::class, 'search']);
Route::get('/search-funders', [FrontHomeController::class, 'searchFunders']);
Route::get('/funder', [FrontHomeController::class, 'showFunder']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::post('/set-layout-cookie', function (Illuminate\Http\Request $request) {
        $layout = $request->input('layout', 'light');
        return response()
            ->json(['message' => 'Cookie set'])
            ->cookie('layout', $layout, 60 * 24 * 30); // 30 days
    });

    Route::post('logouts', function (Request $request) {
        $user = Auth::user();
        if ($user) {
            $user->current_company_id = null;
            $user->save();
        }
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logouts');

    Route::post('/baskets', [CartController::class, 'createBasket']);
    Route::post('/baskets/add', [CartController::class, 'addToBasket'])->name('basket.add');
    Route::get('/baskets/checkout/{uniq_id}', [CartController::class, 'checkout']);

    Route::get('collections', [CollectionController::class, 'index'])->name('collections.index');
    Route::post('collections/store', [CollectionController::class, 'store'])->name('collections.store');
    Route::post('collections/make', [CollectionController::class, 'storeCollection'])->name('collections.make');
    Route::post('collections/get-media-prices', [CollectionController::class, 'getPrices'])->name('collections.add_media');
    Route::post('collections/remove-media-prices', [CollectionController::class, 'removeMediaPrices'])->name('collections.remove_media');
    Route::post('collections/remove-event-prices', [CollectionController::class, 'removeMediaPrices'])->name('collections.remove_media');
    Route::get('collections/get-selected-media', [CollectionController::class, 'getSelectedMedia'])->name('collections.get_selected_media');

    Route::get('/collections/{id}', [CollectionController::class, 'single'])->name('collections.single');

    Route::get('/media/{id}', [GalleryController::class, 'show'])->name('collections.single');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');

    Route::get('my-account', [App\Http\Controllers\CustomerDashboardController::class, 'MyProfile'])->name('my-account');
    Route::get('my-drive', [App\Http\Controllers\CustomerDashboardController::class, 'MyDrive'])->name('my-drive');
    Route::get('booking-history', [App\Http\Controllers\CustomerDashboardController::class, 'BookingHistory'])->name('booking-history');
    Route::get('booking-history/{id}', [App\Http\Controllers\CustomerDashboardController::class, 'BookingHistoryShow'])->name('booking-history.show');
    Route::get('change-password', [App\Http\Controllers\CustomerDashboardController::class, 'ChangePassword'])->name('change-password');

    Route::prefix('admin')->group(function () {
        Route::resource('workareas', WorkAreaController::class);
        Route::post('/get-workareas', [WorkAreaController::class, 'getList'])->name('get.workareas');

        Route::resource('types', TypeController::class);
        Route::post('/get-types', [TypeController::class, 'getList'])->name('get.types');

        Route::resource('newsletter', NewsletterController::class);
        Route::post('/get-newsletter', [NewsletterController::class, 'getTable'])->name('get.newsletter');
        Route::get('/export-newsletter', [App\Http\Controllers\NewsletterController::class, 'exportToExcel'])->name('export-newsletter');

        //Profile Setting
        Route::get('profile-settings', [App\Http\Controllers\UserController::class, 'profileSetting'])->name('profile-settings.index');
        Route::put('profile-settings/{id}', [App\Http\Controllers\UserController::class, 'profileSettingUpdate'])->name('profile-settings');
        Route::put('updatePassword/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword');

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    });
});
Route::get('/t/{slug}', [App\Http\Controllers\BusinessProfileController::class, 'PublicView'])->name('PublicView');

Route::get('/migrate-refresh', function () {
    // Rollback migrations
    Artisan::call('migrate:fresh');

    // Seed the database with specific seeders
    Artisan::call('db:seed', ['--class' => 'PermissionTableSeeder']);
    Artisan::call('db:seed', ['--class' => 'CreateAdminUserSeeder']);
    Artisan::call('db:seed', ['--class' => 'CompanyCategorySeeder']);
    Artisan::call('db:seed', ['--class' => 'CompanySeeder']);
    Artisan::call('db:seed', ['--class' => 'ContactTypeSeeder']);
    Artisan::call('db:seed', ['--class' => 'ContactsSeeder']);
    Artisan::call('db:seed', ['--class' => 'leadSourceSeeder']);
    Artisan::call('db:seed', ['--class' => 'LeadStagesSeeder']);
    Artisan::call('db:seed', ['--class' => 'LeadTagSeeder']);
    Artisan::call('db:seed', ['--class' => 'CountrySeeder']);
    Artisan::call('db:seed', ['--class' => 'StatesSeeder']);
    //    Artisan::call('db:seed', ['--class' => 'CitySeeder']);

    return 'Migrations rolled back and seeders executed successfully.';
});

Route::get('/migrate-specific/{id}', function ($id) {
    // Run a specific migration
    $migrationPath = 'database/migrations/' . $id;
    Artisan::call('migrate', [
        '--path' => $migrationPath,
    ]);

    return 'Migration executed successfully.';
});

Route::get('/seeder-specific/{id}', function ($id) {
    // You can also run seeders if needed
    Artisan::call('db:seed', ['--class' => $id]);

    return 'Migration executed successfully.';
});
