<?php

use App\Livewire\PageA;
use App\Livewire\UserList;
use App\Livewire\PageB;
use App\Livewire\CreateUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',UserList::class)->name('users');
Route::get('user/add',CreateUser::class)->name('create.user');
Route::post('user/store',CreateUser::class)->name('user.store');
Route::get('user/{user}/edit', CreateUser::class)->name('user.edit');



Route::get('/page-a',PageA::class);
Route::get('/page-b',PageB::class);
