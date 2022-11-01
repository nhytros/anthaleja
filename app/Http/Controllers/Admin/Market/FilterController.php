<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductFilter;
use App\Models\Market\ProductFilterValue;
use Illuminate\Support\Facades\Redirect;

class FilterController extends Controller
{
    public function index($slug = null)
    {
        $filters = ProductFilter::withTrashed()->orderBy('name', 'asc')->get();
        return view('admin.market.filters.index', [
            'title' => __('Filters Management'),
            'filters' => $filters,
            'filter' => $slug ? ProductFilter::withTrashed()->where('slug', $slug)->firstOrFail() : false,
        ]);
    }

    public function values()
    {
        $values = ProductFilterValue::all();
        return view('admin.market.filters.values', [
            'title' => __('Filter Values Management'),
            'values' => $values,
            'value' => null,
            // 'filter' => $slug ? ProductFilter::withTrashed()->where('slug', $slug)->firstOrFail() : false,
        ]);
    }

    public function store(Request $request)
    {
        $filter = $request->validate([
            'name' => 'required|unique:market_filters,name',
        ]);

        ProductFilter::create([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'status' => true,
        ]);

        return Redirect::route('admin.market.filters')->withSuccess(trans('admin.market.filter.created'));
    }

    public function edit($slug)
    {
        $filters = ProductFilter::withTrashed()->orderBy('name', 'asc')->get();
        return view('admin.market.filters.index', [
            'title' => __('Edit brand'),
            'brands' => $filters,
            'brand' => ProductFilter::withTrashed()->where('slug', $slug)->firstOrFail(),
        ]);
    }

    public function update(Request $request, $slug)
    {
        $filter = ProductFilter::where('slug', $slug)->firstOrFail();
        $request->validate([
            'name' => ['required', 'unique:market_filters,name,' . $filter->id],
        ]);
        $filter->update([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'status' => $request->status ? true : false,
        ]);
        return Redirect::route('admin.market.filters')->withSuccess(trans('admin.market.filter.updated'));
    }

    public function delete($slug)
    {
        $filter = ProductFilter::where('slug', $slug)->first();
        $filter->delete();
        return back()->withSuccess(trans('admin.market.filter.deleted'));
    }

    public function restore($slug)
    {
        $filter = ProductFilter::withTrashed()->where('slug', $slug)->first();
        $filter->restore();
        return back()->withSuccess(trans('admin.market.filter.restored'));
    }

    public function destroy($slug)
    {
        $filter = ProductFilter::withTrashed()->where('slug', $slug)->first();
        $filter->forceDelete();
        return back()->withSuccess(trans('admin.market.filter.destroyed'));
    }
}
