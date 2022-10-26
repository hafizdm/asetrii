<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Category
};

class Select2Controller extends Controller
{
    public function categories(Request $request)
    {
        $data = [];
        if ($request->category) {
            $data = Category::where('group_by', $request->category)
                            ->get()->toArray();
        }

        // var_dump($data);

        return response()->json($data);
    }
}
