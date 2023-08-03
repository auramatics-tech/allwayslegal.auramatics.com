<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Lawyer\LawyerController;
use App\Http\Controllers\Lawyer\LawyerPracticeAreaController;
use App\Http\Controllers\Lawyer\LawyerServiceController;
use App\Http\Controllers\Lawyer\LawyerAppointmentController;
use App\Http\Controllers\Lawyer\LawyerScheduleController;
use App\Http\Controllers\Lawyer\LawyerProfileController;
use App\Http\Controllers\Lawyer\LawyerTicketController;
 

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\ClientAppointmentController;
use App\Http\Controllers\Client\ClientTicketController;

use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Booking\MessageController;
use App\Http\Controllers\Booking\PayPalPaymentController;
use App\Http\Controllers\Booking\ZoomController;
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


Route::get('admin', [LoginController::class, 'index'])->name('admin.home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/agency', [HomeController::class, 'agency'])->name('agency');
Route::get('/find-legal-help', [HomeController::class, 'find_legal_help'])->name('find_legal_help');
Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/term-of-use', [HomeController::class, 'term_of_use'])->name('term_of_use');
Route::post('/subscribe-us', [HomeController::class, 'subscribe_us'])->name('admin.subscribe_us');

//chat
Route::get('/chat/{id}', [MessageController::class, 'chat'])->name('chat');
Route::post('/send-message', [MessageController::class, 'send_message'])->name('send_message');
Route::get('/fetch-message', [MessageController::class, 'fetch_message'])->name('fetch_message');

Route::post('/user-login', [App\Http\Controllers\Auth\LoginController::class, 'user_login'])->name('user.login');

Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('contact_us');
Route::post('/save-contact-us', [HomeController::class, 'save_contact_us'])->name('save_contact_us');


Route::get('/get-services', [BookingController::class, 'get_services'])->name('get_services');

Auth::routes(['verify' => true]);
Route::post('/upload-profile',[ClientProfileController::class, 'upload_profile'])->name('upload_profile');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'show_register'])->name('register');
Route::get('/get-data', [App\Http\Controllers\Auth\RegisterController::class, 'get_register_data'])->name('get_register_data');

Route::get('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'show_forgot_password'])->name("show_forgot_password");
Route::post('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'get_password_link'])->name("get_password_link");

Route::get('/booking', [BookingController::class, 'index'])->name('booking');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/choose-lawyer', [BookingController::class, 'choose_lawyer'])->name('choose_lawyer');
    Route::post('/save-booking-data', [BookingController::class, 'save_booking_data'])->name('save_booking_data');
    Route::get('/schedule-time', [BookingController::class, 'schedule_time'])->name('schedule_time');
    Route::post('/get-slots', [BookingController::class, 'get_slots'])->name('get_slots');
    Route::get('/reschedule-time', [BookingController::class, 'schedule_time'])->name('reschedule_time');
    Route::post('/reschedule-save-slots', [BookingController::class, 'reschedule_slots'])->name('reschedule_slots');
    Route::post('/save-slots', [BookingController::class, 'save_slots'])->name('save_slots');
    Route::get('/confirmation', [BookingController::class, 'confirmation'])->name('confirmation');
    Route::get('/detail-review', [BookingController::class, 'detail_review'])->name('detail_review');
    // Route::get('/review', [BookingController::class, 'detail_review'])->name('detail_review');
    
    //payment
    Route::post('/payment', [PayPalPaymentController::class, 'payment'])->name('payment');
    Route::get('/booking-summary/{id}', [PayPalPaymentController::class, 'booking_summary'])->name('booking_summary');
    Route::post('/cancel', [PayPalPaymentController::class, 'appointment_cancel'])->name('appointment_cancel');
    // Route::get('/refund-success', [PayPalPaymentController::class, 'refund_success'])->name('refund_success');
});

Route::prefix('lawyer')->middleware(['auth', 'auth.isLawyer'])->name('lawyer.')->group(function () { 
    Route::get('/dashboard', [LawyerController::class, 'index'])->name('dashboard');
    Route::get('/rate', [LawyerController::class, 'get_hourly_rate'])->name('get_hourly_rate');
    Route::post('/save-rate', [LawyerController::class, 'save_hourly_rate'])->name('save_hourly_rate');

    Route::get('/practice-areas',[LawyerPracticeAreaController::class, 'index'])->name('practice_areas');
    Route::get('/edit-practice-areas/{id}',[LawyerPracticeAreaController::class, 'edit'])->name('edit_practice_areas');
    Route::post('/update-practice-areas',[LawyerPracticeAreaController::class, 'update'])->name('update_practice_areas');

    Route::resource('/services', LawyerServiceController::class);
    Route::resource('/appointment', LawyerAppointmentController::class);
    Route::get('/appointment/detail/{id}', [LawyerAppointmentController::class, 'detail'])->name('appointment.detail');
    Route::post('/appointment/check', [LawyerAppointmentController::class, 'check'])->name('appointment.check');
    Route::post('/appointment/update', [LawyerAppointmentController::class, 'updateSlots'])->name('slots.update');
    Route::post('/appointment/update-status', [LawyerAppointmentController::class, 'update_status'])->name('appointment.update_status');
    Route::get('/appointment/cancel/{id}',[LawyerAppointmentController::class, 'cancel_request'])->name('appointment.cancel_request');
    Route::get('/send-invoice/{id}',[LawyerAppointmentController::class, 'send_invoice'])->name('appointment.send_invoice');


    Route::get('/schedules',[LawyerScheduleController::class, 'index'])->name('schedules');
    Route::post('/save-schedule',[LawyerScheduleController::class, 'store'])->name('save_schedule');
    Route::get('/edit-schedule/{id}',[LawyerScheduleController::class, 'edit'])->name('edit_schedule');
    Route::post('/delete-schedule/{id}',[LawyerScheduleController::class, 'destroy'])->name('delete_schedule');
    Route::get('/get-reschedule-data/{id}',[LawyerAppointmentController::class, 'get_reschedule'])->name('get_reschedule');
    Route::post('/reschedule-reject',[LawyerAppointmentController::class, 'reschedule_reject'])->name('reschedule_reject');

    Route::get('/ticket-enquiries',[LawyerTicketController::class, 'index'])->name('ticket_enquiries');
    Route::get('/ticket-enquiries-add',[LawyerTicketController::class, 'create'])->name('ticket_enquiries_create');
    Route::post('/ticket-enquiries-save',[LawyerTicketController::class, 'save'])->name('ticket_enquiries_save');
    Route::get('/join-chat/{id}', [LawyerTicketController::class, 'join_chat'])->name('join_chat');
    Route::post('/send-msg', [LawyerTicketController::class, 'send_msg'])->name('send_msg');

    Route::get('/fetch-msg', [LawyerTicketController::class, 'fetch_msg'])->name('fetch_msg');
    //change password
    Route::resource('/profile', LawyerProfileController::class);
});

Route::prefix('client')->middleware(['auth', 'auth.isClient'])->name('client.')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'index'])->name('dashboard');
    Route::resource('/profile', ClientProfileController::class);
    Route::resource('/appointment', ClientAppointmentController::class);
    Route::get('/appointment/detail/{id?}', [ClientAppointmentController::class, 'detail'])->name('appointment.detail');
    Route::get('/appointment/cancel/{id}',[ClientAppointmentController::class, 'cancel_request'])->name('appointment.cancel_request');
    Route::post('/appointment/check', [ClientAppointmentController::class, 'check'])->name('appointment.check');


    Route::get('/ticket-enquiry',[ClientTicketController::class, 'index'])->name('ticket_enquiry');
    Route::get('/ticket-enquiry-add',[ClientTicketController::class, 'create'])->name('ticket_enquiry_create');
    Route::post('/ticket-enquiry-save',[ClientTicketController::class, 'save'])->name('ticket_enquiry_save');
    Route::get('/join-chat/{id}', [ClientTicketController::class, 'join_chat'])->name('join_chat_client');
    Route::post('/send-msg', [ClientTicketController::class, 'send_msg'])->name('send_msg_client');
    Route::get('/fetch-msg', [ClientTicketController::class, 'fetch_msg'])->name('fetch_msg_client');
});

Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(function () {
    Route::resource('/messages', MessageController::class);
    Route::get('/change-password', [DashboardController::class, 'show'])->name('change_password');
    Route::post('/change-password-save', [DashboardController::class, 'change_password_save'])->name('change_password_save');
    Route::get('/auth/zoom', [ZoomController::class, 'redirectToZoom']);
    Route::get('/callback/zoom', [ZoomController::class, 'handleZoomCallback']);
});
