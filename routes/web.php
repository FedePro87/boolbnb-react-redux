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

// Route::get('/', function () {return view('welcome');});

Auth::routes();

Route::get('/logged', 'HomeController@index')->name('home');
Route::get('/show/{id}', 'ApartmentController@show')->name('show');
Route::get('/', 'ApartmentController@showSponsored')->name('show-sponsored');
Route::get('/search', 'ApartmentController@apartmentSearch')->name('apartment-search');

Route::get('/user/apartment/new', 'ApartmentController@createNewApartment')->name('create');
Route::post('/user/apartment/save', 'ApartmentController@saveNewApartment')->name('save');
Route::get('/user/apartment/save', 'HomeController@abort');
Route::get('/user/sponsorship/{id}', 'SponsorshipController@showSponsorshipForm')->name('showSponsorshipForm');
Route::post('/user/sponsorship/{id}', 'SponsorshipController@updateSponsor')->name('updateSponsorship');
Route::get('/user/{id}/apartment', 'HomeController@showUserApartments')->name('showUserApartments');
Route::post('/user/message/{id}', 'HomeController@storeMessage')->name('create-message');
Route::get('/services', 'ApartmentController@getServices')->name('getServices');
Route::get('/sponsoreds', 'ApartmentController@getSponsoreds')->name('getSponsoreds');

Route::get('/payment/process/{amount}/{apartmentId}/{sponsorshipId}', 'SponsorshipController@process')->name('payment.process');
