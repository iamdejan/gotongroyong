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

Route::get("/", "WelcomeController@start")->name("start");

Auth::routes();

Route::get("/home", "HomeController@index")->name("home");

Route::get("/home/mulai", "HomeController@create")->name("mulai");
Route::post("/home/mulai", "HomeController@store")->name("simpan");

Route::get("/home/ubah", "HomeController@edit")->name("ubah");
Route::post("/home/ubah", "HomeController@update")->name("update");

Route::get("/home/sumbangan", "HomeController@viewSumbangan")->name("sumbangan");

Route::get("/home/refill", "HomeController@refill")->name("refill");
Route::post("/home/refill", "HomeController@storeRefill")->name("storeRefill");

Route::get("/project/{id}", "HomeController@viewCampaign");
Route::post("/project/{id}", "HomeController@storeComment"); //store comment

Route::post("/project/{id}/donate", "HomeController@donate"); //donate

Route::get("/profil", "WelcomeController@profil")->name("profil");
Route::get("/kontak", "WelcomeController@kontak")->name("kontak");

?>