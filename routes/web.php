<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;


Route::resource('album', AlbumController::class);
