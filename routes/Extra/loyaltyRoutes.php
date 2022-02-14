<?php

use Illuminate\Support\Facades\Route;

// All loyalty related routes goes here...

// Route::prefix('loyalty')->name('loyalty.')->group(function () {
//     Route::resource('/card','Setting\CardSetupController');
// });
Route::prefix('loyalty')->name('loyalty.')->group(function () {
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::resource('/card','Setting\CardSetupController');
        Route::resource('/store','Setting\StoreSetupController');
        Route::resource('/promotion','Setting\PromotionSetupController');
        Route::patch('/promotion/{id}/change-status','Setting\PromotionSetupController@changePromotionStatus')
                    ->name('promotion.change_status');
    });

    Route::get('/users','User\LoyaltyUserController@index')->name('get.users');
    Route::get('/users/{id}/get-details','User\LoyaltyUserController@getDetails')->name('get.userDetails');
    Route::post('/users/{id}/Assign-to-Membership-program','User\LoyaltyUserController@assign')->name('assign.user');
    Route::post('/users/{id}/purchase-by-loyalty-point','User\LoyaltyUserController@purchase')->name('purchase.byLoyaltyPoint');
    Route::post('/users/{id}/cash-withdrawal','User\LoyaltyUserController@cashWithdraw')->name('withdrawCash.byLoyaltyPoint');

    Route::get('/invoices','LoyaltyInvoiceController@index')->name('get.invoices');
    Route::get('/loyalty-point-usage','LoyaltyUsageController@index')->name('get.usage');

    Route::get('/promotional-programs','Promotion\LoyaltyPromotionController@index')->name('get.promotionalPrograms');
    Route::post('/promotional-programs','Promotion\LoyaltyPromotionController@store')->name('store.promotionalPrograms');
    Route::get('/promotional-programs/{id}/show','Promotion\LoyaltyPromotionController@show')->name('get.promotionalProgramDetails');
    Route::patch('/promotional-programs/{id}','Promotion\LoyaltyPromotionController@extend')->name('update.promotionalProgram');
    Route::delete('/promotional-programs/{id}','Promotion\LoyaltyPromotionController@delete')->name('delete.promotionalProgram');
});


