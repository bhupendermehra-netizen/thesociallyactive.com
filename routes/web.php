<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ExtraImageController;
use Illuminate\Support\Facades\Auth;

Route::get("/", [ManageController::class,"index"])->name("index");
Route::get("/story", [ManageController::class,"about"])->name("about");
Route::get("/contact", [ManageController::class,"contact"])->name("contact");
Route::get('/projects', function () {
    return view('projects');
})->name('projects');

Route::get("/service/{slug}", [ManageController::class,"service"])->name("service");
Route::get("/page/{slug}", [ManageController::class,"extraPage"])->name("extra.page");

Route::post("/query", [ManageController::class,"queryStore"])->name("query");
Route::get("/thankyou", [ManageController::class,"thankyou"])->name("thankyou");

Auth::routes();

Route::prefix("admin")->name("admin.")->middleware("auth")->group(function(){
Route::get('/dashboard', [ManageController::class, 'dashboard'])->name('dashboard');
    // Page
    Route::get("page",[ManageController::class,"page"])->name("page");
    Route::get("page/view/{page}",[ManageController::class,"pageView"])->name("page.view");
    Route::get("page/add",[ManageController::class,"pageAdd"])->name("page.add");
    Route::get("page/edit/{id}",[ManageController::class,"pageEdit"])->name("page.edit");
    Route::post("page/edit/{id}",[ManageController::class,"pageUpdate"])->name("page.update");
    Route::post("page/add",[ManageController::class,"pageStore"])->name("page.add");

    // Profile
    Route::get("profile",[ManageController::class,"profile"])->name("profile");
    Route::post("profile/update",[ManageController::class,"profileUpdate"])->name("profile.update");
	
	// Profile
    Route::get("query",[ManageController::class,"query"])->name("query");
    Route::post("query/{id}/delete",[ManageController::class,"queryDelete"])->name("query.delete");
	
	//ExtraImage
	Route::get("extraImage/view/{page}",[ExtraImageController::class,"index"])->name("extraImage");
	Route::get("extraImage/add",[ExtraImageController::class,"add"])->name("extraImage.add");
	Route::get("extraImage/add/{page}",[ExtraImageController::class,"add"])->name("extraImage.add.page");
	Route::post("extraImage/add",[ExtraImageController::class,"create"])->name("extraImage.add");
	Route::get("extraImage/edit/{id}",[ExtraImageController::class,"edit"])->name("extraImage.edit");
	Route::post("extraImage/edit/{id}",[ExtraImageController::class,"update"])->name("extraImage.update");
	Route::get("extraImage/delete/{id}",[ExtraImageController::class,"delete"])->name("extraImage.delete");
	

});





Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
