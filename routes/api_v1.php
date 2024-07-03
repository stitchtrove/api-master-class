<?php

use App\Http\Controllers\Api\V1\TicketController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::apiResource('tickets', TicketController::class);
