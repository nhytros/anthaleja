<?php

namespace App\Http\Controllers\Admin\Market;

use Illuminate\Http\Request;
use App\Models\Market\Vendor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole(['vendor'])) {
            $cid = $user->characters->toArray();
            $vendor = Vendor::where('character_id', $cid[0]['id'])->first();
            return view('market.vendors.dashboard', compact('vendor'));
        }
        return back()->withDanger(trans('market.not_vendor'));
    }
}
