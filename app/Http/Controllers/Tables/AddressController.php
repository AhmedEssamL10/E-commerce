<?php

namespace App\Http\Controllers\Tables;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    //
    public function edit(Request $request)
    {
        # code...
        //validation
        $request->validate([
            'city' => 'required|string',
            'region' => 'required|string',
            'street' => 'required|string',
            'building' => 'required|string',
            'floor' => 'required|string',
        ]);
        //update
        Address::where('user_id', '=', Auth::user()->id)->update([
            'city' => $request->city,
            'region' => $request->region,
            'street' => $request->street,
            'building' => $request->building,
            'floor' => $request->floor
        ]);
        return back();
    }
}
