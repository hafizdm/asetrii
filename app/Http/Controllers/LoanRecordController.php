<?php

namespace App\Http\Controllers;

use App\Models\LoanRecord;
use App\Models\Stock;
use Illuminate\Http\Request;

class LoanRecordController extends Controller
{
    public function recordIn(Request $request)
    {
        $stockId = $request->input('stock_id');

        // search loan record, where item with stock id

        // 1. cari data pinjaman yang masuk, dengan filter berdasarkan stock apa, dan statusnya (kolom is_in = true)

        $stock = Stock::find($stockId);
        $data = LoanRecord::join('items', 'items.id', '=', 'loan_records.item_id')
            ->where('items.stock_id', $stockId)
            ->where('loan_records.is_in', true)
            ->select('loan_records.*')
            ->paginate(15);

        return view('pages.LoanRecordIn', compact('data'));
    }
}
