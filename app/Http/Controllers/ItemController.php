<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->stock_id) || empty($request->stock_id))
            return redirect()->back()->withErrors(['msg' => 'stock id tidak ditemukan']);

        $data = Item::where('stock_id', $request->stock_id)
                    ->paginate(15)
                    ->withQueryString();

        return view('pages.ItemIndex', compact('data'));
    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {
        $req = $request->validate([
            'stock_id' => ['required', 'uuid', 'exists:stocks,id'],
            'unit_id' => [
                'required',
                'uuid',
                Rule::exists('categories', 'id')->where(function ($query) use ($request) {
                    $query->where('group_by', 'units');
                })
            ],
            'kind_id' => [
                'required',
                'uuid',
                Rule::exists('categories', 'id')->where(function ($query) use ($request) {
                    $query->where('group_by', 'kinds');
                })
            ],
            'merk_id' => [
                'required',
                'uuid',
                Rule::exists('categories', 'id')->where(function ($query) use ($request) {
                    $query->where('group_by', 'merks');
                })
            ],
            'name' => 'required',
        ]);

        $item = Item::create($req);

        return redirect()->back()->with('success', 'item berhasil ditambahkan.');
    }

    public function destroy($id)
    {

    }

}
