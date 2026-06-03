<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Puble;
use Illuminate\Support\Facades\Artisan;



Route::get('/run-migration-su', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return 'Jabaaaal! Migrations executed successfully: <br><pre>' . Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

#======================================main===================================================#
Route::get('/',[Puble::class,'index'])->name('index');
#======================================students===============================================#


Route::get('/student/register',[Puble::class,'register'])->name('student.register');
Route::post('/student/setRegister',[Puble::class,'setRegister'])->name('student.setRegister');
      #*********************middleware*****************#
Route::middleware('student')->group(function (){
  
Route::get('/student/python',[Puble::class,'python'])->name('student.python');
Route::get('/student/frontIde',[Puble::class,'frontIde'])->name('student.frontIde');
Route::get('/student/c',[Puble::class,'c'])->name('student.c');
Route::get('/student/category/{id}',[Puble::class,'show'])->name('student.category');
Route::get('/student/info',[Puble::class,'info'])->name('student.info');
});
#======================================dashboard===============================================#


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

   Route::get('/admin/uplade',[Admin::class,'upload'])->name('admin.uplade');
   Route::post('/admin/setUpload',[Admin::class,'setUpload'])->name('admin.setUpload');
   Route::post('/admin/setLesson',[Admin::class,'setLesson'])->name('admin.setLesson');
   Route::post('/admin/setInfo',[Admin::class,'setInfo'])->name('admin.setInfo');
});
