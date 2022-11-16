<?php

namespace App\Http\Controllers\Market;

use App\Models\Market\Cart;
use Illuminate\Http\Request;
use App\Models\Market\Vendor;
use App\Models\Auth\Character;
use App\Models\Market\Product;
use App\Models\Market\Category;
use App\Models\Market\VendorBD;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Market\ProductAttribute;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function listing($slug)
    {
        $category = Category::where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $details = Category::details($slug);
        $products = Product::with('brand')->whereIn('category_id', $details['cIDs'])->where('status', 1)->paginate(12);
        return view('market.frontend.listing', [
            'title' => 'Products',
            'ref' => 'listing',
        ], compact('details', 'products'));
    }

    public function listingVendor($vid, $nxpage = 24)
    {
        $vendor = Vendor::with('vdetails')->where('character_id', $vid)->first();
        $products = Product::with('vendor')->where('vendor_id', $vid)->paginate($nxpage);
        // $shop = $vendor->shop($vid);
        return view('market.frontend.listing', [
            'title' => $vendor->vdetails->shop_name,
            'ref' => 'listingVendor',
        ], compact('products', 'vendor'));
    }

    public function filters(Request $request)
    {
        $nxpage = $request->nxpage == 0 ? 24 : $request->nxpage;
        $vid = $request->vid ?? null;
        $r = strtolower($request->order_by);
        switch ($r) {
            case "latest":
                $items = Product::orderBy('id', 'desc');
                break;
            case "lowest":
                $items = Product::orderBy('price', 'asc');
                break;
            case "higher":
                $items = Product::orderBy('price', 'desc');
                break;
            case "name_az":
                $items = Product::orderBy('name', 'asc');
                break;
            case "name_za":
                $items = Product::orderBy('name', 'desc');
                break;
        }
        // dd($request);
        switch ($request->ref) {
            case "listing":
                $products = $items->paginate($nxpage);
                break;
            case "listingVendor":
                $products = $items->with('vendor')->where('vendor_id', $vid)->paginate($nxpage);
                break;
        }
        $vname = $vid ? VendorBD::select('shop_name')->where('id', $vid)->first() : null;
        return view('market.frontend.listing', [
            'title' => $vname ?? 'Products',
            'details' => [],
            'products' => $products,
        ]);
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'brand', 'attributes' => function ($query) {
            $query->where('stock', '>', 0)->where('status', 1);
        }, 'images', 'vendor'])->where('slug', $slug)->firstOrFail();
        // dd($product);
        // $vendor = Vendor::where('id', $product->vendor->id)->firstOrFail();
        // dd($vendor);
        $similar = Product::with('brand')->where('category_id', $product->category->id)->where('id', '!=', $product->id)->limit(4)->get();
        $category = Category::details($product->category->slug);
        $stock = ProductAttribute::where('product_id', $product->id)->sum('stock');
        $session_id = Session::get('session_id') ?? md5(uniqid(rand(), true));
        Session::put('session_id', $session_id);
        $countRVP = DB::table('market_recently_viewed_products')->where(['product_id' => $product->id, 'session_id' => $session_id])->count();
        if ($countRVP == 0) {
            DB::table('market_recently_viewed_products')->insert(['product_id' => $product->id, 'session_id' => $session_id]);
        }
        $rvpIDs = DB::table('market_recently_viewed_products')->select('product_id')
            ->where('product_id', '!=', $product->id)->where('session_id', $session_id)
            ->inRandomOrder()->take(6)->pluck('product_id');
        $rvp = Product::with('brand')->whereIn('id', $rvpIDs)->get();
        $group = (!empty($product->group_code)) ? Product::select('id', 'main_image', 'name', 'slug')->where('id', '!=', $product->id)->where(['group_code' => $product->group_code, 'status' => 1])->get() : null;
        $prodCount = Cart::where(['product_id' => $product->id, 'size' => $product->size, 'character_id' => Character::select('id')->where('user_id', auth()->id())->firstOrFail()])->count();

        return view('market.frontend.product', compact('product', 'category', 'similar', 'rvp', 'group', 'stock'));
    }

    public function addCart(Request $request)
    {
        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = Session::getId();
            Session::put('session_id', $session_id);
        }
        $ch = Character::select('id')->where('user_id', auth()->id())->firstOrFail();
        $item = new Cart;
        $item->session_id = $session_id;
        $item->character_id = $ch->id;
        $item->product_id = $request->product_id;
        $item->size = $request->size;
        $item->quantity = $request->quantity;
        $item->save();
        return back()->withSuccess('market.cart.added');
    }

    public function cart()
    {
        $session_id = Session::get('session_id');
        $cart = Cart::where('session_id', $session_id)->get();
        $items = Cart::cartItems();
        return view('market.frontend.cart', [
            'title' => trans('market.cart'),
        ], compact('cart', 'items'));
    }

    public function updateCart(Request $request)
    {
        $product = Product::with(['attributes' => function ($query) {
            $query->where('stock', '>', 0)->where('status', 1);
        }])->where('id', $request->pid)->first();
        $session_id = Session::get('session_id');
        $cart = Cart::where(['id' => $request->cid])->first();
        if ($request->add) {
            if ($cart->quantity + 1 > $product->attributes[0]['stock']) {
                $cart->quantity = $cart->quantity - 1;
            }
            $cart->quantity = $cart->quantity + 1;
        }
        if ($request->sub) {
            $cart->quantity = $cart->quantity - 1;
        }
        if ($request->del) {
            $cart->delete();
            return back();
        }
        $cart->save();
        return back();
    }

    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            dd($request);
            // $discountAttributePrice = Product::getAttributePromo($request->product_id, $request->size);
            // return $discountAttributePrice;
        }
    }
}
