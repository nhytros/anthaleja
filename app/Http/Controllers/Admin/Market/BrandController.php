<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public $brands;

    public function __construct()
    {
        $this->brands = Brand::orderBy('name', 'asc')->paginate(24);
    }

    public function index($slug = null)
    {
        $brands = Brand::withTrashed()->orderBy('name', 'asc')->get();
        return view('admin.market.brands.index', [
            'title' => __('brands Management'),
            'brands' => $brands,
            'brand' => $slug ? Brand::withTrashed()->where('slug', $slug)->firstOrFail() : false,
        ]);
    }

    public function store(Request $request)
    {
        $brand = $request->validate([
            'name' => 'required|unique:market_brands,name',
        ]);

        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'status' => true,
        ]);

        return Redirect::route('admin.market.brands')->withSuccess(trans('admin.market.brand.created'));
    }

    public function edit($slug)
    {
        $brands = Brand::withTrashed()->orderBy('name', 'asc')->get();
        return view('admin.market.brands.index', [
            'title' => __('Edit brand'),
            'brands' => $brands,
            'brand' => Brand::withTrashed()->where('slug', $slug)->firstOrFail(),
        ]);
    }

    public function update(Request $request, $slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $request->validate([
            'name' => ['required', 'unique:market_brands,name,' . $brand->id],
        ]);
        $brand->update([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'status' => $request->status ? true : false,
        ]);
        return Redirect::route('admin.market.brands')->withSuccess(trans('admin.market.brand.updated'));
    }

    public function delete($slug)
    {
        $brand = Brand::where('slug', $slug)->first();
        $brand->delete();
        return back()->withSuccess(trans('admin.market.brand.deleted'));
    }

    public function restore($slug)
    {
        $brand = Brand::withTrashed()->where('slug', $slug)->first();
        $brand->restore();
        return back()->withSuccess(trans('admin.market.brand.restored'));
    }

    public function destroy($slug)
    {
        $brand = Brand::withTrashed()->where('slug', $slug)->first();
        $brand->forceDelete();
        return back()->withSuccess(trans('admin.market.brand.destroyed'));
    }
}
