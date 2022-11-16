<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\{Category, Section};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public $categories, $all_sections;

    public function __construct()
    {
        $this->categories = Category::with('section', 'parent')->orderBy('name', 'asc')->get();
        $this->all_sections = Section::orderBy('name', 'asc')->get();
    }

    public function index($slug = null)
    {
        return view('admin.market.categories.index', [
            'title' => __('Categories Management'),
            'sections' => $this->all_sections,
            'categories' => $this->categories,
            'category' => $category = $slug ? Category::withTrashed()->where('slug', $slug)->firstOrFail() : false,
            'parent_categories' => $slug ? Category::with('subCategories')
                ->where(['parent_id' => 0, 'section_id' => $category->section_id])
                ->orderBy('name', 'asc')
                ->get() : [],
        ]);
    }

    public function store(Request $request)
    {
        $category = $request->validate([
            'name' => 'required|unique:market_categories,name',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'status' => $request->status ? true : false,
        ]);

        return Redirect::route('admin.market.categories')->withSuccess(trans('admin.market.category.created'));
    }

    public function edit($slug)
    {
        return view('admin.market.categories.index', [
            'title' => __('Edit category'),
            'categories' => $this->categories,
            'category' => Category::withTrashed()->where('slug', $slug)->firstOrFail(),
        ]);
    }

    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $request->validate([
            'name' => ['required', 'unique:market_categories,name,' . $category->id],
        ]);
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'status' => $request->status ? true : false,
        ]);
        return Redirect::route('admin.market.categories')->withSuccess(trans('admin.market.category.updated'));
    }

    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return back()->withSuccess(trans('admin.market.category.deleted'));
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return back()->withSuccess(trans('admin.market.category.restored'));
    }

    public function destroy($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->forceDelete();
        return back()->withSuccess(trans('admin.market.category.destroyed'));
    }

    public function appendCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $parent_categories = Category::with('subCategories')
                ->where(['parent_id' => 0, 'section_id' => $data['section_id']])
                ->orderBy('name', 'asc')
                ->get();
            // dd($parent_categories);
            return view('admin._partials.append_category_levels', compact('parent_categories'));
        }
    }
}
