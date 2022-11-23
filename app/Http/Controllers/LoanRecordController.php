<?php

namespace App\Http\Controllers;

use App\Models\LoanRecord;
use App\Models\Stock;
use App\Models\Item;
use App\Models\StockLog;
use Illuminate\Http\Request;

class LoanRecordController extends Controller
{
    public function recordIn(Request $request)
    {
        $stockId = $request->input('stock_id');

        // search loan record, where item with stock id

        // 1. cari data pinjaman yang masuk, dengan filter berdasarkan stock apa, dan statusnya (kolom is_in = true)

        $stock = Stock::find($stockId);

        if (!$stock) {
            return redirect()->back()->withErrors(['msg' => 'Stock tidak ditemukan']);
        }

        if ($stock->type == 'asset') {
            $data = LoanRecord::leftJoin('items', 'items.id', '=', 'loan_records.item_id')
            ->select('loan_records.*')
            ->where('items.stock_id', $stockId)
            ->where('loan_records.is_in', true)
            ->paginate(15);

            return view('pages.LoanRecordIn', compact('data'));
        } else {
            $data = StockLog::leftJoin('items', 'items.id', '=', 'stock_logs.item_id')
            ->select('stock_logs.*')
            ->where('items.stock_id', $stockId)
            ->where('stock_logs.type', 'in')
            ->paginate(15);

            return view('pages.StockLogIn', compact('data'));
        }

    }

    public function recordOut(Request $request)
    {
        $stockId = $request->input('stock_id');

        $stock = Stock::find($stockId);

        if (!$stock) {
            return redirect()->back()->withErrors(['msg' => 'Stock tidak ditemukan']);
        }

        if ($stock->type == 'asset') {
            $data = LoanRecord::leftJoin('items', 'items.id', '=', 'loan_records.item_id')
                                ->select('loan_records.*')
                                ->where('items.stock_id', $stockId)
                                ->where('loan_records.is_in', false)
                                ->paginate(15);

            return view('pages.LoanRecordOut', compact('data'));
        } else {
            $data = StockLog::leftJoin('items', 'items.id', '=', 'stock_logs.item_id')
                                ->select('stock_logs.*')
                                ->where('items.stock_id', $stockId)
                                ->where('stock_logs.type', 'out')
                                ->paginate(15);

            return view('pages.StockLogOut', compact('data'));
        }
    }

    public function storeRecordIn(Request $request)
    {
        $data = $request->all();

        $data['is_in'] = true;

        LoanRecord::create($data);
        Item::find($data['item_id'])->update(['status' => 1]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function storeRecordOut(Request $request)
    {
        $data = $request->all();

        $data['is_in'] = false;

        LoanRecord::create($data);
        Item::find($data['item_id'])->update(['status' => 0]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}
