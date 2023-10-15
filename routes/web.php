<?php

use App\Livewire\Homepage;
use App\Livewire\NewsDetail;
use App\Livewire\ClinicDetail;
use App\Livewire\Admin\AddNews;
use App\Livewire\Admin\EditNews;
use App\Livewire\Admin\NewsList;
use App\Livewire\ClinicListPage;
use App\Livewire\Admin\AddClinic;
use App\Livewire\Admin\AddDoctor;
use App\Livewire\Admin\ClinicList;
use App\Livewire\Admin\EditClinic;
use App\Livewire\Admin\EditDoctor;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\DoctorListPage;


Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('homepage');
})->name('logout');


Route::get('/', Homepage::class)->name('homepage');
Route::get('/clinic/{id}', ClinicDetail::class)->name('clinic-detail');
Route::get('/news-detail/{slug}', NewsDetail::class)->name('news-detail');
Route::get('/clinics', ClinicListPage::class)->name('clinic-list');

// Admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/add-clinic', AddClinic::class)->name('admin.add-clinic');
    Route::get('/clinics', ClinicList::class)->name('admin.clinic-list');
    Route::get('/clinic/{id}', EditClinic::class)->name('admin.edit-clinic');
    Route::get('/add-doctor', AddDoctor::class)->name('admin.add-doctor');
    Route::get('/doctors', DoctorListPage::class)->name('admin.doctor-list');
    Route::get('/doctor/{doctor}', EditDoctor::class)->name('admin.edit-doctor');
    Route::get('/add-news', AddNews::class)->name('admin.add-news');
    Route::get('/news', NewsList::class)->name('admin.news-list');
    Route::get('/news-detail/{id}', EditNews::class)->name('admin.edit-news');
});
