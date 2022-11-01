<?php

namespace App\Http\Controllers\Admin\Market;

use Faker\Factory as Faker;
use Illuminate\Http\Request;
use App\Models\Market\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


class BannerController extends Controller
{
    public $banners, $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
        $this->banners = Banner::paginate(24);
    }

    public function index($id = null)
    {
        $banners = Banner::withTrashed()->get();
        return view('admin.market.banners.index', [
            'title' => __('banners Management'),
            'banners' => $banners,
            'banner' => $id ? Banner::withTrashed()->where('id', $id)->firstOrFail() : false,
        ]);
    }

    public function store(Request $request)
    {
        Banner::create([
            // TODO: Add image upload
            'image' => $this->faker->imageUrl(1920, 400, null, true, null, false, 'png'),
            'type' => $request->type,
            'title' => $request->title ?? $this->faker->sentence(6, true),
            'alt' => $request->alt ?? $this->faker->sentence(6, true),
            'status' => $request->status ? true : false,
        ]);

        return Redirect::route('admin.market.banners')->withSuccess(trans('admin.market.banner.created'));
    }

    public function edit($id)
    {
        $banners = Banner::withTrashed()->get();
        return view('admin.market.banners.index', [
            'title' => __('Edit banner'),
            'banners' => $banners,
            'banner' => Banner::withTrashed()->where('id', $id)->firstOrFail(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::where('id', $id)->firstOrFail();
        $banner->update([
            // TODO: Add image upload, remove old image
            'image' => $this->faker->imageUrl(1920, 400, null, true, null, false, 'png'),
            'type' => $request->type,
            'title' => $request->title ?? $this->faker->sentence(6, true),
            'alt' => $request->alt ?? $this->faker->sentence(6, true),
            'status' => $request->status ? true : false,
        ]);
        return Redirect::route('admin.market.banners')->withSuccess(trans('admin.market.banner.updated'));
    }

    public function delete($id)
    {
        $banner = Banner::where('id', $id)->first();
        $banner->delete();
        return back()->withSuccess(trans('admin.market.banner.deleted'));
    }

    public function restore($id)
    {
        $banner = Banner::withTrashed()->where('id', $id)->first();
        $banner->restore();
        return back()->withSuccess(trans('admin.market.banner.restored'));
    }

    public function destroy($id)
    {
        $banner = Banner::withTrashed()->where('id', $id)->first();
        $banner->forceDelete();
        return back()->withSuccess(trans('admin.market.banner.destroyed'));
    }
}
