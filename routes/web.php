<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth');
});

// Category Routes
Route::get('admin/categories', 'App\Http\Controllers\Category\CategoryController@index_admin');
Route::get('user/categories', 'App\Http\Controllers\Category\CategoryController@index_user');
Route::get('category/create', 'App\Http\Controllers\Category\CategoryController@create');
Route::post('category/store', 'App\Http\Controllers\Category\CategoryController@store');
Route::get('category/{id}/edit', 'App\Http\Controllers\Category\CategoryController@edit');
Route::post('category/update/{id}', 'App\Http\Controllers\Category\CategoryController@update');
Route::post('category/delete/{id}', 'App\Http\Controllers\Category\CategoryController@destroy');

// Store Routes
Route::get('admin/dashboard', 'App\Http\Controllers\Store\StoreController@index');
Route::get('admin/stores', 'App\Http\Controllers\Store\StoreController@index_admin');
Route::get('category/{id}/stores', 'App\Http\Controllers\Store\StoreController@index_user');
Route::get('store/{id}/details', 'App\Http\Controllers\Store\StoreController@store_details');
Route::get('store/create', 'App\Http\Controllers\Store\StoreController@create');
Route::post('store/store', 'App\Http\Controllers\Store\StoreController@store');
Route::get('store/{id}/edit', 'App\Http\Controllers\Store\StoreController@edit');
Route::post('store/update/{id}', 'App\Http\Controllers\Store\StoreController@update');
Route::post('store/delete/{id}', 'App\Http\Controllers\Store\StoreController@destroy');

// Search Store Routes
Route::get('admin/search/stores', 'App\Http\Controllers\Store\StoreController@search_admin');
Route::get('user/search/stores', 'App\Http\Controllers\Store\StoreController@search_user');

// Rating Routs
Route::post('store/rating/{id}', 'App\Http\Controllers\Rating\RatingController@store');
