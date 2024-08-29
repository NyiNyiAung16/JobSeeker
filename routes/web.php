<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplyFormController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployerApprovedJobsController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\EmployerDestroyJobController;
use App\Http\Controllers\EmployerEditJobController;
use App\Http\Controllers\EmployerRejectedJobsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobCreateController;
use App\Http\Controllers\JobDetailsController;
use App\Http\Controllers\JobsListsController;
use App\Http\Controllers\JobStoreController;
use App\Http\Controllers\JobWithDrawController;
use App\Http\Controllers\PhotoStoreController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowAppliedEmployeeDetailsController;
use App\Http\Controllers\ShowAppliedEmployeesController;
use App\Http\Controllers\ThankyouController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\EmployerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/about-us',AboutUsController::class)->name('about-us');
Route::get('/privacy',PrivacyController::class)->name('privacy');
Route::get('/jobs',JobsListsController::class);
Route::get('/jobs/{job}',JobDetailsController::class)->name('jobs.show');
Route::post('/photo/store',PhotoStoreController::class)->name('photo.store');

Route::middleware(['auth','verified',AdminMiddleware::class])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users/{user}',[AdminController::class,'userShow'])->name('admin.user.show');
    Route::get('/admin/job-management/pendingJobs',[AdminController::class,'showPendingJobs'])->name('admin.jobManagement.pending');
    Route::get('/admin/job-management/approvedJobs',[AdminController::class,'showApprovedJobs'])->name('admin.jobManagement.approved');
    Route::get('/admin/job-management/rejectedJobs',[AdminController::class,'showRejectedJobs'])->name('admin.jobManagement.rejected');
    Route::get('/admin/user-management',[AdminController::class,'userManagement'])->name('admin.userManagement');
    Route::get('/admin/content-management',[AdminController::class,'contentManagement'])->name('admin.contentManagement');
    Route::get('/admin/contents/{content}/edit',[ContentController::class,'edit'])->name('admin.content.edit');
    Route::post('/admin/jobs/{job}/approved',[AdminController::class,'approved'])->name('admin.approvedJob');
    Route::post('/admin/jobs/{job}/rejected',[AdminController::class,'rejected'])->name('admin.rejectedJob');
    Route::post('/admin/user/store',[AdminController::class,'storeUser'])->name('admin.user.store');
    Route::post('/admin/contents',[ContentController::class,'store'])->name('admin.contents.store');
    Route::patch('/admin/users/{user}/update',[AdminController::class,'userUpdate'])->name('admin.user.update');
    Route::patch('/admin/contens/{content}',[ContentController::class,'update'])->name('admin.contents.update');
    Route::delete('/admin/users/{user}',[AdminController::class,'destroyUser'])->name('admin.user.destroy');
    Route::delete('/admin/contents/{content}/destroy',[ContentController::class,'destroy'])->name('admin.content.destroy');
}); 

Route::middleware(['auth','verified',EmployerMiddleware::class])->group(function(){
    Route::get('/employer/dashboard',EmployerDashboardController::class)->name('employer.dashboard');
    Route::get('/employer/approvedJobs',EmployerApprovedJobsController::class)->name('employer.approvedJobs');
    Route::get('/employer/rejectedJobs',EmployerRejectedJobsController::class)->name('employer.rejectedJobs');
    Route::get('/job/create',JobCreateController::class)->name('job.create');
    Route::get('/appliedEmployees',ShowAppliedEmployeesController::class)->name('employer.appliedEmployees');
    Route::get('/employers/jobs/{job}/edit',[EmployerEditJobController::class,'show'])->name('employer.editJob');
    Route::patch('/employers/jobs/{job}/update',[EmployerEditJobController::class,'update'])->name('employer.updateJob');
    Route::post('/job/store',JobStoreController::class)->name('job.store');
    Route::delete('/employer/jobs/{job}/destroy',EmployerDestroyJobController::class)->name('employer.destroyJob');
});


Route::middleware(['auth','verified'])->group(function () {
    Route::get('/employee/dashboard', EmployeeDashboardController::class)->middleware(EmployeeMiddleware::class)->name('employee.dashboard');
    Route::delete('/employee/{job}/withdraw',JobWithDrawController::class)->middleware(EmployeeMiddleware::class)->name('employee.job.withdraw');
    Route::get('/users/{user}/jobs/{job}',ShowAppliedEmployeeDetailsController::class)->name('appliedUser.details');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/jobs/{job}/applyForm',[ApplyFormController::class,'get'])->name('jobs.get');
    Route::post('/jobs/{job}/applyForm',[ApplyFormController::class,'store'])->name('jobs.store');
    Route::get('/thankyou',ThankyouController::class);
});

require __DIR__.'/auth.php';
