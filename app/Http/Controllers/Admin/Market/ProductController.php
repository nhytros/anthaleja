<?php

namespace App\Http\Controllers\Admin\Market;

use Faker\Factory as Faker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\Market\{Product, Section, Category, Brand, ProductAttribute};

class ProductController extends Controller
{
    public $product, $products, $faker, $categories, $brands;

    public function __construct()
    {
        $this->faker = Faker::create();
        $this->products = Product::with(
            ['section' => function ($query) {
                $query->select('id', 'name');
            }, 'category' => function ($query) {
                $query->select('id', 'name');
            }]
        );
        $this->categories = Section::with('categories')->orderBy('name', 'asc')->where('status', true);
        $this->brands = Brand::orderBy('name', 'asc')->where('status', true);
    }

    public function index($slug = null)
    {
        return view('admin.market.products.index', [
            'title' => __('Products Management'),
            'categories' => $this->categories->get(),
            'brands' => $this->brands->get(),
            'products' => $this->products->withTrashed()->get(),
            'product' => $this->product,
        ]);
    }

    public function store(Request $request)
    {
        $product = $request->validate([
            'name' => 'required|unique:market_products,name',
            'code' => 'required|unique:market_products,code',
            'price' => 'required',
            'main_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp'],
            'video' => ['nullable', 'mimes:mp4,ogg,ogv'],
            'start_promo' => ['nullable', 'date'],
            'end_promo' => ['nullable', 'date', 'after_or_equal:start_promo'],
        ]);

        $cat = Category::find($request->category_id);

        Product::create([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'section_id' => $cat->section_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            // TODO: Fix vendor ID
            'vendor_id' => auth()->user()->character->id,
            'color' => $request->color,
            'price' => $request->price,
            'discount' => $request->discount,
            'promo_price' => $request->promo_price,
            'weight' => $request->weight,
            // TODO: Upload main Image & Video
            'main_image' => $this->faker->imageUrl(800, 600, null, true, null, false, 'png'),
            'video' => $this->faker->boolean(20) ? 'https://www.youtube.com/watch?v=5Peo-ivmupE' : null,
            'description' => $request->description,
            'is_promo' => $request->is_promo ?? false,
            'start_promo' => $request->start_promo,
            'end_promo' => $request->end_promo,
            'is_featured' => $request->is_featured ?? false,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'start_promo' => $request->start_promo ? $request->start_promo . ' 00:00:00' : null,
            'end_promo' => $request->end_promo ? $request->end_promo . ' 23:59:59' : null,
            'status' => true,
        ]);

        return Redirect::route('admin.market.products')->withSuccess(trans('admin.market.product.created'));
    }

    public function edit($slug)
    {
        return view('admin.market.products.index', [
            'title' => __('Edit product'),
            'categories' => $this->categories->get(),
            'brands' => $this->brands->get(),
            'products' => $this->products->withTrashed()->get(),
            'product' => $slug ? Product::where('slug', $slug)->firstOrFail() : false,
        ]);
    }

    public function update(Request $request, $slug)
    {
        $product = $slug ? Product::where('slug', $slug)->firstOrFail() : false;
        $request->validate([
            'name' => ['required', 'unique:market_products,name,' . $product->id],
            'code' => ['required', 'unique:market_products,code,' . $product->id],
            'price' => ['required'],
            'main_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp'],
            'video' => ['nullable', 'mimes:mp4,ogg,ogv'],
        ]);
        $cat = Category::find($request->category_id);

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug ?? null,
            'section_id' => $cat->section_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            // TODO: Fix vendor ID
            'vendor_id' => auth()->user()->character->id,
            'color' => $request->color,
            'price' => $request->price,
            'discount' => $request->discount,
            'promo_price' => $request->promo_price,
            'weight' => $request->weight,
            // TODO: Upload main Image & Video
            'main_image' => $this->faker->imageUrl(800, 600, null, true, null, false, 'png'),
            'video' => $this->faker->boolean(20) ? 'https://www.youtube.com/watch?v=5Peo-ivmupE' : null,
            'description' => $request->description,
            'is_promo' => $request->is_promo ?? false,
            'start_promo' => $request->start_promo,
            'end_promo' => $request->end_promo,
            'is_featured' => $request->is_featured ?? false,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'start_promo' => $request->start_promo ? $request->start_promo . ' 00:00:00' : null,
            'end_promo' => $request->end_promo ? $request->end_promo . ' 23:59:59' : null,
            'status' => $request->status ? true : false,
        ]);
        return Redirect::route('admin.market.products')->withSuccess(trans('admin.market.product.updated'));
    }

    public function add_attributes($slug)
    {
        $title = trans('admin.market.attributes.add');
        $product = $slug ? Product::where('slug', $slug)->firstOrFail() : false;
        return view('admin.market.products.manage_attributes', compact('title', 'product'));
    }

    public function store_attributes(Request $request, $slug)
    {
        $product = Product::with('attributes')->where('slug', $slug)->firstOrFail();
        $data = $request->all();

        foreach ($data['sku'] as $key => $value) {
            if (!empty($value)) {
                $skuCount = ProductAttribute::where('sku', $value)->count();
                $sizeCount = ProductAttribute::where(['product_id' => $product->id, 'size' => $data['size'][$key]])->count();
                if ($skuCount > 0) {
                    return back()->withDanger(trans('admin.market.product.attributes.sku_exist'));
                }
                if ($sizeCount > 0) {
                    return back()->withDanger(trans('admin.market.product.attributes.size_exist'));
                }
                $attribute = new ProductAttribute;
                $attribute->product_id = $product->id;
                $attribute->sku = $value;
                $attribute->size = $data['size'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->status = 1;
                $attribute->save();
            }
        }
        return back()->withSuccess(trans('admin.market.product.attributes.added'));
    }

    public function edit_attribute($slug, $sku)
    {
        $title = null;
        $product = Product::with('attributes')->where('slug', $slug)->firstOrFail();
        $attributes = ProductAttribute::where(['product_id' => $product->id, 'sku' => $sku])->firstOrFail();
        return view('admin.market.products.manage_attribute', compact('title', 'product', 'attributes'));
    }

    public function update_attributes(Request $request, $slug, $sku)
    {
        dd($request, $slug, $sku);
    }

    public function delete($slug)
    {
        $product = $slug ? Product::where('slug', $slug)->firstOrFail() : false;
        $product->delete();
        return back()->withSuccess(trans('admin.market.product.deleted'));
    }

    public function restore($slug)
    {
        $product = $slug ? Product::where('slug', $slug)->withTrashed()->firstOrFail() : false;
        $product->restore();
        return back()->withSuccess(trans('admin.market.product.restored'));
    }

    public function destroy($slug)
    {
        // TODO: Remove main_image, other images and videos ans unlink
        $product = $slug ? Product::where('slug', $slug)->withTrashed()->firstOrFail() : false;
        $product->forceDelete();
        return back()->withSuccess(trans('admin.market.product.destroyed'));
    }
}
