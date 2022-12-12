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
        $request->validate([
            'type' => ['required', 'in:asset,non-asset'],
        ]);

        $data = [];
        $user = auth()->user();

        if ($request->type) {
            if ($user->role == 'admin') {
                $data = Stock::where('type', $request->type)
                    ->where('user_id', $user->id)
                    ->paginate(15)
                    ->withQueryString();
            } else if ($user->role == 'director') {
                $data = Stock::where('type', $request->type)
                    ->paginate(15)
                    ->withQueryString();
            }
        } else {
            return redirect()->back()->withErrors('Stock tidak ditemukan.');
        }

        return view('pages.StockInIndex', compact('data'));
    }

    public function indexOut(Request $request)
    {
        $req = $request->validate([
            'type' => ['required', 'in:asset,non-asset'],
        ]);

        $data = [];
        $user = auth()->user();

        if ($request->type) {
            if ($user->role == 'admin') {
                $data = Stock::where('type', $request->type)
                    ->where('user_id', $user->id)
                    ->paginate(15)
                    ->withQueryString();
            } else if ($user->role == 'director') {
                $data = Stock::where('type', $request->type)
                    ->paginate(15)
                    ->withQueryString();
            }
        } else {
            return redirect()->back()->withErrors('Stock tidak ditemukan.');
        }

        return view('pages.StockOutIndex', compact('data'));
    }


    public function store(Request $request)
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


    public function storeRecordOut(Request $request)
    {

        $req = $request->validate([
            'moved_at' => ['required', 'date'],
            'item_id' => ['required'],
            'amount' => ['required', 'numeric'],
            'notes' => ['nullable'],
            'reciever' => ['required', 'max:255'],
            'role' => ['required', 'max:255'],
        ]);

        $req['user_id'] = auth()->user()->id;
        $req['type'] = 'out';
        StockLog::create($req);


        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function cetakTanggal()
    {
        return view('pdf.CetakInNoAssetIndex'); 
    }

    public function cetakMasuk(Request $request)
    {
        $req = $request->validate([
            'tglawal' => [
                'required',
                'date',
                'before_or_equal:tglakhir',
            ],
            'tglakhir' => [
                'required',
                'date',
                'after_or_equal:tglawal',
            ],
        ]);

        $data = StockLog::with('item')
            ->whereBetween('moved_at', [$req['tglawal'], $req['tglakhir']])
            ->whereHas('item.stock.responsible', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })

            ->where('type', 'in') //-> untuk barang masuk stock asset (is.in, false)-> untuk barang keluar stock non-asset
            ->get();

      

        return view('pdf.CetakInPertanggalNoAsset', compact('data'));
    }

    public function cetakDate()
    {
        return view('pdf.CetakOutNoAssetIndex');
    }

    public function cetakKeluar(Request $request)
    {
        $req = $request->validate([
            'tglawal' => [
                'required',
                'date',
                'before_or_equal:tglakhir',
            ],
            'tglakhir' => [
                'required',
                'date',
                'after_or_equal:tglawal',
            ],
        ]);

        $data = StockLog::with('item')
            ->whereBetween('moved_at', [$req['tglawal'], $req['tglakhir']])
            ->whereHas('item.stock.responsible', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })

            ->where('type', 'out') //-> untuk barang masuk stock asset (is.in, false)-> untuk barang keluar stock non-asset
            ->get();

      

        return view('pdf.CetakOutPertanggalNoAsset', compact('data'));
    }


}
