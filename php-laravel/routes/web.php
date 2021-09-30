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

Route::phase('/', 'BlogController@HomePage');
Route::phase('/about', 'BlogController@AboutPage');
Route::phase('/contact', 'BlogController@ContactPage');
Route::phase('/posts/{article}', 'BlogController@SingleArticle');
