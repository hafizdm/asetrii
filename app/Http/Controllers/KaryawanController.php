<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        // $karyawan = Karyawan::all();
        return view('pages.KaryawanIndex');
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'nik' => 'required|max:10',
        //     'nama_karyawan' => 'required|max:255',
        //     'alamat' => 'required|max:255',
        //     'email' => 'required|max:255',
        //     'no_hp' => 'required|max:255',
        //     'agama' => 'required|max:255',
        //     'jabatan' => 'required|max:255',
        //     'division' => 'required|max:255'
        // ]);

        // $karyawan = new Karyawan;
        // $karyawan->nik = $validatedData['nik'];
        // $karyawan->nama_karayawan = $validatedData['nama_karyawan'];
        // $karyawan->alamat = $validatedData['alamat'];
        // $karyawan->email = $validatedData['email'];
        // $karyawan->no_hp = $validatedData['no_hp'];
        // $karyawan->agama = $validatedData['agama'];
        // $karyawan->jabatan = $validatedData['jabatan'];
        // $karyawan->division = $validatedData['division'];
        // $karyawan->save();

        // return redirect()->route('karyawan.index');
    }
}
