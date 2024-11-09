<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/app');
});

Route::get('/app{all}', function () {
    return view('welcome');
})->where(['all' => '.*']);