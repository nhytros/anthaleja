<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SectionController extends Controller
{
    public $sections;

    public function __construct()
    {
        $this->sections = Section::orderBy('name', 'asc')->paginate(24);
    }

    public function index($slug = null)
    {
        $sections = Section::withTrashed()->orderBy('name', 'asc')->get();
        return view('admin.market.sections.index', [
            'title' => __('Sections Management'),
            'sections' => $sections,
            'section' => $slug ? Section::withTrashed()->where('slug', $slug)->firstOrFail() : false,
        ]);
    }

    public function store(Request $request)
    {
        $section = $request->validate([
            'name' => 'required|unique:market_sections,name',
        ]);

        Section::create([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'status' => $request->status ? true : false,
        ]);

        return Redirect::route('admin.market.sections')->withSuccess(trans('admin.market.section.created'));
    }

    public function edit($slug)
    {
        $sections = Section::withTrashed()->orderBy('name', 'asc')->get();
        return view('admin.market.sections.index', [
            'title' => __('Edit section'),
            'sections' => $sections,
            'section' => Section::withTrashed()->where('slug', $slug)->firstOrFail(),
        ]);
    }

    public function update(Request $request, $slug)
    {
        $section = Section::where('slug', $slug)->firstOrFail();
        $request->validate([
            'name' => ['required', 'unique:market_sections,name,' . $section->id],
        ]);
        $section->update([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'status' => $request->status ? true : false,
        ]);
        return Redirect::route('admin.market.sections')->withSuccess(trans('admin.market.section.updated'));
    }

    public function delete($slug)
    {
        $section = Section::where('slug', $slug)->first();
        $section->delete();
        return back()->withSuccess(trans('admin.market.section.deleted'));
    }

    public function restore($slug)
    {
        $section = Section::withTrashed()->where('slug', $slug)->first();
        $section->restore();
        return back()->withSuccess(trans('admin.market.section.restored'));
    }

    public function destroy($slug)
    {
        $section = Section::withTrashed()->where('slug', $slug)->first();
        $section->forceDelete();
        return back()->withSuccess(trans('admin.market.section.destroyed'));
    }
}
