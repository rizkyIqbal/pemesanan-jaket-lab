<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\JacketController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\User\TransactionController as UserTransaction;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });


Route::get("/masuk", [UserController::class, "login"])->name("user.login");
Route::post("/masuk/ahh", [UserController::class, "sign_in"])->name("user.sign_in");
Route::get("/logout", [UserController::class, "logout"])->name("user.logout");

Route::get("/pdf", [UserController::class, "testPdf"]);

Route::get("/", [UserController::class, "index"])->name("user.index");

Route::controller(UserTransaction::class)->group(function () {
    Route::get("/transaksi", "index")->name("user.transaction.index");
    Route::get("/transaksi/pembayaran", "payment")->name("user.transaction.payment");
    Route::get("/transaksi/resi", "receipt")->name("user.transaction.receipt");
    Route::post("/transaksi", "store")->name("user.transaction.store");
    Route::get("transaksi/edit/{id}", "edit")->name("user.transaction.edit");
    Route::put("transaksi/edit/{id}", "update")->name("user.transaction.update");
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/tes', [AdminController::class, 'tes'])->name('test');



Route::controller(JacketController::class)->prefix("admin")->group(function () {
    Route::get('/jaket', "index")->name('admin.jacket.index');
    Route::get('/jaket/tambah', "create")->name('admin.jacket.create');
    Route::post('/jaket/tambah', "store")->name('admin.jacket.store');
    Route::delete('/jaket/hapus/{id}', "destroy")->name('admin.jacket.destroy');
    Route::get('/jaket/edit/{id}', "edit")->name('admin.jacket.edit');
    Route::put('/jaket/edit/{id}', "update")->name('admin.jacket.update');
});

Route::controller(TransactionController::class)->prefix("admin")->group(function () {
    Route::get("/transaksi", "index")->name("admin.transaction.index");
    Route::get("/transaksi/tambah", "create")->name("admin.transaction.create");
    Route::post("/transaksi/tambah", "store")->name("admin.transaction.store");
    Route::delete("/transaksi/hapus/{id}", "destroy")->name("admin.transaction.destroy");
    Route::get("/transaksi/edit/{id}", "edit")->name("admin.transaction.edit");
    Route::put("/transaksi/edit/{id}", "update")->name("admin.transaction.update");
});

Route::controller(SizeController::class)->prefix("admin")->group(function () {
    Route::get("/ukuran", "index")->name("admin.size.index");
    Route::get("/ukuran/tambah", "create")->name("admin.size.create");
    Route::post("/ukuran/tambah", "store")->name("admin.size.store");
    Route::delete("/ukuran/hapus/{id}", "destroy")->name("admin.size.destroy");
    Route::get("/ukuran/edit/{id}", "edit")->name("admin.size.edit");
    Route::put("/ukuran/edit/{id}", "update")->name("admin.size.update");
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});