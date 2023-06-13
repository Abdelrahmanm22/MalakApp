<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\VoiceController;
use App\Http\Controllers\Back\VideoController;
use App\Http\Controllers\Back\SettingController;
use App\Http\Controllers\Front\HomeController;
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
        Route::get('/addVoice', [VoiceController::class, 'addVoice'])->name('addVoice');
        Route::post('/postAddVoice', [VoiceController::class, 'postAddVoice'])->name('postAddVoice');
        Route::get('/deleteVoice/{id}',[VoiceController::class, 'delete']);
        
        Route::get('/updateVoice/{id}',[VoiceController::class, 'update'])->name('updateVoice');
        Route::post('/postUpdateVoice/{id}',[VoiceController::class,'postUpdate'])->name('admin.update.voice');
        //////////////////////Routes For voices//////////////////////


        //////////////////////Routes For videos//////////////////////
        Route::get('/videos', [VideoController::class, 'index'])->name('allVideos');
        Route::get('/addVideo', [VideoController::class, 'addVideo'])->name('addVideo');
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
    });
    
});

Route::group(['namespace'=>'Front'],function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/biography', [HomeController::class, 'biography'])->name('biography');
    Route::get('/video/{id}', [HomeController::class, 'video'])->name('video');

});