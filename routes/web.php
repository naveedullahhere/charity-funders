<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\FrontHomeController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AthleteProfileController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripePaymentController;
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
    $response->header("Content-Type", $type);
    return $response;
});



Auth::routes();
Route::fallback(function () {
    return view('404');
});
Route::get('adminpanel', function () {
    return  redirect('/admin/dashboard');
});



Route::get('/athlete-profile/{profile_link}', [AthleteProfileController::class, 'showProfile']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('search', [ProductController::class, 'getProducts']);
// Route::get('checkout', [OrderController::class, 'index'])->name("checkout");
Route::get('checkout/{unique_id}', [CartController::class, 'checkout'])->name("checkout");
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::delete('/cart/{id}', [CartController::class, 'removeItem'])->name('cart.remove');

// Route::get('/checkout', [CartController::class, 'show'])->name('checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');

Route::get('add-to-cart', [OrderController::class, 'addToCart'])->name("addToCart");
Route::post('check-coupon', [OrderController::class, 'checkCouponCode'])->name("check-coupon");
Route::get('thank-you/{inv_id}', [OrderController::class, 'thanks'])->name('thank-you');
Route::post('subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');

Route::post('/handle-ajax-request', [FrontHomeController::class, 'handleAjaxRequest'])->name('handle-ajax-request');
Route::post('/galleries', [FrontHomeController::class, 'finalSubmit'])->name('final-submit');
Route::get('/galleries', [FrontHomeController::class, 'finalSubmit'])->name('galleries');

Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::group(['middleware' => ['auth']], function () {

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
    Route::get('booking-history/{id}', [App\Http\Controllers\CustomerDashboardController::class, 'BookingHistoryShow'])
        ->name('booking-history.show');
    Route::get('change-password', [App\Http\Controllers\CustomerDashboardController::class, 'ChangePassword'])->name('change-password');

    Route::prefix('admin')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::post('/get-roles', [App\Http\Controllers\RoleController::class, 'getTable'])->name('get.roles');
        Route::get('/export-roles', [App\Http\Controllers\RoleController::class, 'exportToExcel'])->name('export-roles');

        Route::resource('users', UserController::class);
        Route::post('/get-users', [App\Http\Controllers\UserController::class, 'getTable'])->name('get.users');
        Route::get('/export-users', [App\Http\Controllers\UserController::class, 'exportToExcel'])->name('export-users');

        Route::resource('page', App\Http\Controllers\PageController::class);
        Route::post('/get-page', [App\Http\Controllers\PageController::class, 'getTable'])->name('get.page');
        Route::get('/export-page', [App\Http\Controllers\PageController::class, 'exportToExcel'])->name('export-page');

        //        Route::resource('airport', App\Http\Controllers\AirportController::class);
        //        Route::post('/get-airport', [App\Http\Controllers\AirportController::class, 'getTable'])->name('get.airport');
        //        Route::get('/export-airport', [App\Http\Controllers\AirportController::class, 'exportToExcel'])->name('export-airport');

        //        Route::resource('space', App\Http\Controllers\SpaceController::class);
        //        Route::post('/get-space', [App\Http\Controllers\SpaceController::class, 'getTable'])->name('get.space');
        //        Route::get('/export-space', [App\Http\Controllers\SpaceController::class, 'exportToExcel'])->name('export-space');
        //
        //        Route::resource('provider', App\Http\Controllers\ProviderController::class);
        //        Route::post('/get-provider', [App\Http\Controllers\ProviderController::class, 'getTable'])->name('get.provider');
        //        Route::get('/export-provider', [App\Http\Controllers\ProviderController::class, 'exportToExcel'])->name('export-provider');
        //Events
        Route::resource('studio', App\Http\Controllers\StudioController::class);
        Route::post('/get-studio', [App\Http\Controllers\StudioController::class, 'getTable'])->name('get.studio');
        Route::get('/export-studio', [App\Http\Controllers\StudioController::class, 'exportToExcel'])->name('export-studio');



        Route::resource('event', App\Http\Controllers\EventController::class);
        Route::post('/get-event', [App\Http\Controllers\EventController::class, 'getTable'])->name('get.event');
        Route::get('/export-event', [App\Http\Controllers\EventController::class, 'exportToExcel'])->name('export-event');

        //Events
        Route::resource('gallery', App\Http\Controllers\GalleryController::class);
        Route::post('/get-gallery', [App\Http\Controllers\GalleryController::class, 'getTable'])->name('get.gallery');
        Route::get('/export-gallery', [App\Http\Controllers\GalleryController::class, 'exportToExcel'])->name('export-gallery');

        //Events
        Route::resource('athletes', App\Http\Controllers\AthleteProfileController::class);
        Route::post('/get-athletes', [App\Http\Controllers\AthleteProfileController::class, 'getTable'])->name('get.athletes');
        Route::get('/export-athletes', [App\Http\Controllers\AthleteProfileController::class, 'exportToExcel'])->name('export-athletes');
        Route::get('/send-email/{id}', [App\Http\Controllers\AthleteProfileController::class, 'sendEmail'])->name('send-email');

        Route::post('/upload-media', [App\Http\Controllers\GalleryController::class, 'uploadMedia'])->name('upload-media');
        Route::delete('/revert-media', [App\Http\Controllers\GalleryController::class, 'revertMedia'])->name('revert-media');


        Route::resource('discount', App\Http\Controllers\DiscountController::class);
        Route::post('/get-discount', [App\Http\Controllers\DiscountController::class, 'getTable'])->name('get.discount');
        Route::get('/export-discount', [App\Http\Controllers\DiscountController::class, 'exportToExcel'])->name('export-discount');


        Route::resource('bookings', App\Http\Controllers\OrderController::class);
        Route::post('/get-bookings', [App\Http\Controllers\OrderController::class, 'getTable'])->name('get.bookings');
        Route::get('/export-bookings', [App\Http\Controllers\OrderController::class, 'exportUsersToExcel'])->name('export-bookings');


        Route::resource('product', ProductController::class);
        Route::post('/get-product', [ProductController::class, 'getTable'])->name('get.product');
        Route::get('/product/daily-price/{id}',  [ProductController::class, 'dailyPrice'])->name('product.dailyPrice');
        Route::post('/product/update-daily-prices/{id}', [ProductController::class, 'updateDailyPrices'])->name('product.updateDailyPrices');
        Route::get('/export-product', [App\Http\Controllers\ProductController::class, 'exportToExcel'])->name('export-product');

        Route::resource('newsletter', NewsletterController::class);
        Route::post('/get-newsletter', [NewsletterController::class, 'getTable'])->name('get.newsletter');
        Route::get('/export-newsletter', [App\Http\Controllers\NewsletterController::class, 'exportToExcel'])->name('export-newsletter');





        //Profile Setting
        Route::get('profile-settings', [App\Http\Controllers\UserController::class, 'profileSetting'])->name('profile-settings.index');
        Route::put('profile-settings/{id}', [App\Http\Controllers\UserController::class, 'profileSettingUpdate'])->name('profile-settings');
        Route::put('updatePassword/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword');

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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
