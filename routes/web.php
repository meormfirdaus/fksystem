<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\ParkingSpaceController;
use App\Http\Controllers\Admin\ParkingAreaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ParkingSpacePublicController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (GUEST & AUTH CAN VIEW)
|--------------------------------------------------------------------------
| - Homepage (Daily Parking Availability)
| - QR Code public view
*/

Route::get('/', [
    \App\Http\Controllers\ParkingAvailabilityController::class,
    'index'
])->name('home');

Route::get('/parking-space/{token}', [
    \App\Http\Controllers\ParkingSpacePublicController::class,
    'show'
])->name('parking-space.public.show');



/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (IMPORTANT)
|--------------------------------------------------------------------------
| - This prevents /dashboard 404
| - Breeze default redirect uses /dashboard
| - Redirect user based on role
*/

Route::get('/dashboard', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return match (auth()->user()->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        'safety'  => redirect()->route('safety.dashboard'),
        default   => redirect()->route('home'),
    };

})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

        Route::get('/dashboard', [
            \App\Http\Controllers\Admin\DashboardController::class,
            'index'
        ])->name('dashboard');

        Route::resource('users',
            \App\Http\Controllers\Admin\UserController::class
        );

        Route::resource('parking-areas',
            \App\Http\Controllers\Admin\ParkingAreaController::class
        );

        // Parking Spaces
        Route::get('spaces', [ParkingSpaceController::class, 'index'])
            ->name('spaces.index');

        Route::get('spaces/create', [ParkingSpaceController::class, 'create'])
            ->name('spaces.create');

        Route::post('spaces', [ParkingSpaceController::class, 'store'])
            ->name('spaces.store');

        Route::get('spaces/{space}/edit', [ParkingSpaceController::class, 'edit'])
            ->name('spaces.edit');

        Route::put('spaces/{space}', [ParkingSpaceController::class, 'update'])
            ->name('spaces.update');

        Route::delete('spaces/{space}', [ParkingSpaceController::class, 'destroy'])
            ->name('spaces.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | STUDENT ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:student')
        ->prefix('student')
        ->name('student.')
        ->group(function () {

        Route::get('/dashboard', [
            \App\Http\Controllers\Student\DashboardController::class,
            'index'
        ])->name('dashboard');

        Route::resource('vehicles',
            \App\Http\Controllers\Student\VehicleController::class
        );
    });


    /*
    |--------------------------------------------------------------------------
    | SAFETY ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:safety')
        ->prefix('safety')
        ->name('safety.')
        ->group(function () {

        Route::get('/dashboard', [
            \App\Http\Controllers\Safety\DashboardController::class,
            'index'
        ])->name('dashboard');

        Route::get('vehicle-approvals', [
            \App\Http\Controllers\Safety\VehicleApprovalController::class,
            'index'
        ])->name('vehicle-approvals.index');

        Route::post(
            'vehicle-approvals/{vehicle}/approve',
            [\App\Http\Controllers\Safety\VehicleApprovalController::class, 'approve']
        )->name('vehicle-approvals.approve');

        Route::post(
            'vehicle-approvals/{vehicle}/reject',
            [\App\Http\Controllers\Safety\VehicleApprovalController::class, 'reject']
        )->name('vehicle-approvals.reject');
  
    });


    /*
    |--------------------------------------------------------------------------
    | PROFILE ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*--------------------------------------------------------------------------
    | PASSWORD ROUTES
    |--------------------------------------------------------------------------*/

       Route::put('/password', [PasswordController::class, 'update'])
        ->name('password.update');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/



require __DIR__ . '/auth.php';
