<?php

namespace App\Http\Controllers;

use App\Models\LoanRecord;
use App\Models\Stock;
use App\Models\Item;
use App\Models\StockLog;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class LoanRecordController extends Controller
{
    public function recordIn(Request $request)
    {
        

        $stockId = $request->input('stock_id');
        $stock = Stock::find($stockId);

        if (!$stock) return redirect()->back()->withErrors(['msg' => 'Stock tidak ditemukan']);

        if ($stock->type == 'asset') {
            $data = LoanRecord::leftJoin('items', 'items.id', '=', 'loan_records.item_id')
            ->select('loan_records.*');
            if ($request->search){
                $data = $data 
                ->where(function($query) use($request){
                    $query->where('created', $request->search)
                          ->orWhereHas('item', function($q) use($request){
                            $q->where('name', 'like',"%{$request->search}%");
                          })
                          ->orWhereHas('item.kind', function($q) use($request){
                            $q->where('label', 'like',"%{$request->search}%");
                          })
                          ->orWhereHas('item.merk', function($q) use($request){
                            $q->where('label', 'like',"%{$request->search}%");
                          });
                });
            }
        $data = $data
            ->where('items.stock_id', $stockId)
            ->where('loan_records.is_in', true)
            ->paginate(5)->withQueryString();

            return view('pages.LoanRecordIn', compact('data'));
        } else {
            $data = StockLog::leftJoin('items', 'items.id', '=', 'stock_logs.item_id')
            ->select('stock_logs.*')
            ->where('items.stock_id', $stockId)
            ->where('stock_logs.type', 'in')
            ->paginate(5)->withQueryString();

            return view('pages.StockLogIn', compact('data'));
        }

    }

    public function recordOut(Request $request)
    {
        $stockId = $request->input('stock_id');
        $stock = Stock::find($stockId);

        if (!$stock) return redirect()->back()->withErrors(['msg' => 'Stock tidak ditemukan']);

        if ($stock->type == 'asset') {
            $data = LoanRecord::leftJoin('items', 'items.id', '=', 'loan_records.item_id')
                                ->select('loan_records.*')
                                ->where('items.stock_id', $stockId)
                                ->where('loan_records.is_in', false)
                                ->paginate(5)->withQueryString();

            return view('pages.LoanRecordOut', compact('data'));
        } else {
            $data = StockLog::leftJoin('items', 'items.id', '=', 'stock_logs.item_id')
                                ->select('stock_logs.*')
                                ->where('items.stock_id', $stockId)
                                ->where('stock_logs.type', 'out')
                                ->paginate(15)->withQueryString();

            return view('pages.StockLogOut', compact('data'));
        }
    }

    public function storeRecordIn(Request $request)
    {
        $data = $request->all();
        $data['is_in'] = true;

        LoanRecord::create($data);
        Item::find($data['item_id'])->update(['status' => 1]);

        return redirect()->back()->with('message', 'Data berhasil disimpan');
    }

    public function storeRecordOut(Request $request)
    {
        $data = $request->all();
        $data['is_in'] = false;

        LoanRecord::create($data);
        Item::find($data['item_id'])->update(['status' => 0]);

        return redirect()->back()->with('message', 'Data berhasil disimpan');
    }

    public function cetakTanggal()
    {
        return view('pdf.CetakPertanggalIn');   
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

        $data = LoanRecord::with('item')
            ->whereBetween('created', [$req['tglawal'], $req['tglakhir']])
            ->whereHas('item.stock.responsible', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->whereHas('item', function ($query) use($request){
                    $query->where('stock_id', $request->stock_id);
            })
            ->where('is_in', true) //-> untuk barang masuk stock asset (is.in, false)-> untuk barang keluar stock asset
            ->get();

            $stock = \App\Models\Stock::find($request->stock_id);
            $header = $stock->type == 'asset' ? 'Daftar Asset' : 'Daftar Non-Asset';
            $header .= ' : ' . $stock->name;
            $division = $stock->division->label;

            $pdf = PDF::loadview('pdf.CetakInPertanggalIndex', compact('data', 'header', 'division'));
    
            return $pdf->stream('item.pdf');        
    }

    public function cetakDate()
    {
        return view('pdf.CetakPertanggalOut'); 
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

        $data = LoanRecord::with('item')
            ->whereBetween('created', [$req['tglawal'], $req['tglakhir']])
            ->whereHas('item.stock.responsible', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->whereHas('item', function ($query) use($request){
                $query->where('stock_id', $request->stock_id);
            })
            ->where('is_in', false) //-> untuk barang masuk stock asset (is.in, false)-> untuk barang keluar stock asset
            ->get();

            // dd($request->all());
            $stock = \App\Models\Stock::find($request->stock_id);
            $header = $stock->type == 'asset' ? 'Daftar Asset' : 'Daftar Non-Asset';
            $header .= ' : ' . $stock->name;
            $division = $stock->division->label;
    
            $pdf = PDF::loadview('pdf.CetakOutPertanggalIndex', compact('data', 'header', 'division'));
    
            return $pdf->stream('item.pdf');            
    }
}
