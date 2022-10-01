<?php

use App\Http\Livewire\Admin\Admins\AddAdmin;
use App\Http\Livewire\Admin\Admins\AdminsList;
use App\Http\Livewire\Admin\Categories\CategoriesList;
use App\Http\Livewire\Admin\ContactUs\MessageDetails;
use App\Http\Livewire\Admin\ContactUs\MessagesList;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Login;
use App\Http\Livewire\Admin\Profile;
use App\Http\Livewire\Admin\Projects\AddProject;
use App\Http\Livewire\Admin\Projects\EditProject;
use App\Http\Livewire\Admin\Projects\ProjectsList;
use App\Http\Livewire\Admin\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::get('/', Login::class)->name('admin.login');

Route::middleware(['auth:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');

    Route::prefix('admins')->group(function () {
        Route::get('/', AdminsList::class)->name('admins');
        Route::get('/new-admin', AddAdmin::class)->name('admins.create');
    });

    Route::get('/categories', CategoriesList::class)->name('categories');

    Route::prefix('projects')->group(function () {
        Route::get('/', ProjectsList::class)->name('projects');
        Route::get('/new', AddProject::class)->name('projects.create');
        Route::get('/edit/{project}', EditProject::class)->name('projects.edit');
    });

    Route::prefix('messages')->group(function () {
        Route::get('/', MessagesList::class)->name('messages');
        Route::get('/{message}', MessageDetails::class)->name('messages.message-details');
    });

    Route::get('/settings', Settings::class)->name('settings');

    Route::get('logout',function(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    })->name('logout');
});
