<?php

use PhpSlides\view;
use PhpSlides\Route;
use PhpSlides\Http\Request;
use App\Controllers\UserController;

/**
 * --------------------------------------------------------------------
 * | Register web routes here to render according to request
 * | NOTE - that browser or any other request cannot access any page
 * | that are not coming from route, it redirects to 404
 * --------------------------------------------------------------------
 */
Route::view('/', '::App');
Route::any('*', view::render('::Errors::404'))->name('notFound');
