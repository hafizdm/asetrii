<?php

namespace App\Http\Controllers;

use App\Models\LoanRecord;
use App\Models\Stock;
use App\Models\Item;
use Illuminate\Http\Request;

class LoanRecordController extends Controller
{
    public function recordIn(Request $request)
    {
        $stockId = $request->input('stock_id');

        // search loan record, where item with stock id

        // 1. cari data pinjaman yang masuk, dengan filter berdasarkan stock apa, dan statusnya (kolom is_in = true)

        $stock = Stock::find($stockId);
        $data = LoanRecord::leftJoin('items', 'items.id', '=', 'loan_records.item_id')
                            ->select('loan_records.*')
                            ->where('items.stock_id', $stockId)
                            ->where('loan_records.is_in', true)
                            ->paginate(15);

        return view('pages.LoanRecordIn', compact('data'));
    }

    public function recordOut(Request $request)
    {
        $stockId = $request->input('stock_id');

        $stock = Stock::find($stockId);
        $data = LoanRecord::leftJoin('items', 'items.id', '=', 'loan_records.item_id')
                            ->select('loan_records.*')
                            ->where('items.stock_id', $stockId)
                            ->where('loan_records.is_in', false)
                            ->paginate(15);

        return view('pages.LoanRecordOut', compact('data'));
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
