<?php

namespace App\Http\Controllers;


use DateTime;
use App\Models\Item;
use App\Models\Stock;
use App\Models\StockLog;


use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $prevLog = StockLog::where('item_id', $req['item_id'])->orderByDesc('moved_at')->firstOrFail();

        $req['user_id'] = auth()->user()->id;
        $req['type'] = 'in';
        $req['last'] = $prevLog->current;
        $req['current'] = $req['last'] + $req['amount'];
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

        $prevLog = StockLog::where('item_id', $req['item_id'])->orderByDesc('moved_at')->firstOrFail();

        $req['user_id'] = auth()->user()->id;
        $req['type'] = 'out';
        $req['last'] = $prevLog->current;
        $req['current'] = $req['last'] - $req['amount'];
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
            ->whereHas('item', function ($query) use($request){
                $query->where('stock_id', $request->stock_id);
            })

            ->where('type', 'in') //-> untuk barang masuk stock asset (is.in, false)-> untuk barang keluar stock non-asset
            ->get();

            $stock = \App\Models\Stock::find($request->stock_id);
            $header = $stock->type == '' ? 'Daftar Asset' : 'Daftar Non-Asset';
            $header .= ' : ' . $stock->name;
            $division = $stock->division->label;

            $pdf = PDF::loadview('pdf.CetakInPertanggalNoAsset', compact('data', 'header', 'division'));
      

        return $pdf->stream('item.pdf');

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
            ->whereHas('item', function ($query) use($request){
                $query->where('stock_id', $request->stock_id);
            })

            ->where('type', 'out') //-> untuk barang masuk stock asset (is.in, false)-> untuk barang keluar stock non-asset
            ->get();
            
        $stock = \App\Models\Stock::find($request->stock_id);
        $header = $stock->type == '#' ? 'Daftar Asset' : 'Daftar Non-Asset';
        $header .= ' : ' . $stock->name;
        $division = $stock->division->label;
            
        $pdf = PDF::loadview('pdf.CetakOutPertanggalNoAsset', compact('data','header','division'));
      

        return $pdf->stream('item.pdf');
    }

    public function uploadFile()
    {
        return view('pages.UploadDocumentNoAsset');
    }

    public function doUploadFile(Request $request)
    {
        //Memvalidasi request sesuai dengan aturan yang ingin di inputkan

        $req = $request->validate([
            'stock_log_id'=> [
                'required',
                'exists:stock_logs,id',
            ],

            'upload_doc' =>[
                'required',
                'file',
            ],
        ]);

        $redirect = '/'. $request->redirect_url;
        
        $file=$req['upload_doc'];
        $fileName=$file->getClientOriginalName();
        $extension=$file->getClientOriginalExtension();
        $fileName=time().".".$request->upload_doc->extension();
        $path = $request->file('upload_doc')->storeAs(
                'public/fileUpload', $fileName
        );      
        
        // dd($path);
        
        $publicPath = str_replace('public','storage', $path);
        StockLog::where('id', $req['stock_log_id'])->update(['upload_doc'=>$publicPath]);
       
        
        return redirect($redirect)->with('message', 'Data berhasil disimpan');
    }

    public function indexSummary(Request $request)
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
      return view('pages/SummaryIndexNonAsset', compact('data'));
    }

    public function summaryRecord()
    {
        $stock = Stock::find(request()->query('stock_id', 0));

        if ($stock == null) {
            return redirect()->back()->withErrors('Stock tidak ditemukan.');
        }

        // Filter tanggal
        $startDate = now()->subMonths(3);
        $endDate = now()->endOfMonth();

        $stockLogs = StockLog::query()
            ->with('item', 'item.kind', 'item.merk')
            ->whereBetween('moved_at', [$startDate, $endDate])
            ->whereHas('stock', function ($q) use ($stock) {
                return $q->where('stocks.id', $stock->id);
            })
            ->orderBy('moved_at')
            ->get();

        $data = $stockLogs->groupBy('moved_at')
            ->map(function ($itemStockLogsGroupedByDate, $date) {
                return $itemStockLogsGroupedByDate
                    ->groupBy('item_id')
                    ->map(function ($items) use ($date) {
                        /** @var \Illuminate\Support\Collection<int, \App\Models\StockLog> $items */
                        $stok = $items->first()->last;
                        $barangMasuk = $items->where('type', 'in')->sum('amount');
                        $barangKeluar = $items->where('type', 'out')->sum('amount');

                        $stok += $barangMasuk;
                        $stok -= $barangKeluar;
                            
                        $item =$items->first()->item;
                        
                        $obj = new \stdClass();
                        $obj->date = $date;
                        $obj->item_id = $item->id;
                        $obj->item_name = $item->name;
                        $obj->kind_name = $item->kind->name;
                        $obj->merk_name = $item->merk->name;
                        $obj->ukuran = $item->ukuran;
                        $obj->transaction_count = $items->count();
                        $obj->last_stock = $items->first()->last;
                        $obj->in = $barangMasuk;
                        $obj->out = $barangKeluar;
                        $obj->current_stock = $stok;

                        return $obj;
                    })
                    ->values()
                    ->toArray();
            })
            ->flatten(1)
            ->values()
            ->toArray();
        return view('pages/SummaryNonAsset', compact('data'));
    }

}
