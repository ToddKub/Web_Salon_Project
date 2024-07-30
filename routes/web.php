<?php

use App\Http\Controllers\AdddataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HolidayController;
use Illuminate\Http\Request;
use App\Http\Controllers\chatbotController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\QueueinfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminRefundController;
use App\Http\Controllers\LinefolController;
use App\Http\Controllers\LineIdController;
use App\Http\Controllers\showCalendarController;
use App\Http\Controllers\LineNotifyController;
use App\Http\Controllers\ChartController;

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

//////////////////////////////// ADMIN ///////////////////////////////////////////////////////
Route::get('/index', [HomeController::class, 'checkUserType']);

Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/admin/admin-date', function () {
        return view('admin-date');
    })->middleware(['auth', 'verified'])->name('admindate')->middleware(['auth', 'admin']);

    Route::get('/addholiday/get', [HolidayController::class, 'index'])->name('holidays.get');
    Route::post('/addholiday', [HolidayController::class, 'store'])->name('holidays.store')
        ->middleware(['auth', 'admin']);
    Route::delete('/admin/holidays/{id}/delete', [HolidayController::class, 'destroy'])->name('holidays.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', 'UserController@store')->name('users.store');
    Route::put('users/{name}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('admin/addinfo', [AdddataController::class, 'index'])->name('admin.addindex');
    Route::post('admin/addinfo', [AdddataController::class, 'storeService'])->name('services.store');
    Route::post('admin/addinfo/beautician', [AdddataController::class, 'storeBeautician'])->name('beauticians.store');
    Route::post('admin/addinfo/availabletime', [AdddataController::class, 'storeAvailableTime'])->name('availabletimes.store');
    Route::put('admin/addinfo/update/service/{service_id}', [AdddataController::class, 'updateservice'])->name('service.update');
    Route::put('admin/addinfo/update/bea/{beautician_id}', [AdddataController::class, 'updatebeautician'])->name('beautician.update');
    Route::put('admin/addinfo/update/time/{time_slot_id}', [AdddataController::class, 'updatetime'])->name('timeslot.update');


    Route::delete('admin/addinfo/delete/service/{service_id}', [AdddataController::class, 'servicedelete'])->name('service.destroy');
    Route::delete('admin/addinfo/delete/bea{beautician_id}', [AdddataController::class, 'beauticiandelete'])->name('beautician.destroy');
    Route::delete('admin/addinfo/delete/time/{time_slot_id}', [AdddataController::class, 'timedelete'])->name('timeslot.destroy');



    Route::get('/admin/bookings', [ReservationController::class, 'index'])->name('bookings.index');
    Route::put('/bookings/{booking}', [ReservationController::class, 'update'])->name('bookings.update');
    Route::put('admin/bookings/{book_id}/update-payment', [ReservationController::class, 'updatepaylater'])->name('bookings.updatepayment');
    Route::delete('/bookings/{booking_id}', [ReservationController::class, 'destroy'])->name('bookings.destroy');

    Route::get('/admin/comments', [AdminCommentController::class, 'showComments'])->name('admin.comments');

    Route::get('/admin/refunds', [AdminRefundController::class, 'showRefundRequests'])->name('admin.refund');
    Route::put('/admin/refunds/{refund}', [AdminRefundController::class, 'update'])->name('admin.refundupdate');

    //Charts
    Route::get('/admin/dashboard/chart', [ChartController::class, 'index'])->name('admin.dashboard');

});

//////////////////////////////////////USER/////////////////////////////////////////////
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user-dashboard');
    })->name('user.dashboard');

    //Route::match(['post','get'],'/botman',[chatbotController::class,'handle']);
    //Route::middleware('CheckHoliday')->group(function () {
    //    Route::get('/bookings', [BookingController::class, 'view'])->name('bookings.view');
    //Route::post('/send-all-bookings', [LinefolController::class, 'sendAllBookings'])->name('send-all-bookings');  //test send all data 
    //
    Route::get('/line-notify',[LineNotifyController::class,'redirectToLineNotify'])->name('line-notify');
    Route::get('/line-notify/callback',[LineNotifyController::class,'handleLineNotifyCallback'])->name('line-notify.callback');    
    
    //});

    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'view'])->name('bookings');
    Route::get('/queueinfo', [QueueinfoController::class, 'index'])->name('queueinfo');
    Route::delete('/queueinfo/detele/{booking_id}', [QueueinfoController::class, 'delete'])->name('queuedelete');
    Route::put('/queueinfo/update/{booking_id}', [QueueinfoController::class, 'update'])->name('queueinfo.update');
    //Route::get('/bookings/payment-success',function () {
    //    return view('payment-success');})->name( 'bookings.success');
    //payment//////////////////
    Route::get('/payment/success', [BookingController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [BookingController::class, 'cancel'])->name('payment.cancel');
    Route::post('/payment/checkout/', [PaymentController::class, 'checkoutqueue'])->name('checkout');

    //////////// Refund////////////////////
    Route::get('/refund/{bookingId}', [RefundController::class, 'showRefundForm'])->name('refund.form'); // แสดงหน้า Form Refund
    Route::post('/bookings/refund/add', [RefundController::class, 'storeRefund'])->name('refund.store'); // รับข้อมูลจากฟอร์มและดำเนินการคืนเงิน


    Route::get('/comment', [CommentController::class, 'showComment'])->name('comment');
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');

    Route::get('/calendar', [showCalendarController::class, 'showCalendar'])->name('calendar');
    Route::get('/calendar/events', [showCalendarController::class, 'getEvents'])->name('calendar.events');

    //Route::get('/profile', [LineIdController::class, 'edit'])->name('line-id.edit');
    //Route::put('/profile', [LineIdController::class, 'update'])->name('line-id.update');
});



Route::get('/', function () {
    return view('index');
});

Route::get('/chatbot', function () {
    return view('chat');
});

Route::get('/addservices', function () {
    return view('addservices');
});

Route::get('/service', function () {
    return view('service');
});

Route::get('/service1', function () {
    return view('service1');
});

Route::get('/service2', function () {
    return view('service2');
});

Route::get('/service3', function () {
    return view('service3');
});

/*Route::get('/user/tablequeue', function () {
    return view('tablequeue');
})->middleware(['auth', 'verified'])->name('tablequeue');
*/
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
