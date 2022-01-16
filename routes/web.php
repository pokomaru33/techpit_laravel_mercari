<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mypage\ProfileController;
use App\Http\Controllers\Mypage\SoldItemsController;
use App\Http\Controllers\Mypage\BoughtItemsController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\PdfController;

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

Route::get('/', [App\Http\Controllers\ItemsController::class, 'showItems'])->name('top');

Auth::routes();

Route::get('items/{item}', [App\Http\Controllers\ItemsController::class, 'showItemDetail'])->name('item');

Route::prefix('mypage')
    ->middleware('auth')
    ->group(function(){
        Route::get('edit-profile', [ProfileController::class, 'showProfileEditForm'])->name('mypage.edit-profile');
        Route::post('edit-profile', [ProfileController::class, 'editProfile'])->name('mypage.edit-profile');

        Route::get('bought-items', [BoughtItemsController::class, 'showBoughtItems'])->name('mypage.bought-items');

        Route::get('sold-items', [SoldItemsController::class, 'showSoldItems'])->name('mypage.sold-items');
    });

Route::middleware('auth')
    ->group(function(){
        Route::get('items/{item}/buy', [App\Http\Controllers\ItemsController::class, 'showBuyItemForm'])->name('item.buy');
        Route::post('items/{item}/buy', [App\Http\Controllers\ItemsController::class, 'buyItem'])->name('item.buy');
        
        Route::get('sell', [SellController::class, 'showSellForm'])->name('sell');
        Route::post('sell', [SellController::class, 'sellItem'])->name('sell');

        Route::get('/pdf/dl', [PdfController::class, 'index'])->name('pdf.dl');
        Route::get('/pdf/view', [PdfController::class, 'view'])->name('pdf.view');
    });