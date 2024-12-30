<?php

use App\Http\Controllers\Admin\Noc\NocController as NocNocController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\Admin\NOC\NocController;

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

Route::get('/', function () {
    return redirect()->route('login');
})->name('/');


// Guest Users
Route::middleware(['guest', 'PreventBackHistory', 'firewall.all'])->group(function () {
    Route::get('login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('signin');
    Route::get('register', [App\Http\Controllers\Admin\AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\AuthController::class, 'register'])->name('signup');
    Route::post('citizen-register', [App\Http\Controllers\Admin\AuthController::class, 'citizenRegister'])->name('citizenRegister');
});




// Authenticated users
Route::middleware(['auth', 'PreventBackHistory', 'firewall.all'])->group(function () {

    // Auth Routes
    Route::get('home', fn () => redirect()->route('dashboard'))->name('home');
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [App\Http\Controllers\Admin\AuthController::class, 'Logout'])->name('logout');
    Route::get('change-theme-mode', [App\Http\Controllers\Admin\DashboardController::class, 'changeThemeMode'])->name('change-theme-mode');
    Route::get('show-change-password', [App\Http\Controllers\Admin\AuthController::class, 'showChangePassword'])->name('show-change-password');
    Route::post('change-password', [App\Http\Controllers\Admin\AuthController::class, 'changePassword'])->name('change-password');





    // Masters
    Route::resource('wards', App\Http\Controllers\Admin\Masters\WardController::class);
    Route::resource('property-types', App\Http\Controllers\Admin\Masters\PropertyTypeController::class);
    Route::resource('documents', App\Http\Controllers\Admin\Masters\DocumentsController::class);


    // NOC routes
    // Route::post('/noc/reject/{id}', [NocController::class, 'reject'])->name('noc.reject');
    Route::post('/apply-for-noc/approve', [NocController::class, 'approve'])->name('apply-for-noc.approve');
    Route::resource('apply-for-noc', App\Http\Controllers\Admin\Noc\NocController::class);

    // listing
    Route::get('new-applications', [App\Http\Controllers\Admin\Noc\ListingController::class, 'newApplications'])->name('newApplications');

    Route::get('/nocs', [NocController::class, 'index'])->name('nocs.index');
    Route::post('/apply-for-noc/{id}/reject', [NocController::class, 'reject'])->name('apply-for-noc.reject');
    // Users Roles n Permissions
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::get('users/{user}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggle'])->name('users.toggle');
    Route::get('users/{user}/retire', [App\Http\Controllers\Admin\UserController::class, 'retire'])->name('users.retire');
    Route::put('users/{user}/change-password', [App\Http\Controllers\Admin\UserController::class, 'changePassword'])->name('users.change-password');
    Route::get('users/{user}/get-role', [App\Http\Controllers\Admin\UserController::class, 'getRole'])->name('users.get-role');
    Route::put('users/{user}/assign-role', [App\Http\Controllers\Admin\UserController::class, 'assignRole'])->name('users.assign-role');
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
});

Route::post('/noc/approve/{id}', [NocController::class, 'approve'])->name('approve.noc');

Route::post('/noc/store', [NocController::class, 'store'])->name('noc.store');


Route::get('/php', function (Request $request) {
    if (!auth()->check())
        return 'Unauthorized request';

    Artisan::call($request->artisan);
    return dd(Artisan::output());
});
