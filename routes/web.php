<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TopController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//TopController
Route::get('/',       [TopController::class, 'index']);
Route::get('/OA/top', [TopController::class, 'index'])->name('Home');

//SignupController
Route::get('/Signup', [SignupController::class, 'index'])->name('Signup');

//loginController
Route::get('/Login', [loginController::class, 'index'])->name('Login');

//MyAuthController
Route::post('/authLogin',  [MyAuthController::class, 'login' ])->name('authLogin');
Route::post('/authLogout', [MyAuthController::class, 'logout'])->name('authLogout');
Route::post('/',           [MyAuthController::class, 'signup'])->name('authSignup');

//OrderController
Route::get( '/OA/Order',                     [OrderController::class, 'index'             ])->name('Order');
Route::post('/OA/Order/OrderCheck',          [OrderController::class, 'check'             ])->name('OrderCheck');
Route::get( '/OA/Order/AddFurniture',        [OrderController::class, 'addFurniture'      ])->name('AddFurniture');
Route::post('/OA/Order/AddFurniture',        [OrderController::class, 'addFurniturePost'  ])->name('AddFurniturePost');
Route::post('/OA/Order',                     [OrderController::class, 'addFurnitureAdd'   ])->name('AddFurnitureAdd');
Route::post('/OA/Order/AddFurniture/Edit',   [OrderController::class, 'addFurnitureEdit'  ])->name('AddFurnitureEdit');
Route::put( '/OA/Order/AddFurniture/Edit',   [OrderController::class, 'addFurnitureEditDo'])->name('AddFurnitureEditDo');
Route::get( '/OA/Order/Delete',              [OrderController::class, 'delete'            ])->name('Delete');
Route::post('/OA/Order/Insert',              [OrderController::class, 'insert'            ])->name('OrderInsert');

//OrderListController
Route::get('/OA/orderList',      [OrderListController::class, 'index'  ])->name('OrderList');
Route::get('/OA/orderList/{id}', [OrderListController::class, 'detailt'])->name('OrderDetailt');


require __DIR__.'/auth.php';
