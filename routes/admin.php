<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PracticeAreaController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\LawyerController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\TicketController;

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
Route::post('/', [LoginController::class, 'authenticate'])->name('admin.login');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
    Route::get('/create-user', [UserController::class, 'create_user'])->name('admin.create_user');
    Route::get('/edit-user/{id}', [UserController::class, 'edit_user'])->name('admin.edit_user');
    Route::get('/delete-user/{id}', [UserController::class, 'delete_user'])->name('admin.delete_user');
    Route::post('/store-user', [UserController::class, 'store_user'])->name('admin.store_user');
    Route::get('/user-details/{id}', [UserController::class, 'user_details'])->name('admin.user_details');

    Route::post('change-password', [AdminController::class, 'change_password'])->name('admin.change_password');
    Route::post('update-profile', [AdminController::class, 'update_profile'])->name('admin.update_profile');
    Route::get('/edit-profile', [AdminController::class, 'index'])->name('admin.profile');

    Route::get('/contact-us-listing', [AdminController::class, 'contact_us_listing'])->name('admin.contact_us_listing');
    Route::get('/contact-detail/{id}', [AdminController::class, 'contact_udetail'])->name('admin.contact_detail');

    Route::get('/service', [ServiceController::class, 'index'])->name('admin.service');
    Route::get('/create-service', [ServiceController::class, 'create_service'])->name('admin.create_service');
    Route::get('/edit-service/{id}', [ServiceController::class, 'edit_service'])->name('admin.edit_service');
    Route::get('/delete-service/{id}', [ServiceController::class, 'delete_service'])->name('admin.delete_service');
    Route::post('/store-service', [ServiceController::class, 'store_service'])->name('admin.store_service');

    Route::get('/practice-area', [PracticeAreaController::class, 'index'])->name('admin.practice_area');
    Route::get('/create-area', [PracticeAreaController::class, 'create_area'])->name('admin.create_area');
    Route::get('/edit-area/{id}', [PracticeAreaController::class, 'edit_area'])->name('admin.edit_area');
    Route::get('/delete-area/{id}', [PracticeAreaController::class, 'delete_area'])->name('admin.delete_area');
    Route::post('/store-area', [PracticeAreaController::class, 'store_area'])->name('admin.store_area');

    //Appointment
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('admin.appointments');
    Route::get('/appointment-detail/{id}', [AppointmentController::class, 'details'])->name('admin.appointments_details');
    Route::post('/save-disapprove',[AppointmentController::class, 'save_disapprove'])->name('admin.save_disapprove');
    Route::post('/save-approve',[AppointmentController::class, 'save_approve'])->name('admin.save_approve');
    Route::get('/generate-invoice/{id}',[AppointmentController::class, 'generate_invoice'])->name('admin.generate_invoice');

    //Client 
    Route::get('/clients', [ClientController::class, 'index'])->name('admin.clients');
    Route::get('/clients-detail/{id}', [ClientController::class, 'client_detail'])->name('admin.client_detail');


    //Lawyer
    Route::get('/lawyers', [LawyerController::class, 'index'])->name('admin.lawyers');
    Route::get('/lawyer-detail/{id}', [LawyerController::class, 'lawyer_detail'])->name('admin.lawyer_detail');
    Route::get('/lawyer-bookings/{id}', [LawyerController::class, 'lawyer_bookings'])->name('admin.lawyer_bookings');
    Route::get('/lawyer-upcoming-bookings/{id}', [LawyerController::class, 'lawyer_upcoming_bookings'])->name('admin.lawyer_upcoming_bookings');
    Route::get('/change-lawyer/{id}', [LawyerController::class, 'change_status'])->name('admin.change_status');

    //Schedule Calendar
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('admin.schedule');
    Route::get('/schedule-data', [ScheduleController::class, 'fullcalender_getdata'])->name('admin.fullcalender_getdata');
    Route::get('/getBookingDetails/{bookingid}', [ScheduleController::class, 'getBookingDetails'])->name('admin.getBookingDetails');

    // Ticket enquiries
    Route::get('/ticket', [TicketController::class, 'index'])->name('admin.ticket');
    Route::get('/join-chat/{id}', [TicketController::class, 'join_chat'])->name('admin.join_chat');
    Route::post('/send-msg', [TicketController::class, 'send_msg'])->name('admin.send_msg');
    Route::get('/fetch-msg', [TicketController::class, 'fetch_msg'])->name('admin.fetch_msg');
 
   //Appointment Chat
   Route::get('/chat/{id}', [AppointmentController::class, 'chat'])->name('admin.chat');
   Route::post('/send-message', [AppointmentController::class, 'send_message'])->name('admin.send_message');
   Route::get('/fetch-message', [AppointmentController::class, 'fetch_message'])->name('admin.fetch_message');



    Route::post('/change-ticket', [TicketController::class, 'changestatus'])->name('admin.changestatus');
}); 