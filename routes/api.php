<?php
use App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
// use App\Http\Controllers\VideoUploadController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PlaneManagementController;
use App\Http\Controllers\Api\Allocatedstdent;
use App\Http\Controllers\Api\FeedbackController;

use App\Http\Controllers\BatchController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');





Route::post('/login', [Api\AuthController::class, 'login']);
Route::post('/forgot-password', [Api\AuthController::class, 'forgotPassword']);
Route::get('/send-test-email', [Api\AuthController::class, 'normail']);
Route::post('/verify-otp', [Api\AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [Api\AuthController::class, 'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [Api\AuthController::class, 'logout']);
    Route::post('/delete-account', [Api\AuthController::class, 'deleteAccount']);
    Route::post('/change-password', [Api\AuthController::class, 'changePassword']);


    Route::get('/profile', [Api\UserController::class, 'profile']);
    Route::post('/edit-profile', [Api\UserController::class, 'editProfile']);
    Route::post('/set-fcm', [Api\UserController::class, 'setFcm']);

  Route::post('/push_notification', [Api\PushNotification::class, 'push_notification']);
    Route::get('/get_notification', [Api\PushNotification::class, 'getNotification']);
    Route::post('/read_notification', [Api\PushNotification::class, 'readtNotification']);

    Route::delete('/delete_notification', [Api\PushNotification::class, 'clearNotifications']);



});

//Videos routes
// Route::get('/getstudentvideo', [VideoUploadController::class, 'getstudentvideo']);
// Route::get('/getTrainervideo', [VideoUploadController::class, 'getTrainervideo']);

//Student Section
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/Allocatedstdent', [Api\Allocatedstdent::class, 'Allocatedstdents']);
});
Route::get('/Studentdetails', [Api\Allocatedstdent::class, 'Studentdetails']);
Route::post('/feedback', [Api\Allocatedstdent::class, 'feedback']);



//Expense section route
Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/addExpense', [ExpenseController::class, 'addExpense']);
Route::get('/Fetchexpense', [ExpenseController::class, 'Fetchexpense']); //Fextch Expese

});
Route::post('/editExpense', [ExpenseController::class, 'editExpense']);
Route::post('/update', [ExpenseController::class, 'Update']);
Route::post('/delete', [ExpenseController::class, 'deleteExpense']);



//Test Management
Route::middleware(['auth:sanctum'])->group(function () {
// Route::get('/FetchAllTests', [TestController::class, 'FetchAllTests']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    // Route::post('/Taketest',[TestController::class, 'Taketest']);
    // Route::get('/TestHistory',[TestController::class, 'TestHistory']);
});
Route::get('/road-signs', [Api\RoadSignController::class, 'index']);
Route::get('/Sub-signs-description', [Api\RoadSignController::class, 'SubsignsDescription']);

//Trainer Attendanse
Route::middleware(['auth:sanctum'])->group(function () {

Route::post('/employeeAttendanse', [EmployeeController::class, 'employeeAttendanse']);
});

Route::middleware(['auth:sanctum'])->group(function () {
Route::post('/studentAttendanse', [StudentController::class, 'studentAttendanse']);

});

Route::post('/approveAttendance', [StudentController::class, 'approveAttendance']);




Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/AllCourseDetails', [PlaneManagementController::class, 'AllCourseDetails']);
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/UpgradeCourse', [PlaneManagementController::class, 'UpgradeCourse']);
    Route::post('/PreUpgradeCourse', [PlaneManagementController::class, 'PreUpgradeCourse']);
    Route::get('/Currentcourse', [PlaneManagementController::class, 'Currentcourse']);
 });




 Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/TrainerFeedback', [Api\FeedbackController::class, 'TrainerFeedback']);
 });


 Route::get('/Allpaymentdetails', [PlaneManagementController::class, 'Allpaymentdetails']);




 //slot Apis
 Route::middleware(['auth:sanctum'])->group(function () {
//  Route::get('/slot', [BatchController::class, 'getSolt']);
// Route::post('/updateSlot', [BatchController::class, 'updateBatch']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/getstudentfeedback', [FeedbackController::class, 'getstudentfeedback']);
    Route::get('/getTrainerFeedback', [FeedbackController::class, 'getTrainerFeedback']);

});


