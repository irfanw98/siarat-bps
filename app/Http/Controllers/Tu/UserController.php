<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $pegawai = User::where('role', '=', 'pegawai')->orderBy('name')->get();

        if ($request->ajax()) {
            return DataTables::of(($pegawai))
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-warning edit_pegawai" role="button" id="' . $data->id . '"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-danger hapus_pegawai" role="button" id="' . $data->id . '" nama_pegawai="' . $data->name . '"><i class="fa-solid fa-trash"></i></a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('tu.pegawai.index');
    }

    public function create()
    {
        return view('tu.pegawai.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => bcrypt('12345'),
            'role'     => 'pegawai',
            'jabatan'  => $request->jabatan,
        ]);

        return redirect('/users')->with('message', 'Pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return view('tu.pegawai.edit', [
            'pegawai' => User::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->update([
            'name'     => $request->name,
            'username' => $request->username,
            'jabatan'  => $request->jabatan
        ]);

        return redirect('/users')->with('message', 'Pegawai berhasil diubah.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['success' => 'Pegawai berhasil dihapus.']);
    }
}