<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Validations\Validation;

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::get('logout', 'AuthController@getLogout');
});

// Admin Routes...
Route::group(['middleware' => 'auth'], function () {

    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'ProjectControllers'], function () {

        // Clear caché Routes...
        Route::get('/clear', 'ArtisanCommandsController@clear');

        Route::group(['middleware' => ['role_or_permission:Administrador']], function () {
            // Users Routes...
            Route::get('/users/{user}/changePassword', 'UserController@changePassword');
            Route::put('/users/{user}/changePassword', 'UserController@updatePassword');
            Route::resource('users', 'UserController');

            // Roles Routes...
            Route::get('/roles/{role}/permissions', 'RolesController@editPermissions');
            Route::post('/roles/{role}/permissions', 'RolesController@assignPermissions');
            Route::resource('roles', 'RolesController')->only(['index', 'store', 'destroy']);
        });

        // Lists Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('cities')]], function () {
            Route::resource('cities', 'CityController');
        });

        // Customers Routes...
        Route::group(['middleware' => [Validation::permissionsRoute('customers')]], function () {
            Route::resource('customers', 'CustomerController')->except('show');
        });
    });
});
