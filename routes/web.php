<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\SiswaAuthController;

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/upgrade', [AdminController::class, 'naikKelas'])->name('upgrade');
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/admin/struktur', [StrukturController::class, 'admin'])->name('struktur.admin');
    Route::get('/admin/struktur/create', [StrukturController::class, 'create'])->name('struktur.create');
    Route::post('/admin/struktur', [StrukturController::class, 'store'])->name('struktur.store');
    Route::get('/admin/struktur/{id}/edit', [StrukturController::class, 'edit'])->name('struktur.edit');
    Route::put('/admin/struktur/{id}', [StrukturController::class, 'update'])->name('struktur.update');
    Route::delete('/admin/struktur/{id}', [StrukturController::class, 'destroy'])->name('struktur.destroy');

    Route::get('/admin/galeri', [GaleriController::class, 'admin'])->name('galeri.admin');
    Route::get('/admin/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/admin/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/admin/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/admin/galeri/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    Route::get('/admin/kegiatan', [KegiatanController::class, 'admin'])->name('kegiatan.admin');
    Route::get('/kegiatan/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
    Route::post('/kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    Route::get('/admin/siswa', [SiswaController::class, 'admin'])->name('siswa.admin');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');
    Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');

    Route::get('/admin/alumni', [AlumniController::class, 'admin'])->name('alumni.admin');
    Route::get('/alumni/create', [AlumniController::class, 'create'])->name('alumni.create');
    Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');
    Route::get('/alumni/{id}/edit', [AlumniController::class, 'edit'])->name('alumni.edit');
    Route::put('/alumni/{id}', [AlumniController::class, 'update'])->name('alumni.update');
    Route::delete('/alumni/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');

    Route::get('/admin/maps', [MapsController::class, 'admin'])->name('maps.admin');

    Route::get('/admin/prestasi', [PrestasiController::class, 'admin'])->name('prestasi.admin');
    Route::get('/prestasi/create', [PrestasiController::class, 'create'])->name('prestasi.create');
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::get('/prestasi/{id}/edit', [PrestasiController::class, 'edit'])->name('prestasi.edit');
    Route::put('/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
});

Route::middleware(['auth', 'siswa'])->group(function () {
    Route::get('/portofolio', [SiswaController::class, 'portofolio'])->name('siswa.portofolio');
    Route::post('/portofolio', [SiswaController::class, 'updatePortofolio'])->name('siswa.portofolio.update');

    Route::get('/siswa/dashboard', [SiswaAuthController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/profile', [SiswaAuthController::class, 'profile'])->name('siswa.profile');
    Route::post('/siswa/profile', [SiswaAuthController::class, 'updateProfile'])->name('siswa.profile.update');
    Route::post('/siswa/password', [SiswaAuthController::class, 'changePassword'])->name('siswa.password.change');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process'); // Change 'auth' to 'login'
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');

Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');

Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/{slug}', [SiswaController::class, 'show'])->name('siswa.show');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi');
