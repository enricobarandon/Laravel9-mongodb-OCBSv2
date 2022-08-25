<?php
use App\Http\Controllers\Backend\CashierController;

Route::group(['prefix' => 'cashier'], function() {
    Route::middleware('role:Cashier')->group(function(){
        Route::get('/', [CashierController::class, 'index'])->name('cashier.index');
    });

});