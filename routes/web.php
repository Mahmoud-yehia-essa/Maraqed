<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TombController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppVersionController;
use App\Http\Controllers\NotificationController;

// Route::get('/', function () {
//     return view('welcome');
// });







Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


/// Important add middleware checkUserRole
// Route::controller(DashboardController::class)->middleware(['auth', 'verified','checkUserRole'])->group(function () {


Route::controller(AdminController::class)
->middleware(['checkUserRole','auth'])
->group(function () {
    // Route::get('/admin/logout', 'destroy')->name('admin.logout');

    Route::get('/admin/profile', 'adminProfile')->name('admin.profile');

    Route::post('/admin/profile', 'adminProfileStore')->name('admin.profile.store');

    Route::get('/admin/change/password', 'AdminChangePassword')->name('admin.change.password');


    Route::post('/admin/update/password', 'AdminUpdatePassword')->name('update.password');







});


Route::controller(DashboardController::class)->middleware(['auth', 'verified','checkUserRole'])->group(function () {


    Route::get('/dashboard', 'showDashboard')->name('dashboard');


});



Route::controller(TombController::class)->group(function () {


    Route::get('/tomb/{id}', 'showFrontEndTomb')->name('show.front.end.tomb');


});



Route::controller(BlockController::class)->group(function () {


    Route::get('/block/{id}', 'showFrontEndBlock')->name('show.front.end.block');


});


Route::controller(NotificationController::class)->middleware(['checkUserRole','auth'])->group(function () {


    Route::get('/add/notification', 'sendNotification')->name('send.notification');
    Route::get('/all/notification', 'alldNotification')->name('all.notification');


});



Route::controller(AppVersionController::class)->middleware(['checkUserRole','auth'])->group(function () {


    Route::get('/add/versions', 'addVersions')->name('add.versions');
    Route::post('/update/versions', 'updateVersions')->name('update.versions.store');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

});



Route::controller(TombController::class)->middleware(['checkUserRole','auth'])->group(function () {


    Route::get('/all/tomb', 'allTomb')->name('all.tomb');

    Route::get('/add/tomb', 'addTomb')->name('add.tomb');

    Route::post('/add/tomb', 'addTombStore')->name('add.tomb.store');


    Route::get('/tomb/edit/{id}', 'editTomb')->name('edit.tomb');

    Route::post('/tomb/edit', 'editTombStore')->name('edit.tomb.store');



    Route::get('/tomb/inactive/{id}', 'tombInactive')->name('inactive.tomb');


    Route::get('/tomb/active/{id}', 'tombActive')->name('active.tomb');


    Route::get('/tomb/delete/{id}', 'deleteTomb')->name('delete.tomb');





});


Route::controller(BlockController::class)->middleware(['checkUserRole','auth'])->group(function () {


    Route::get('/all/block', 'allBlock')->name('all.block');

    Route::get('/add/block', 'addBlock')->name('add.block');

    Route::post('/add/block', 'addBlockStore')->name('add.block.store');


    Route::get('/block/edit/{id}', 'editBlock')->name('edit.block');

    Route::post('/block/edit', 'editBlockStore')->name('edit.block.store');



    Route::get('/block/inactive/{id}', 'blockInactive')->name('inactive.block');


    Route::get('/block/active/{id}', 'blockActive')->name('active.block');


    Route::get('/block/delete/{id}', 'deleteBlock')->name('delete.block');





});





Route::controller(UserController::class)->middleware(['checkUserRole','auth'])->group(function () {


    Route::get('/all/users', 'allUsers')->name('all.users');

    Route::get('/add/user', 'addUser')->name('add.user');
    Route::post('/add/user', 'addUserStore')->name('add.user.store');
    Route::get('/edit/user/{id}', 'editUser')->name('edit.user');

    Route::post('/edit/user', 'editUserStore')->name('edit.user.store');

    Route::get('/user/inactive/{id}', 'userInactive')->name('inactive.user');

    Route::get('/user/active/{id}', 'userActive')->name('active.user');

    Route::get('/user/delete/{id}', 'deleteUser')->name('delete.user');


    Route::get('/read-excel', 'readExcel')->name('read.excel');

    // Route::get('/read-excel', [ExcelController::class, 'readExcel']);





});




Route::controller(NewsController::class)->middleware(['checkUserRole','auth'])->group(function () {


    Route::get('/all/news', 'allNews')->name('all.news');

    Route::get('/add/news', 'addNews')->name('add.news');

    Route::post('/add/news', 'addNewsStore')->name('add.news.store');


    Route::get('/news/edit/{id}', 'editNews')->name('edit.news');

    Route::post('/news/edit', 'editNewsStore')->name('edit.news.store');



    Route::get('/news/inactive/{id}', 'newsInactive')->name('inactive.news');


    Route::get('/news/active/{id}', 'newsActive')->name('active.news');


    Route::get('/news/delete/{id}', 'deleteNews')->name('delete.news');





});





require __DIR__.'/auth.php';
