<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json(['name' => 'Qemmat Al Majd API', 'status' => 'ok']));
