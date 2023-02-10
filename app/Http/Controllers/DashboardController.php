<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockLog;
use App\Models\LoanRecord;
use Illuminate\Http\Request;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index(){

        // $data = User::where('user_id', auth()->user()->id);

        $assets = LoanRecord::latest('created')
            ->limit(5)
            ->get();

        $nonAssets = StockLog::latest()
            ->limit(5)
            ->get();
        
        $user = User::count();

        $item = Item::where('stock_id', )->count();
        $loanIn = LoanRecord::where('loan_records.is_in', true)->count();
        $loanOut = LoanRecord::where('loan_records.is_in', false)->count();
        $stockLogIn = StockLog::where('stock_logs.type', 'in')->count();
        $stockLogOut = StockLog::where('stock_logs.type', 'out')->count();        
        $countAssets = Item::whereNotNull('code')
                    ->count();
        $countNoAssets = Item::whereNull('code')
                    ->count();

        return view('pages.Dashboard', compact('assets', 'nonAssets', 'user', 'loanIn', 'loanOut', 'item','countAssets','countNoAssets','stockLogIn','stockLogOut'));
    }
}
