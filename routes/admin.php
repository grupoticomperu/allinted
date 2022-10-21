<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\TableController;
use App\Http\Livewire\Admin\CategoryList;
use App\Http\Livewire\Admin\BrandList;
use App\Http\Livewire\Admin\ModeloList;
use App\Http\Livewire\Admin\ProductList;
use App\Http\Livewire\Admin\ProductCreate;
use App\Http\Livewire\Admin\PurchaseList;
use App\Http\Livewire\Admin\PurchaseCreate;
use App\Http\Livewire\Admin\UmList;
use App\Http\Livewire\Admin\BudgetList;
use App\Http\Livewire\Admin\BudgetCreate;

Route::get('/tables', [TableController::class, 'showtables'])->name('admin.showtables');

Route::get('/categories', CategoryList::class)->name('category.list');
Route::get('/modelos', ModeloList::class)->name('modelo.list');
Route::get('/marcas', BrandList::class)->name('brand.list');
Route::get('/unidadesdemedida', UmList::class)->name('um.list');
Route::get('products', ProductList::class)->name('product.list');
Route::get('productoscreate', ProductCreate::class)->name('product.create');
Route::get('/compras', PurchaseList::class)->name('purchase.list');
Route::get('comprascreate', PurchaseCreate::class)->name('purchase.create');
Route::get('/presupuestos', BudgetList::class)->name('budget.list');
Route::get('presupuestoscreate', BudgetCreate::class)->name('budget.create');
