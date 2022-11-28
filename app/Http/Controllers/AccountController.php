<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    public function index()
    {
        $data = User::paginate(15);

        return view('pages.AccountIndex', compact('data'));
    }

    public function store(Request $request)
    {
        $req = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'username' => ['required', Rule::unique('users', 'username')],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'role' => ['required', Rule::in(['admin', 'superadmin', 'director'])]
        ]);

        $req['password'] = bcrypt($req['password']);
        unset($req['password_confirmation']);

        User::create($req);

        return redirect()->route('account.index')->with('message', 'Akun berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $data = User::find($id);
        if ($data) $data->delete();

        return redirect()->route('account.index')->with('message', 'Akun berhasil dihapus');
    }

    public function show($id)
    {
        $data = User::find($id);
        if (!$data) return redirect()->route('account.index');

        return view('pages.AccountDetail', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);
        if (!$data) return redirect()->route('account.index');

        $req = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($data->id)],
            'username' => ['required', Rule::unique('users', 'username')->ignore($data->id)],
            'password' => ['nullable', 'min:8'],
            'password_confirmation' => ['required_with:password', 'same:password'],
            'role' => ['required', Rule::in(['admin', 'superadmin', 'director'])]
        ]);

        if ($req['password']) {
            $req['password'] = bcrypt($req['password']);
        } else {
            unset($req['password']);
        }
        unset($req['password_confirmation']);

        $data->update($req);

        return redirect()->route('account.index')->with('message', 'Akun berhasil diubah');
    }
}
