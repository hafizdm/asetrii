<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\LoanRecord;
use App\Models\StockLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $assets = LoanRecord:://with('item', 'item.kind', 'item.merk', 'item.stock.responsible')
            latest('created')
            ->limit(5)
            ->get();

        $nonAssets = StockLog::latest()
            ->limit(5)
            ->get();

        return view('pages.Dashboard', compact('assets', 'nonAssets'));
    }
}
