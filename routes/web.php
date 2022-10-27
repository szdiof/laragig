<?php

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserContoller;
use App\Http\Controllers\ListingContoller;

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

//Manage Listing
Route::get('/listing/manage', [ListingContoller::class, 'manage'])->middleware('auth');


//All Listings
Route::get('/', [ListingContoller::class, 'index']);


//Show create form
Route::get('/listing/create', [ListingContoller::class, 'create'])->middleware('auth');

//Store
Route::post('/listing', [ListingContoller::class, 'store'])->middleware('auth');

//Single Listing
Route::get('/listing/{listing}', [ListingContoller::class, 'show']);


//Show edit form Editing
Route::get('/listing/{listing}/edit', [ListingContoller::class, 'edit'])->middleware('auth');

// Update
Route::put('/listing/{listing}', [ListingContoller::class, 'update'])->middleware('auth');

//Delete
Route::delete('/listing/{listing}', [ListingContoller::class, 'destroy'])->middleware('auth');

//Show register create form
Route::get('/register', [UserContoller::class, 'create'])->middleware('guest');

//Create new User 
Route::post('/users', [UserContoller::class, 'store']);

//Logout User
Route::post('/logout', [UserContoller::class, 'logout'])->middleware('auth');

//Show login form
Route::get('/login', [UserContoller::class, 'login'])->name('login')->middleware('guest');

//login
Route::post('/users/authenticate', [UserContoller::class, 'authenticate']);



