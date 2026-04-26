<?php

use Src\Route;

Route::add('GET', '/', [Controller\ApiController::class, 'index']);
Route::add('POST', '/echo', [Controller\ApiController::class, 'echo']);