<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontHomeController;

use App\Http\Controllers\{FunderController, TypeController, CategoryController, FavoriteController, SubscriptionController, WorkAreaController};

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
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
Route::post('/subscription', [SubscriptionController::class, 'store'])->name('subscription.store');

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
Route::get('/contact-us', [FrontHomeController::class, 'contact']);
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact-us.store');
Route::get('/search', [FrontHomeController::class, 'search']);
Route::get('/search-funders', [FrontHomeController::class, 'searchFunders']);
Route::get('/funder/{slug}', [FrontHomeController::class, 'showFunder']);
Route::post('/get-funders-search', [FrontHomeController::class, 'searchFundersList'])->name('get.searchFundersList');
Route::get('/funder', [FrontHomeController::class, 'showFunder']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add');
Route::post('/favorites/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('funders')->group(function () {
        Route::post('/create', [FunderController::class, 'storeGeneral'])->name('funders.store');
        Route::post('/store-general/{funder}', [FunderController::class, 'updateGeneral'])->name('funders.store.general');
        Route::post('/store-company/{funder}', [FunderController::class, 'storeCompany'])->name('funders.store.company');
        Route::post('/store-financials/{funder}', [FunderController::class, 'storeFinancials'])->name('funders.store.financials');
        Route::post('/store-donations/{funder}', [FunderController::class, 'storeDonations'])->name('funders.store.donations');
        Route::post('/store-people/{funder}', [FunderController::class, 'storePeople'])->name('funders.store.people');
        Route::post('/store-areas/{funder}', [FunderController::class, 'storeAreas'])->name('funders.store.areas');
        Route::delete('/delete', [FrontHomeController::class, 'destroy'])->name('funders.destroy');
    });

    Route::post('/set-layout-cookie', function (Illuminate\Http\Request $request) {
        $layout = $request->input('layout', 'light');
        return response()
            ->json(['message' => 'Cookie set'])
            ->cookie('layout', $layout, 60 * 24 * 30);
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

        Route::resource('category', CategoryController::class);
        Route::post('/get-category', [CategoryController::class, 'getList'])->name('get.category');

        Route::resource('funder', FunderController::class);
        Route::post('/get-funder', [FunderController::class, 'getList'])->name('get.funder');

        Route::resource('contact', ContactController::class);
        Route::post('/get-contact', [ContactController::class, 'getList'])->name('get.contact');


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
