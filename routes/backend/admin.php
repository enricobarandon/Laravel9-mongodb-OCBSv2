<?php
use App\Http\Controllers\Backend\AdminController;

Route::group(['prefix' => 'admin'], function() {
    Route::middleware('role:Administrator')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    });
});