<?php

use App\Models\Market\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Market\MarketController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\BannerController;
use App\Http\Controllers\Admin\Market\FilterController;
use App\Http\Controllers\Admin\Market\VendorController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\SectionController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Market\ProductController as UProductController;

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

    // Filters
    Route::get('filters', [FilterController::class, 'index'])->name('filters');
    Route::post('filter/store', [FilterController::class, 'store'])->name('filter.store');
    Route::get('filter/{slug}/edit', [FilterController::class, 'edit'])->name('filter.edit');
    Route::post('filter/{slug}/update', [FilterController::class, 'update'])->name('filter.update');
    Route::get('filter/{slug}/delete', [FilterController::class, 'delete'])->name('filter.delete');
    Route::get('filter/{slug}/restore', [FilterController::class, 'restore'])->name('filter.restore');
    Route::get('filter/{slug}/destroy', [FilterController::class, 'destroy'])->name('filter.destroy');

    // Filter Values
    Route::get('filter/values', [FilterController::class, 'values'])->name('filter.values');
    Route::post('filter/value/store', [FilterController::class, 'value_store'])->name('filter.value.store');
    Route::get('filter/value/{slug}/edit', [FilterController::class, 'value_edit'])->name('filter.value.edit');
    Route::post('filter/value/{slug}/update', [FilterController::class, 'value_update'])->name('filter.value.update');
    Route::get('filter/value/{slug}/delete', [FilterController::class, 'value_delete'])->name('filter.value.delete');
    Route::get('filter/value/{slug}/restore', [FilterController::class, 'value_restore'])->name('filter.value.restore');
    Route::get('filter/value/{slug}/destroy', [FilterController::class, 'value_destroy'])->name('filter.value.destroy');


    // Banner
    Route::get('banners', [BannerController::class, 'index'])->name('banners');
    Route::post('banner/store', [BannerController::class, 'store'])->name('banner.store');
    Route::get('banner/{slug}/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::post('banner/{slug}/update', [BannerController::class, 'update'])->name('banner.update');
    Route::get('banner/{slug}/delete', [BannerController::class, 'delete'])->name('banner.delete');
    Route::get('banner/{slug}/restore', [BannerController::class, 'restore'])->name('banner.restore');
    Route::get('banner/{slug}/destroy', [BannerController::class, 'destroy'])->name('banner.destroy');
});

Route::middleware(['auth'])->prefix('market')->name('market.')->group(function () {
    Route::get('/', [MarketController::class, 'index'])->name('home');
    // $catUrls = Category::select('slug')->where('status', 1)->pluck('slug');
    // foreach ($catUrls as $url) {
    //     Route::get('/category/' . $url, [MarketController::class, 'listing']);
    // }
    Route::get('/category/{slug}', [UProductController::class, 'listing'])->name('category');
    Route::get('/products/vendor/{vid}', [UProductController::class, 'listingVendor'])->name('products.vendor');
    Route::post('/filters', [UProductController::class, 'filters'])->name('filters');
    Route::get('/view/{slug}', [UProductController::class, 'show'])->name('product.details');
    Route::post('/product/get_product_price', [UProductController::class, 'getProductPrice']);
    Route::get('/cart', [UProductController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [UProductController::class, 'addCart'])->name('product.addCart');
    Route::post('/cart/update', [UProductController::class, 'updateCart'])->name('cart.update');
});
