<?php

use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

// Auth::routes();
// Authentication Routes...
// Route::group(['prefix' => 'panel', 'middleware' => ['auth']], function () {
Route::group(['prefix' => 'panel'], function () {


    Route::get('noauth', 'Backend\Auth\LoginController@noauth')->name('noauth');
    Route::post('logout', 'Backend\Auth\LoginController@logout')->name('logout')->middleware('auth');
    Route::get('login', 'Backend\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Backend\Auth\LoginController@login');
    // Registration Routes...
    Route::get('register', 'Backend\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Backend\Auth\RegisterController@register');


    //User Roles

    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('products', 'ProductController');


    // Password Reset Routes...

    Route::post('password/email', 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Backend\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::get('password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'Backend\Auth\ResetPasswordController@reset')->name('password.update');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'Backend\DashboardController@index')->name('home');
        Route::get('/{any}', 'Backend\DashboardController@index')->where('any', '=', '.*');
    });

    Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {

        // Posts
        Route::post('posts', 'Backend\PostController@store')->name('post.store');
        Route::get('posts/{id}', 'Backend\PostController@show')->name('post.show');
        Route::put('posts/{id}', 'Backend\PostController@update')->name('post.update');
        Route::delete('posts/{id}', 'Backend\PostController@destroy')->name('post.destroy');

        //Categories
        Route::post('categories', 'Backend\CategoriesController@store')->name('category.store');
        Route::get('categories/{id}', 'Backend\CategoriesController@show')->name('category.show');
        Route::put('categories/{id}', 'Backend\CategoriesController@update')->name('category.update');
        Route::delete('categories/{id}', 'Backend\CategoriesController@destroy')->name('category.destroy');

        // Users
        Route::get('users', 'Backend\UserController@index')->name('users');
        Route::post('users', 'Backend\UserController@store')->name('user.store');
        Route::put('users/{id}', 'Backend\UserController@update')->name('user.update');
        Route::delete('users/{id}', 'Backend\UserController@destroy')->name('user.destroy');
    });
});

// Frontend
Route::group(['middleware' => ['web']], function () {
    // Posts
    Route::get('/panel/api/posts', 'Backend\PostController@index')->name('posts');

    // Categories
    Route::get('/panel/api/categories', 'Backend\CategoriesController@index')->name('cotegories');

    // Home page
    Route::get('/', 'Frontend\FrontendController@index')->name('frontend');
});

// Common API

Route::get('/api/getAllWoj', 'ApisController@getAllWoj')->name('getAllWoj');
