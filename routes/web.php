<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Form;

Route::get('/', function () {
    return redirect()->route('admin.forms.index');
});

// Public
Route::get('/forms/{form:slug}', \App\Livewire\Public\ShowForm::class)->name('forms.show');

// Auth
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/forms', \App\Livewire\Admin\ListForms::class)->name('forms.index');
    Route::get('/forms/create', \App\Livewire\Admin\FormBuilder::class)->name('forms.create');
    Route::get('/forms/{form}/edit', \App\Livewire\Admin\FormBuilder::class)->name('forms.edit');
    Route::get('/forms/{form}/delete', function (Form $form) {
        $form->delete();
        return redirect()->route('admin.forms.index')->with('success', 'Form eliminato.');
    })->name('forms.delete');
});
