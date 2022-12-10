<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\JacketController;
use App\Http\Controllers\admin\BankController;
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
Route::get("/keluar", [UserController::class, "logout"])->name("user.logout");

Route::get("/pdf", [UserController::class, "testPdf"])->name("pdf");

Route::get("/", [UserController::class, "index"])->name("user.index");

Route::controller(UserTransaction::class)->group(function () {
    Route::get("/transaksi", "index")->name("user.transaction.index");
    Route::post("/transaksi", "store")->name("user.transaction.store");
    Route::get("/transaksi/pembayaran", "payment")->name("user.transaction.payment");
    Route::post("/transaksi/pembayaran", "store_payment")->name("user.transaction.store_payment");
    Route::get("/transaksi/resi", "receipt")->name("user.transaction.receipt");
    Route::put("/transaksi/resi", "store_receipt")->name("user.transaction.store_receipt");
    Route::get('/transaksi/hapus', "destroy")->name('user.transaction.destroy');
});

Route::get('/about', [UserController::class, 'about'])->name('user.about');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return Inertia::render('Admin/Index');
})->name('admin');

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::controller(JacketController::class)->group(function () {
        Route::get('/jaket', "index")->name('admin.jacket.index');
        Route::get('/jaket/tambah', "create")->name('admin.jacket.create');
        Route::post('/jaket/tambah', "store")->name('admin.jacket.store');
        Route::delete('/jaket/hapus/{id}', "destroy")->name('admin.jacket.destroy');
        Route::get('/jaket/edit/{id}', "edit")->name('admin.jacket.edit');
        Route::put('/jaket/edit/{id}', "update")->name('admin.jacket.update');
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::get("/transaksi", "index")->name("admin.transaction.index");
        Route::get("/transaksi/tambah", "create")->name("admin.transaction.create");
        Route::post("/transaksi/tambah", "store")->name("admin.transaction.store");
        Route::delete("/transaksi/hapus/{id}", "destroy")->name("admin.transaction.destroy");
        Route::get("/transaksi/edit/{id}", "edit")->name("admin.transaction.edit");
        Route::put("/transaksi/edit/{id}", "update")->name("admin.transaction.update");
    });

    Route::controller(BankController::class)->group(function () {
        Route::get("/rekening", "index")->name("admin.bank.index");
        Route::get("/rekening/tambah", "create")->name("admin.bank.create");
        Route::post("/rekening/tambah", "store")->name("admin.bank.store");
        Route::delete("/rekening/hapus/{id}", "destroy")->name("admin.bank.destroy");
        Route::get("/rekening/edit/{id}", "edit")->name("admin.bank.edit");
        Route::put("/rekening/edit/{id}", "update")->name("admin.bank.update");
    });

    // Route::get("/logout", [AdminController::class, 'perform'])->name("admin.logout");
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });
