<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\VendorController;
use App\Http\Controllers\Admin\Market\SectionController;
use App\Http\Controllers\Admin\Market\CategoryController;

Route::middleware('role:vendor|admin')->prefix('admin/market')->name('admin.market.')->group(function () {
    Route::get('vendors', [VendorController::class, 'index'])->name('vendors');

    // Sections
    Route::get('sections', [SectionController::class, 'index'])->name('sections');
    Route::post('section/store', [SectionController::class, 'store'])->name('section.store');
    Route::get('section/{slug}/edit', [SectionController::class, 'edit'])->name('section.edit');
    Route::post('section/{slug}/update', [SectionController::class, 'update'])->name('section.update');
    Route::get('section/{slug}/delete', [SectionController::class, 'delete'])->name('section.delete');
    Route::get('section/{slug}/restore', [SectionController::class, 'restore'])->name('section.restore');
    Route::get('section/{slug}/destroy', [SectionController::class, 'destroy'])->name('section.destroy');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{slug}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/{slug}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/{slug}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('category/{slug}/restore', [CategoryController::class, 'restore'])->name('category.restore');
    Route::get('category/{slug}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('category/appendCategoryLevel', [CategoryController::class, 'appendCategoryLevel'])->name('category.appendCategoryLevel');

    // Brands
    Route::get('brands', [BrandController::class, 'index'])->name('brands');
    Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('brand/{slug}/edit', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/{slug}/update', [BrandController::class, 'update'])->name('brand.update');
    Route::get('brand/{slug}/delete', [BrandController::class, 'delete'])->name('brand.delete');
    Route::get('brand/{slug}/restore', [BrandController::class, 'restore'])->name('brand.restore');
    Route::get('brand/{slug}/destroy', [BrandController::class, 'destroy'])->name('brand.destroy');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/{slug}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/{slug}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('product/{slug}/delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::get('product/{slug}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::get('product/{slug}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('product/{slug}/add_attributes', [ProductController::class, 'add_attributes'])->name('product.attributes.add');
    Route::post('product/{slug}/attributes/store', [ProductController::class, 'store_attributes'])->name('product.attributes.store');
    Route::get('product/{slug}/attribute/{sku}/edit', [ProductController::class, 'edit_attribute'])->name('product.attribute.edit');
    Route::get('product/{slug}/attribute/{sku}/delete', [ProductController::class, 'delete_attribute'])->name('product.attribute.delete');
    Route::post('product/{slug}/attributes/{sku}/update', [ProductController::class, 'update_attributes'])->name('product.attributes.update');
});
