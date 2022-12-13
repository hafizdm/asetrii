<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function list()
    {
        return view('pages.CategoryList');
    }

    public function index(Request $request)
    {
        $data = [];
        if ($request->category) {
            $data = Category::where('group_by', $request->category)
                            ->paginate(10)
                            ->withQueryString();
        } else {
            return redirect()->back()->withErrors('Kategori tidak ditemukan.');
        }

        return view('pages.CategoryIndex', compact('data'));
    }

    public function store(Request $request)
    {
        $groups = ['divisions', 'kinds', 'merks', 'units'];

        $req = $request->validate([
            'category_id' =>['nullable', 'uuid', 'exists:categories,id'],
            'group_by' => ['required', 'string', 'in:'.implode(',', $groups)],
            'label' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);
        $req['name'] = Str::kebab($req['label']);

        Category::create($req);

        return redirect()->back()->with('message', 'Kategori berhasil disimpan.');
    }

    // public function update(CategoryUpdateReq $request, $id)
    // {
    //     $row = $this->getModel($id);
    //     $row->label = $request->label;
    //     $row->notes = $request->notes;
    //     $row->group_by = $request->group_by;

    //     $repo = new Category($row);
    //     $repo->setAccessControl($this->getAccessControl());
    //     $repo->save();

    //     return redirect()->back()->with('message', 'Kategori berhasil disimpan.');
    // }

    // public function show($id)
    // {
    //     $data = $this->getModel($id);

    //     return view('pages.CategoryDetail', compact('data'));
    // }

    public function destroy($id)
    {
        // $row = $this->getModel($id);

        // $repo = new Category($row);
        // $repo->setAccessControl($this->getAccessControl());
        // $repo->delete();

        Category::destroy($id);

        return redirect()->back()->with('message', 'Kategori berhasil dihapus.');
    }

    // private function getModel($id)
    // {
    //     $row = Model::find($id);

    //     if (empty($row))
    //         abort(404, 'Kategori tidak ditemukan.');

    //     // insert $row to repository for checking access control
    //     $repo = new Category($row);
    //     $repo->setAccessControl($this->getAccessControl());

    //     $row = $repo->get();

    //     return $row;
    // }
}
