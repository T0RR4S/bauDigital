<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompraController;

use App\Http\Controllers\EmailController;

Route::get('/', [ProdutoController::class, 'index'])->middleware('auth')->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produto.show');

    Route::get('/meus-produtos', [ProdutoController::class, 'meusProdutos'])->name('produtos.meus');
    Route::get('/produtos/criar', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/{produto}/editar', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

    Route::post('/produto/{produto}/comprar', [CompraController::class, 'comprar'])->name('produto.comprar');
    Route::get('/historico-vendas', [CompraController::class, 'historicoVendas'])->name('vendas.historico');

    Route::get('/historico-vendas/pdf', [CompraController::class, 'pdfVendas'])->name('vendas.pdf');

    Route::get('/enviar-email', [EmailController::class, 'create'])->name('email.create');
    Route::post('/enviar-email', [EmailController::class, 'send'])->name('email.send');
});

require __DIR__.'/auth.php';
