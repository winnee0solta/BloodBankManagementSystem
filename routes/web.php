<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth'])->group(function () {

    //DASHBOARD
    Route::get('/dashboard', 'Dashboard\HomeController@index');
    //EVENTS
    Route::get('/events', 'Dashboard\EventsController@index');
    Route::get('/events/add', 'Dashboard\EventsController@addEventPage');
    Route::post('/events/add', 'Dashboard\EventsController@store');
    Route::get('/events/{event_id}/edit', 'Dashboard\EventsController@editEventPage');
    Route::post('/events/{event_id}/edit', 'Dashboard\EventsController@editEvent');
    Route::get('/events/{event_id}/view', 'Dashboard\EventsController@singleEvent');

    Route::get('/events/{event_id}/view/add-donation-record', 'Dashboard\EventsController@addDonationRecordHomeView');
    Route::post('/events/{event_id}/view/add-donation-record/unregistered', 'Dashboard\EventsController@addDonationRecordUnregistered');
    Route::post('/events/{event_id}/view/add-donation-record/registered', 'Dashboard\EventsController@addDonationRecordRegistered');


    Route::get('/events/{event_id}/remove-donation-record/{record_id}', 'Dashboard\EventsController@removeDonationRecord');

    Route::get('/events/{event_id}/remove', 'Dashboard\EventsController@removeEvent'); //todo: need to make

    //BLOOD REQUEST
    Route::get('/blood-requests', 'Dashboard\BloodRequestsController@index');
    Route::get('/blood-requests/{blood_request_id}/remove', 'Dashboard\BloodRequestsController@destroy');

    //RECIPIENTS
    Route::get('/recipients', 'Dashboard\RecipientsController@index');
    Route::post('/recipients/add', 'Dashboard\RecipientsController@store');
    Route::get('/recipients/{recipient_id}/remove', 'Dashboard\RecipientsController@destroy');
    //USERS
    Route::get('/users', 'Dashboard\UsersController@index');
    Route::post('/users/add', 'Dashboard\UsersController@addUser');
    Route::get('/users/{user_id}/remove', 'Dashboard\UsersController@removeUser');
    Route::get('/users/{user_id}/edit', 'Dashboard\UsersController@editPage');
    Route::post('/users/{user_id}/edit', 'Dashboard\UsersController@editUser');


    //DONORS
    Route::get('/donors', 'Dashboard\DonorsController@index');
    Route::get('/donors/{user_id}/remove', 'Dashboard\DonorsController@removeDonor');

    //PROFILE
    Route::get('/profile', 'Dashboard\ProfileController@index');
    Route::get('/profile/edit', 'Dashboard\ProfileController@edit');
    Route::post('/profile/edit', 'Dashboard\ProfileController@editPost');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/a251f845ead5s2/register-admin/{email}/{password}', 'Dashboard\AuthController@registerAdmin');
Route::get('/login', 'Dashboard\AuthController@index')->name('login');
Route::post('/login', 'Dashboard\AuthController@loginUser');
Route::get('/logout', 'Dashboard\AuthController@logout');
Route::get('/register', 'Dashboard\AuthController@registerPage')->name('register');
Route::post('/register', 'Dashboard\AuthController@registerUser');

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'Site\HomeController@index');
Route::get('/public-events', 'Site\HomeController@eventsView');
Route::get('/public-events/{event_id}', 'Site\HomeController@singleEventView');

Route::get('/request-for-blood', 'Site\HomeController@requestForBloodView');
Route::post('/request-for-blood', 'Site\HomeController@requestForBlood')->middleware('auth');
Route::get('/request-for-blood/success', 'Site\HomeController@requestSuccessView');



Route::middleware(['auth'])->group(function () {
    Route::get('/public-profile', 'Site\HomeController@showProfile');
    Route::post('/public-profile/edit', 'Site\HomeController@editProfile');
});
