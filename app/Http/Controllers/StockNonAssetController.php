<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use Illuminate\Http\Request;

class StockNonAssetController extends Controller
{
    public function indexIn(Request $request)
    {
        $req = $request->validate([
            'type' => ['required', 'in:asset,non-asset'],
        ]);

        $data = [];
        if ($request->type) {
            $data = Stock::where('type', $request->type)
                            ->paginate(15)
                            ->withQueryString();
        } else {
            return redirect()->back()->withErrors('Stock tidak ditemukan.');
        }

        return view('pages.StockInIndex', compact('data'));
    }
}
