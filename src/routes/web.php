<?php

use App\Http\Controllers\ForwardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route to Admin Interface
Route::get('/domain-forwarder', function (Request $request) {
    return phpinfo();
});

// Catch all Routes and pass to Forwarding Controller
Route::get('{any?}', function (Request $request) {
    $forward = new ForwardController;
    $forward->redirect($request);
})->where('any', '.*');


