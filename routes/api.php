<?php

use App\Http\Controllers\DiscordBotController;
use App\Http\Controllers\StaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/staff")->group(function() {
    Route::post("/add", [StaffController::class, "create"]);
});

Route::post("/connect", [DiscordBotController::class, "connect"]);
Route::prefix("/on")->group(function() {
    Route::get("/events", [DiscordBotController::class, "on_events"])->name("api.on.events");
    Route::get("/applications", [DiscordBotController::class, "on_applications"])->name("api.on.applications");
    Route::get("/forums", [DiscordBotController::class, "on_forums"])->name("api.on.forums");
});