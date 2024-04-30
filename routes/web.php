<?php

use Illuminate\Support\Facades\Route;
use App\Models\Customer;
use App\Models\subscription;
use App\Http\Controllers\SendMailController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customers/{id}', [SendMailController::class, 'index']);


