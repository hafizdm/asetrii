<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Category,
    Item,
    Stock
};

class Select2Controller extends Controller
{
    public function categories(Request $request)
    {
        $data = [];
        if ($request->category) {
            $data = Category::where('group_by', $request->category)
                            ->where('category_id', $request->category_id ?? null)
                            ->get()->toArray();
        }


        return response()->json($data);
    }

    public function stocks(Request $request)
    {
        $data = Stock::all()->toArray();


        return response()->json($data);
    }

    public function items(Request $request)
    {
        if (!isset($request->stock_id) || empty($request->stock_id))
            return response()->json([]);

        $data = Item::where('stock_id', $request->stock_id);

        // we must know if stock asset or non-asset

        if (isset($request->status)) {
            $data = $data->where('status', $request->status);
        }

        $data = $data->get()->toArray();

        $stock = Stock::find($request->stock_id);
        if ($stock->type == 'non-asset') {
            foreach ($data as $index => $val) {
                $totalLeft = Item::where('id', $val['id'])->first()->countStock();

                $val['amount'] = $totalLeft;

                $data[$index] = $val;
            }
        }

        return response()->json($data);
    }
}
