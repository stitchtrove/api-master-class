<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\AuthorTicketController;

// /tickets
// Example: /api/v1/tickets?filter[updatedAt]=2024-07-02,2024-07-06
// Example: /api/v1/tickets?sort=title,status
// Descending sort Example: /api/v1/tickets?sort=-title /api/v1/tickets?sort=createdAt
Route::middleware('auth:sanctum')->apiResource('tickets', TicketController::class);

// /authors
// Example: /api/v1/authors?filter[id]=1,6
Route::middleware('auth:sanctum')->apiResource('authors', AuthorController::class);

// /authors/{id}/tickets
// Example: /api/v1/authors/1/tickets?filter[status]=C,X
// Example: /api/v1/authors?filter[id]=6
Route::middleware('auth:sanctum')->apiResource('authors.tickets', AuthorTicketController::class);
