<?php

use App\Http\Controllers\ApplyController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\WikiController;
use App\Models\Chat;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [RedirectController::class, "index"])->name("welcome");

Route::get('/profile', [RedirectController::class, "profile"])->name('dashboard');

Route::get("/forum", [ForumController::class, "index"])->name("forum");

Route::get("/logout-user", [RedirectController::class, "logout"])->middleware(["auth"])->name("logout");

Route::get("/personal", [RedirectController::class, "personal"])->name("personal");

Route::get("/join-in-our-team", [RedirectController::class, "redirectToApplyInStaff"])->name("apply.staff");

Route::prefix("/forum")->group(function() {
    Route::post("/create", [ForumController::class, "store"])->middleware(["auth"])->name("forum.create");
    Route::get("/view/{user_id}/{id}", [ForumController::class, "show"]);
    Route::post("/comment/{id}", [MessageController::class, "create"])->middleware(["auth"]);
    Route::get("/delete/{id}", [ForumController::class, "destroy"])->middleware(["auth"])->name("forum.delete");
});

Route::prefix("wiki")->group(function() {
    Route::get("/", [WikiController::class, "index"])->name("wiki");
    Route::get("/view/{button_name}", [WikiController::class, "show"]);
});

Route::post("/staff/apply", [ApplyController::class, "staffApply"])->middleware(["auth"])->name("apply");

Route::post("/set-about-me", [Controller::class, "setAboutMe"])->middleware(["auth"])->name("about_me.set");

Route::get("/profile-private", [Controller::class, "privateProfile"])->middleware(["auth"])->name("profile.private");
Route::get("/profile-public", [Controller::class, "publicProfile"])->middleware(["auth"])->name("profile.public");

Route::get('/profile/view/{username}', [RedirectController::class, "viewProfile"]);

Route::prefix("/event")->group(function() {
    Route::get("/", function() {
        return redirect()->route("welcome");
    });
    Route::post("/create", [EventController::class, "store"])->middleware(["auth"])->name("event.create");
    Route::get("/view/{user_id?}/{id}", [EventController::class, "show"])->name("event.view");
    Route::get("/delete/{id}", [EventController::class, "destroy"])->middleware(["auth"])->name("event.delete");
});

Route::get("/admin", [RedirectController::class, "redirectToAdmin"])->middleware(["auth"])->name("admin");

Route::get("/set-status/{id}", [ApplyController::class, "upgradeStatus"])->middleware(["auth"]);

Route::get("/search", [Controller::class, "search"]);

Route::prefix("chat")->group(function() {
    Route::get("/live", [ChatController::class, "index"])->name("chat.view");
    Route::post("/store", [ChatController::class, "store"])->name("chat.store");
    Route::get("/load", [ChatController::class, "load"])->name("chat.load");
    Route::get("/delete", [ChatController::class, "destroy"])->name("chat.delete_all");
    Route::get("/download", [ChatController::class, "download_log"])->name("chat.download");
});
Route::get("/staff-applications/delete/{id}", [ApplyController::class, "delete"])->name("staff_applications.delete");