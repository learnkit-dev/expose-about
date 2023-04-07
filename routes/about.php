<?php

use Illuminate\Support\Facades\Route;
use LearnKit\ExposeAbout\Http\Controllers\ServeAboutData;
use LearnKit\ExposeAbout\Http\Middleware\AuthenticateRequest;

Route::get('expose-about/json', ServeAboutData::class)
    ->middleware([AuthenticateRequest::class, ...config('expose-about.middleware')]);
