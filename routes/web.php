<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontrtoller;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AppointmentController;





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
    return view('home');
});
Route::middleware(['employee.auth'])->group(function () {
 
    // Route::get('edit-book', [BookController::class, 'Editbook'])->name('edit.book');
    // Route::post('update-book', [BookController::class, 'Updatebook'])->name('update.book');
    // Route::post('delete-book/{id}', [BookController::class, 'Deletebook'])->name('delete.book');
    // Route::post('bookshow', [BookController::class, 'bookshow'])->name('bookshow');
    // Route::get('bookshow', [Usercontrtoller::class, 'bookshow'])->name('bookshow');
     Route::get('user-logout', [Usercontrtoller::class, 'userlogout'])->name('user.logout');
     Route::get('find-doctor', [Usercontrtoller::class, 'finddoctor']);
    Route::post('book-request', [AppointmentController::class, 'bookdoc'])->name('book.request');
    Route::get('bookdetail', [AppointmentController::class,'bookdetail']);
    Route::get('app-list', [Usercontrtoller::class, 'applist'])->name('app.list');


    
  



});
Route::middleware(['doctor.auth'])->group(function () {
    Route::get('create-appo', [ScheduleController::class, 'createappo'])->name('create.appo');
    Route::post('insert-appo', [ScheduleController::class, 'Insertappo'])->name('insert.appo');
      Route::get('list-appo', [ScheduleController::class, 'Listappo']);
    Route::get('doctor-dashboard', [Usercontrtoller::class, 'doctordashboard'])->name('doctor.dashboard');
    Route::get('doctor-logout', [Usercontrtoller::class, 'doctorlogout'])->name('doctor.logout');
      Route::post('doctor/appointments/{appointmentId}/accept', [AppointmentController::class, 'accept'])->name('doctor.appointments.accept');
    Route::post('doctor/appointments/{appointmentId}/reject', [AppointmentController::class, 'reject'])->name('doctor.appointments.reject');
    Route::get('doctor-historys', [Usercontrtoller::class, 'dochistory']);
    Route::get('users-lists', [ScheduleController::class, 'listusers']);
    Route::post('users-data-list', [ScheduleController::class, 'listdata']);

    



  });

// Route::middleware(['access.auth'])->group(function () {
    
// Route::get('book-list', [BookController::class,'booklist'])->name('book.list');
// Route::get('add-book',[BookController::class, 'Addbook'])->name('add.book');
// Route::post('insert-book',[BookController::class, 'Insertbook'])->name('insert.book');
// Route::get('edit-book',[BookController::class, 'Editbook'])->name('edit.book');
// Route::post('update-book',[BookController::class, 'Updatebook'])->name('update.book');
// Route::post('delete-book/{id}',[BookController::class, 'Deletebook'])->name('delete.book');
// Route::post('bookshow',[BookController::class, 'bookshow'])->name('bookshow');
// Route::get('bookshow', [BookController::class, 'bookshow'])->name('bookshow');
// Route::get('user-logout', [Usercontrtoller::class,'userlogout'])->name('user.logout');
// Route::get('doctor-dashboard', [Usercontrtoller::class,'doctordashboard'])->name('doctor.dashboard');
// Route::get('doctor-logout', [Usercontrtoller::class,'doctorlogout'])->name('doctor.logout');



// });
Route::get('user-register', [Usercontrtoller::class, 'userregisterget'])->name('userregisterget');
Route::post('user-register',[Usercontrtoller::class,'userregistersign'])->name('userregister');
Route::get('userlogin', [Usercontrtoller::class,'userlogin']);
Route::post('user-login', [Usercontrtoller::class,'userauth'])->name('user.login');


Route::get('doctor-register', [Usercontrtoller::class, 'doctorregisterget'])->name('doctorregisterget');
Route::post('doctor-register',[Usercontrtoller::class,'doctorregistersign'])->name('doctorregister');
Route::get('doctorlogin', [Usercontrtoller::class,'doctorlogin']);
Route::post('doctor-login', [Usercontrtoller::class,'doctorauth'])->name('doctor.login');










