<?php
use Illuminate\support\Facades\Route;
use App\Http\Controllers\HomeController;

//Route::get('/', function (){
//return view('welcome');
//.});

Route::get('/',[HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);
