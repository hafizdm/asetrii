<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use App\Models\StockLog;
use DateTime;
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

    public function store(Request $request)
    {
        {
            
    
            $req = $request->validate([
                'moved_at' => ['required', 'date'],
                'item_id' => ['required'],
                'amount' => ['required', 'numeric'],
                'notes' => ['nullable']

            ]);
            
            $req['user_id'] = auth()->user()->id;
            $req['type'] = 'in';
            StockLog::create($req);
            
    
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        }
    
    }

}
