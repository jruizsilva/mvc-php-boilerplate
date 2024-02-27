<?php

use Lib\Route;

use App\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/contact', function () {
  echo 'hola desde contact';
});

Route::get('/about', function () {
  echo 'hola desde about';
});

Route::get('/courses/:slug', function ($slug) {
  echo 'El curso es: ' . $slug;
});

Route::dispatch();