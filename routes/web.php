<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/studentform', function () {
    return view('studentform');
})->name('studentform');

Route::get('/form',function(){
    return view('form');
})->name('form');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/studentPage',[App\Http\Controllers\HomeController::class,'studentpage'])->name('studentpage');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'getUsers']);
Route::get('/studenttest',[App\Http\Controllers\HomeController::class,'studenttest']);
Route::get('/Edit',[App\Http\Controllers\HomeController::class,'edit']);
Route::post('/forgotpassword', [App\Http\Controllers\HomeController::class, 'forgotPassword'])->name('forgotPassword');
Route::get('/veryfyotppage', [App\Http\Controllers\HomeController::class, 'verifyOtppage'])->name('verifyOtppage');
Route::post('/verifyOtp', [App\Http\Controllers\HomeController::class, 'verifyOtp'])->name('verifyOtp');
Route::get('/resetPasswordView', [App\Http\Controllers\HomeController::class, 'resetPasswordView'])->name('resetPasswordView');
Route::post('/resetPassword', [App\Http\Controllers\HomeController::class,'resetPassword'])->name('resetPassword');


Route::get('/terms_services', [App\Http\Controllers\HomeController::class, 'terms']);
Route::get('/privacy_policy', [App\Http\Controllers\HomeController::class, 'privacy_policy']);

//StudentEdit



Route::get('/users/{id}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit');

Route::post('/updatestudent-form/{id}', [App\Http\Controllers\HomeController::class, 'updatestudent'])->name('updatestudent');




//PDF Section

Route::get('/studentview', [App\Http\Controllers\HomeController::class, 'studentview'])->name('studentview');





//Dashbord Routes
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/updateprofile-form/{id}', [App\Http\Controllers\HomeController::class, 'updateprofile'])->name('updateprofile')->middleware('auth');
Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');




//Employee Routes
Route::get('/employee',[App\Http\Controllers\EmployeeController::class,'employee'])->name('employee')->middleware('auth');
Route::post('/create', [App\Http\Controllers\EmployeeController::class,'createEmployee'])->name('employee.create')->middleware('auth');
Route::get('/edit-user/{user}',[App\Http\Controllers\EmployeeController::class,'edit'])->name('edit.user')->middleware('auth')->middleware('auth');
Route::get('/editemployee',[App\Http\Controllers\EmployeeController::class,'editemployee'])->name('editemployee')->middleware('auth')->middleware('auth');
Route::post('/updateemployee-form/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployee'])->name('updateemployee')->middleware('auth');
Route::get('/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'delete'])->name('delete')->middleware('auth');
Route::get('/deleated-employeelist/{id}', [App\Http\Controllers\EmployeeController::class, 'deletedemployeelist'])->name('deletedemployeelist')->middleware('auth');


//Students Routes
Route::get('/student',[App\Http\Controllers\StudentController::class,'student'])->name('student')->middleware('auth');
Route::post('/submit-form',[App\Http\Controllers\StudentController::class,'submitForm'])->middleware('auth');
Route::get('/editstudent',[App\Http\Controllers\StudentController::class,'editstudent'])->name('editstudent')->middleware('auth');
Route::post('/updatestudent-form/{id}', [App\Http\Controllers\StudentController::class, 'updatestudent'])->name('updatestudent')->middleware('auth');
Route::get('/deletestudent/{id}', [App\Http\Controllers\StudentController::class, 'deletestudent'])->name('deletestudent')->middleware('auth');
Route::get('/deleated-studentslist/{id}', [App\Http\Controllers\StudentController::class, 'deletedstudentlist'])->name('deletedstudentlist')->middleware('auth');



    // routes/web.php
Route::post('/branchandplan', [App\Http\Controllers\StudentController::class, 'branchandplan']);



//PDF Route
Route::post('/export',[App\Http\Controllers\PDFController::class,'export'])->name('export')->middleware('auth');
Route::post('/exportstudent',[App\Http\Controllers\PDFController::class,'exportstudent'])->name('exportstudent')->middleware('auth');






//Car Management Routes
Route::get('/car-management',[App\Http\Controllers\CarManagementController::class,'carManagement'])->name('carManagement')->middleware('auth');
Route::post('/car-details',[App\Http\Controllers\CarManagementController::class,'addCarDetails'])->middleware('auth');
Route::get('/edit-cardetails',[App\Http\Controllers\CarManagementController::class,'editCarDetails'])->name('edit-cardetails')->middleware('auth');
Route::post('/updatecardetails/{id}', [App\Http\Controllers\CarManagementController::class, 'updatecardetails'])->name('updatecardetails')->middleware('auth');
Route::get('/deletecar/{id}', [App\Http\Controllers\CarManagementController::class, 'deletecar'])->name('deletecar')->middleware('auth');



//Plane Management Route
Route::get('/plane-management',[App\Http\Controllers\PlaneManagementController::class,'planeManagement'])->name('planeManagement')->middleware('auth');
Route::post('/addPlane-details', [App\Http\Controllers\PlaneManagementController::class,'addPlaneDetails'])->middleware('auth');
Route::get('/edit-plandetails',[App\Http\Controllers\PlaneManagementController::class,'editplanDetails'])->name('edit-plandetails')->middleware('auth');
Route::post('/updateplandetails/{id}', [App\Http\Controllers\PlaneManagementController::class, 'updateplandetails'])->name('updateplandetails')->middleware('auth');
Route::get('/deactivate-plandetails/{id}', [App\Http\Controllers\PlaneManagementController::class, 'deactivateplan'])->name('deactivateplan')->middleware('auth');
Route::post('/submit-form891',[App\Http\Controllers\PlaneManagementController::class,'submitForm123'])->middleware('auth');
Route::post('/Activate-plan', [App\Http\Controllers\PlaneManagementController::class, 'Activeplan'])
     ->name('Activeplan')
     ->middleware('auth');



//Sclary management routes
Route::get('/sclary-management',[App\Http\Controllers\SclaryManagementController::class,'sclaryManagement'])->name('sclaryManagement')->middleware('auth');
Route::post('/searchRecords',[App\Http\Controllers\SclaryManagementController::class,'searchRecords'])->middleware('auth');


// //Video upload routes
// Route::get('/video-upload',[App\Http\Controllers\VideoUploadController::class,'videoupload'])->name('videoupload')->middleware('auth');
// Route::post('/uploadVideo',[App\Http\Controllers\VideoUploadController::class,'uploadVideo'])->middleware('auth');
// Route::get('/editvideodetails',[App\Http\Controllers\VideoUploadController::class,'editvideodetails'])->name('editvideodetails')->middleware('auth');
// Route::post('/updatevideodetails/{id}', [App\Http\Controllers\VideoUploadController::class, 'updatevideodetails'])->name('updatevideodetails')->middleware('auth');
// Route::delete('/deletevideodetails/{id}', [App\Http\Controllers\VideoUploadController::class, 'deletevideodetails'])->name('deletevideodetails')->middleware('auth');



//Branch routes
Route::get('/branch',[App\Http\Controllers\BranchController::class,'branch'])->name('branch')->middleware('auth');
Route::post('/createbranch', [App\Http\Controllers\BranchController::class,'createbranch'])->middleware('auth');
Route::get('/edit-branchdetails',[App\Http\Controllers\BranchController::class,'editbranchDetails'])->name('editbranchDetails')->middleware('auth');
Route::post('/updatebranchdetails/{id}', [App\Http\Controllers\BranchController::class, 'updatebranchdetails'])->name('updatebranchdetails')->middleware('auth');
Route::delete('/deletebranchdetails/{id}', [App\Http\Controllers\BranchController::class, 'deletebranchdetails'])
    ->name('deletebranchdetails')
    ->middleware('auth');



//Dashboard routes
Route::get('/home1', [App\Http\Controllers\PaymentController::class, 'showGraph'])->middleware('auth');
Route::get('/branchAnalysis', [App\Http\Controllers\PaymentController::class, 'branchAnalysis'])->middleware('auth');
Route::get('/branch',[App\Http\Controllers\BranchController::class,'branch'])->name('branch')->middleware('auth');
Route::get('/dashbord', [App\Http\Controllers\PaymentController::class, 'dashborddata'])->name('dashbord')->middleware('auth');
Route::get('/planAnalysis', [App\Http\Controllers\PaymentController::class, 'planAnalysis'])->middleware('auth');
Route::get('/monthlyAnalysis', [App\Http\Controllers\PaymentController::class, 'monthlyAnalysis'])->middleware('auth');



//Expense routes
Route::get('/expensedata', [App\Http\Controllers\ExpenseController::class, 'Expensedata'])->name('expense')->middleware('auth');
// Route::get('/viewexpense', [App\Http\Controllers\ExpenseController::class, 'viewExpense'])->name('viewexpense');
Route::get('/viewexpense',[App\Http\Controllers\ExpenseController::class,'viewExpense'])->name('viewexpense')->middleware('auth');
Route::get('viewexpense/{trainer_id}', [App\Http\Controllers\ExpenseController::class, 'viewExpense'])->name('viewexpense')->middleware('auth');





//Feedback Controller
Route::get('/studentfeedback', [App\Http\Controllers\FeedbackController::class, 'studentfeedback'])->name('studentfeedback')->middleware('auth');

Route::get('/trainerfeedback', [App\Http\Controllers\FeedbackController::class, 'trainerfeedback'])->name('trainerfeedback')->middleware('auth');

//rto work

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('rtowork', [App\Http\Controllers\RtoWorkController::class, 'index'])->middleware('auth');
    Route::get('rtoworklist', [App\Http\Controllers\RtoWorkController::class, 'list'])->middleware('auth');
    Route::post('save_rto', [App\Http\Controllers\RtoWorkController::class, 'save'])->middleware('auth');
    Route::post('/export_work',[App\Http\Controllers\RtoWorkController::class,'export'])->name('export_work')->middleware('auth');
    Route::get('/delete_rto_work/{id}', [App\Http\Controllers\RtoWorkController::class, 'delete'])->name('delete_rto_work')->middleware('auth');
});

  //enquiry

    Route::get('enquiry', [App\Http\Controllers\EnquiryController::class, 'index'])->name('enquiry')->middleware('auth');
    Route::get('enquirylist', [App\Http\Controllers\EnquiryController::class, 'list'])->name('enquirylist')->middleware('auth');
    Route::post('save_enquiry', [App\Http\Controllers\EnquiryController::class, 'save'])->middleware('auth');
    Route::get('/delete_enquiry/{id}', [App\Http\Controllers\EnquiryController::class, 'delete'])->name('delete_enquiry')->middleware('auth');


    //Payment Routes
    Route::get('/paymentmanagement',[App\Http\Controllers\PaymentController::class,'paymentmanagement'])->name('paymentmanagement')->middleware('auth');
    Route::get('/viewpaymentdetails',[App\Http\Controllers\PaymentController::class,'viewpaymentdetails'])->name('viewpaymentdetails')->middleware('auth');
    Route::post('/payment-details',[App\Http\Controllers\PaymentController::class,'addpaymentDetails'])->middleware('auth');
    Route::post('/filterpayment',[App\Http\Controllers\PaymentController::class,'filterpayment'])->middleware('auth');


    Route::post('bulksend',[App\Http\Controllers\PushNotificationController::class, 'bulksend'])->name('bulksend');
    Route::get('all-notifications', [App\Http\Controllers\PushNotificationController::class, 'index'])->middleware('auth');
    Route::get('get-notification-form', [App\Http\Controllers\PushNotificationController::class, 'create'])->middleware('auth');





    //Sendifix routes
Route::get('manageyourmonth', [App\Http\Controllers\manageyourmonth::class, 'manageyourmonth'])->name('manageyourmonth')->middleware('auth');
Route::get('months', [App\Http\Controllers\manageyourmonth::class, 'month'])->name('month')->middleware('auth');
Route::post('/totalpayment', [App\Http\Controllers\manageyourmonth::class, 'totalpayment']);
Route::post('/addmonth', [App\Http\Controllers\manageyourmonth::class, 'addmonth']);
Route::get('viewexpence', [App\Http\Controllers\manageyourmonth::class, 'viewexpence'])->name('viewexpence')->middleware('auth');
Route::post('/addexpence', [App\Http\Controllers\manageyourmonth::class, 'addexpence']);
Route::post('/printexpencelist',[App\Http\Controllers\PDFController::class,'printexpencelist'])->middleware('auth');
Route::get('editearning', [App\Http\Controllers\manageyourmonth::class, 'editearning'])->name('editearning')->middleware('auth');
Route::post('/updateearningdetails/{id}', [App\Http\Controllers\manageyourmonth::class, 'updateearningdetails'])->name('updateearningdetails')->middleware('auth');
Route::get('/displayexpence',[App\Http\Controllers\manageyourmonth::class, 'displayexpence'])->middleware('auth');
Route::delete('/deleteearningdetails/{id}', [App\Http\Controllers\manageyourmonth::class, 'deleteearningdetails'])
    ->name('deleteearningdetails')
    ->middleware('auth');
Route::delete('/deleteexpencedetails/{id}', [App\Http\Controllers\manageyourmonth::class, 'deleteexpencedetails'])
    ->name('deleteexpencedetails')
    ->middleware('auth');

//Calculaor assignment
Route::get('calculator', [App\Http\Controllers\Calculatorcontroller::class, 'calculator'])->name('calculator');
Route::post('/calculate', [App\Http\Controllers\Calculatorcontroller::class, 'calculate']);


//Active invetment page
Route::get('activeinvestment', [App\Http\Controllers\ActiveInvestmentController::class, 'activeinvestment'])->name('activeinvestment');
Route::get('investments', [App\Http\Controllers\ActiveInvestmentController::class, 'viewinvestments'])->name('viewinvestments')->middleware('auth');
Route::post('/addinvestment', [App\Http\Controllers\ActiveInvestmentController::class, 'addinvestments']);
Route::get('editinvestments', [App\Http\Controllers\ActiveInvestmentController::class, 'editinvestments'])->name('editinvestments')->middleware('auth');
Route::delete('/deleteinvestmentdetails/{id}', [App\Http\Controllers\ActiveInvestmentController::class, 'deleteinvestmentdetails'])
    ->name('deleteinvestmentdetails')
    ->middleware('auth');


//Educational plans
Route::get('edusection', [App\Http\Controllers\Educationalplan::class, 'edusection'])->name('edusection');
Route::post('addsection', [App\Http\Controllers\Educationalplan::class, 'addsection'])->middleware('auth');
Route::get('edusection', [App\Http\Controllers\Educationalplan::class, 'edusection'])->name('edusection');
Route::get('subsection/{id}', [App\Http\Controllers\Educationalplan::class, 'subsection'])->name('subsection');
Route::get('/subsectionupdated',[App\Http\Controllers\Educationalplan::class,'subsectionupdated'])->name('subsectionupdated')->middleware('auth');
Route::post('addsubject', [App\Http\Controllers\Educationalplan::class, 'addsubject'])->middleware('auth');
Route::get('/material',[App\Http\Controllers\Educationalplan::class,'material'])->name('material')->middleware('auth');
Route::post('addroadmaps', [App\Http\Controllers\Educationalplan::class, 'addroadmaps'])->middleware('auth');
Route::post('settimeline', [App\Http\Controllers\Educationalplan::class, 'settimeline'])->middleware('auth');
Route::post('/printroadmap',[App\Http\Controllers\PDFController::class,'printroadmap'])->middleware('auth');

