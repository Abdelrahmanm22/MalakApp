<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\BookController;
use App\Http\Controllers\Back\ContactController;
use App\Http\Controllers\Back\DropdownController;
use App\Http\Controllers\Back\SectionController;
use App\Http\Controllers\Back\VoiceController;
use App\Http\Controllers\Back\VideoController;
use App\Http\Controllers\Back\SettingController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ContactsController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('back.login');
// });


Route::group(['namespace'=>'Back','prefix'=>'admin'],function(){


    /////////////////auth For Admin////////////////////////////
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/postLogin', [AdminController::class, 'postLogin'])->name('adminLogin');
    Route::get('/addAdmin', [AdminController::class, 'register'])->name('register');
    Route::post('/postRegister', [AdminController::class, 'postRegister'])->name('adminRegister');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    /////////////////auth For Admin////////////////////////////


    Route::group(['middleware'=>'auth'],function(){
        Route::get('/home', [AdminController::class, 'home'])->name('adminHome');

        //////////////////////Routes For voices//////////////////////
        Route::get('/voices', [VoiceController::class, 'index'])->name('allVoices');
        // Route::get('/addVoice', [VoiceController::class, 'addVoice'])->name('addVoice');
        Route::post('/postAddVoice', [VoiceController::class, 'postAddVoice'])->name('postAddVoice');
        Route::get('/deleteVoice/{id}/{section_id}',[VoiceController::class, 'delete']);
        
        Route::get('/updateVoice/{id}',[VoiceController::class, 'update'])->name('updateVoice');
        Route::post('/postUpdateVoice/{id}',[VoiceController::class,'postUpdate'])->name('admin.update.voice');
        //////////////////////Routes For voices//////////////////////


        //////////////////////Routes For videos//////////////////////
        Route::get('/videos', [VideoController::class, 'index'])->name('allVideos');
        // Route::get('/addVideo', [VideoController::class, 'addVideo'])->name('addVideo');
        Route::post('/postAddVideo', [VideoController::class, 'postAddVideo'])->name('postAddVideo');
        Route::get('/deleteVideo/{id}',[VideoController::class, 'delete']);
        Route::get('/updateVideo/{id}',[VideoController::class, 'update'])->name('updateVideo');
        Route::post('/postUpdateVideo/{id}',[VideoController::class,'postUpdate'])->name('admin.update.video');
        //////////////////////Routes For voices//////////////////////

        ///for settings=================================
        Route::get('/setting',[SettingController::class, 'index'])->name('settings');
        Route::get('/updateSetting/{id}',[SettingController::class,'update']);
        Route::post('/postUpdate/{id}',[SettingController::class,'postUpdate'])->name('admin.update.setting');
        ///for settings=================================


        //////////////////////Routes For Books//////////////////////
        Route::get('/books', [BookController::class, 'index'])->name('allBooks');
        Route::get('/addBook', [BookController::class, 'addBook'])->name('addBook');
        Route::post('/postAddBook', [BookController::class, 'postAddBook'])->name('postAddBook');
        Route::get('/updateBook/{id}',[BookController::class, 'update'])->name('updateBook');
        Route::post('/postUpdateBook/{id}',[BookController::class,'postUpdate'])->name('admin.update.book');
        //////////////////////Routes For Books//////////////////////

        //////////////////////Routes For Sections//////////////////////
        Route::get('/Sections', [SectionController::class, 'index'])->name('allSections');
        Route::get('/addSection', [SectionController::class, 'addSection'])->name('addSection');
        Route::post('/postAddSection', [SectionController::class, 'postAddSection'])->name('postAddSection');
        Route::get('/updateSection/{id}',[SectionController::class, 'update'])->name('updateSection');
        Route::post('/postUpdateSection/{id}',[SectionController::class,'postUpdate'])->name('admin.update.section');
        //////////////////////Routes For Sections//////////////////////


        //////////////////////Routes For dropdown//////////////////////
        Route::get('/addVideo', [DropdownController::class, 'index'])->name('addVideo');
        Route::get('/addVoice', [DropdownController::class, 'index2'])->name('addVoice');
        Route::post('api/fetch-sections', [DropdownController::class, 'fetchSection']);
        //////////////////////Routes For dropdown//////////////////////

        //////////////////////Routes for adminContact/////////////////
        Route::get('/contact', [ContactController::class, 'index'])->name('contact');
        //////////////////////Routes for adminContact/////////////////
    });
    
});

Route::group(['namespace'=>'Front'],function(){
    Route::get('/', [HomeController::class, 'index'])->name('videos');
    Route::get('/voices', [HomeController::class, 'indexVoices'])->name('voices');
    Route::get('/timeLectures', [HomeController::class, 'timeLectures'])->name('timeLectures');
    Route::get('/fatawy', [HomeController::class, 'fatawy'])->name('fatawy');
    Route::get('sectionsVideo/{id}',[HomeController::class, 'sectionsVideo'])->name('sectionsVideo');
    Route::get('video/{id}',[HomeController::class, 'getVideo'])->name('getVideo');
    Route::post('postContact/',[ContactsController::class,'postContact'])->name('postContact');
    
});