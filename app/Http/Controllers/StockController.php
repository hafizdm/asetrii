<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            $user = auth()->user();
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

        return view('pages.StockIndex', compact('data'));
    }

    public function indexIn(Request $request)
    {
        $req = $request->validate([
            'type' => ['required', 'in:asset,non-asset'],
        ]);

        $data = [];
        if ($request->type) {
                $user = auth()->user();
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

        // $req['user_id'] = auth()->user()->id;

        $data = [];
        if ($request->type) {
           $user = auth()->user();
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

    public function update(Request $request)
    {
        // dd($request->all());
        Stock::findOrFail($request->id)
        ->update(['name'=>$request->name, 'division_id'=>$request->division_id, 'location'=>$request->location]);

        return redirect()->route('stock.index', ['type'=>'asset']);
    }

    public function edit(Request $request)
    {
        $data = Stock::findOrFail($request->id);
        $divisions = Category::where('group_by', 'divisions')->get();
        
        return view('pages.StockEdit', compact('data', 'divisions'));
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
