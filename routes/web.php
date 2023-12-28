<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarUsersController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\EventController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'showCalendar'])->name('calendar');
Route::get('/Absencescalendar', [App\Http\Controllers\CalendarController::class, 'showAbsencesCalendar'])->name('absences-calendar');
Route::get('/', [App\Http\Controllers\CalendarController::class, 'showCalendar'])->name('calendar');
Route::get('/run', [App\Http\Controllers\CalendarController::class, 'run'])->name('run');


// returns the home page with all posts
Route::get('/calendaruser/index', CalendarUsersController::class .'@index')->name('calendaruser.index');
// returns the form for adding a post
Route::get('/calendaruser/create', CalendarUsersController::class . '@create')->name('calendaruser.create');
// adds a post to the database
Route::post('/calendaruser', CalendarUsersController::class .'@store')->name('calendaruser.store');
// returns a page that shows a full post
Route::get('/calendaruser/{calendaruser}', CalendarUsersController::class .'@show')->name('calendaruser.show');
// returns the form for editing a post
Route::get('/calendaruser/{calendaruser}/edit', CalendarUsersController::class .'@edit')->name('calendaruser.edit');
// updates a post
Route::put('/calendaruser/{calendaruser}', CalendarUsersController::class .'@update')->name('calendaruser.update');
// deletes a post
Route::delete('/calendaruser/{calendaruser}', CalendarUsersController::class .'@destroy')->name('calendaruser.destroy');


// returns the home page with all posts
Route::get('/area/index', AreaController::class .'@index')->name('area.index');
// returns the form for adding a post
Route::get('/area/create', AreaController::class . '@create')->name('area.create');
// adds a post to the database
Route::post('/area', AreaController::class .'@store')->name('area.store');
// returns a page that shows a full post
Route::get('/area/{area}', AreaController::class .'@show')->name('area.show');
// returns the form for editing a post
Route::get('/area/{area}/edit', AreaController::class .'@edit')->name('area.edit');
// updates a post
Route::put('/area/{area}', AreaController::class .'@update')->name('area.update');
// deletes a post
Route::delete('/area/{area}', AreaController::class .'@destroy')->name('area.destroy');

// returns the home page with all posts
Route::get('/absence/index', AbsenceController::class .'@index')->name('absence.index');
// returns the form for adding a post
Route::get('/absence/create', AbsenceController::class . '@create')->name('absence.create');
Route::get('/absence/create-holiday', AbsenceController::class . '@createHoliday')->name('absence.create-holiday');
// adds a post to the database
Route::post('/absence/holiday', AbsenceController::class . '@storeholiday')->name('absence.store-holiday');
// adds a post to the database
Route::post('/absence', AbsenceController::class .'@store')->name('absence.store');
// returns a page that shows a full post
Route::get('/absence/{absence}', AbsenceController::class .'@show')->name('absence.show');
// returns the form for editing a post
Route::get('/absence/{absence}/edit', AbsenceController::class .'@edit')->name('absence.edit');
// updates a post
Route::put('/absence/{absence}', AbsenceController::class .'@update')->name('absence.update');
// deletes a post
Route::delete('/absence/{absence}', AbsenceController::class .'@destroy')->name('absence.destroy');


// returns the home page with all posts
Route::get('/event/index', EventController::class .'@index')->name('event.index');
// returns the form for adding a post
Route::get('/event/create', EventController::class . '@create')->name('event.create');
// adds a post to the database
Route::post('/event', EventController::class .'@store')->name('event.store');
// returns a page that shows a full post
Route::get('/event/{event}', EventController::class .'@show')->name('event.show');
// returns the form for editing a post
Route::get('/event/{event}/edit', EventController::class .'@edit')->name('event.edit');
// updates a post
Route::put('/event/{event}', EventController::class .'@update')->name('event.update');
// deletes a post
Route::delete('/event/{event}', EventController::class .'@destroy')->name('event.destroy');
