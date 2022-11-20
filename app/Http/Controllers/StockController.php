<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
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

        return view('pages.StockIndex', compact('data'));
    }

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

    public function indexOut(Request $request)
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

        return view('pages.StockOutIndex', compact('data'));
    }

    public function show($id)
    {
        
    }

    public function store(Request $request)
    {
        $req = $request->validate([
            'division_id' => ['required', 'exists:categories,id'],
            'type' => ['required', 'in:asset,non-asset'],
            'name' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $req['user_id'] = auth()->user()->id;

        Stock::create($req);

        return redirect()->back()->with('success', 'Stock berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Stock::destroy($id);

        return redirect()->back()->with('message', 'Kategori berhasil dihapus.');
    }
}
