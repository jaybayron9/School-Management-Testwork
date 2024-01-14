<?php

use Livewire\Volt\Volt;
use App\Livewire\Welcome;
use App\Livewire\TestMary;
use App\Livewire\Auth\Login;
use App\Livewire\Page\Teacher;
use Illuminate\Support\Facades\Route; 

Route::get('/', Welcome::class)->name('admin');
Route::get('/login', Login::class)->name('login');
Route::get('/teacher', Teacher::class)->name('teacher')->middleware(['auth']);
Route::get('/logout', [Teacher::class, 'logout'])->name('logout');

Route::get('/export/csv', [Teacher::class, 'exportCSV'])->name('export.csv');
Route::get('/import/csv', [Teacher::class, 'importCSV'])->name('import.csv'); 

Volt::route('/test/volt', 'testvolt');