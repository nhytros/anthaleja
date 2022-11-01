<?php

namespace App\Http\Controllers\Market;

use Illuminate\Http\Request;
use App\Models\Market\Product;
use App\Models\Market\Category;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function listing($slug)
    {
        $category = Category::where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $details = Category::details($slug);
        $products = Product::with('brand')->whereIn('category_id', $details['cIDs'])->where('status', 1)->paginate(12);
        return view('market.frontend.listing', [
            'title' => 'Products',
        ], compact('details', 'products'));
    }

    public function filters(Request $request)
    {
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
        $products = $items->paginate($request->nxpage);

        return view('market.frontend.listing', [
            'title' => 'Products',
            'details' => [],
            'products' => $products,
        ]);
    }
}
