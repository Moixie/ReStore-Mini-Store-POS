<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/Admin', function () {
    return Inertia::render('Admin/Index');
})->middleware(['auth', 'verified','role:admin'])->name('Admin');


// Just delete this, just for testing SEM
Route::get('/Sem', function () {
    return Inertia::render('Admin/Index');
})->middleware(['auth', 'verified','role:admin'])->name('Sem');



Route::resource('products', ProductController::class) //Product ROUTE
    ->only(['index','create', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('products.purchases', PurchaseController::class) //Purchase ROUTE in the product page, this allows to store in the purchase controller
    ->only(['store'])
    ->middleware(['auth', 'verified']);


Route::resource('purchases', PurchaseController::class) //Purchase Link
->only(['index', 'store', 'update','destroy'])
->middleware(['auth', 'verified']);


Route::resource('orders', OrderController::class) //Order Link
->only(['index', 'store', 'update','destroy'])
->middleware(['auth', 'verified']);


Route::resource('chirps', ChirpController::class) //Chirp Controller
->only(['index', 'store', 'update','destroy'])
->middleware(['auth', 'verified']);


Route::resource('categories', CategoryController::class) //Categories ROUTE
->only(['index','create', 'store', 'update', 'destroy'])
->middleware(['auth', 'verified']);

Route::resource('unit_types', UnitTypeController::class) //Unit Types ROUTE
->only(['index','create', 'store', 'update', 'destroy'])
->middleware(['auth', 'verified']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
