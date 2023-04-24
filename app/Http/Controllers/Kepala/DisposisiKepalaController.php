<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\{
    Disposisi,
    User,
    SuratMasuk
};

class DisposisiKepalaController extends Controller
{
    public function index(Request $request)
    {
        $disposisi = Disposisi::with(['user','suratmasuk'])->latest()->get();

        if ($request->ajax()) {
            return DataTables::of($disposisi)
                ->editColumn('batas_waktu', function($data){
                    $formatedDate = Carbon::parse($data->batas_waktu)->isoFormat('D MMMM Y');
                    return $formatedDate;
                })
                ->addColumn('no_surat', function($row) {
                    return $row->suratmasuk->nomor;
                })
                ->addColumn('asal_surat', function($row) {
                    return $row->suratmasuk->pengirim;
                })
                ->addColumn('tujuan', function($row) {
                    return $row->user->jabatan;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-success detail_disposisi" role="button" id="' . $data->id . '"><i class="fa-solid fa-eye"></i></a>
                    <a href="" class="btn btn-warning edit_disposisi" role="button" id="' . $data->id . '"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-danger hapus_disposisi" role="button" id="' . $data->id . '"><i class="fa-solid fa-trash"></i></a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('kepala.disposisi.index');
    }

    public function create()
    {
        return view('kepala.disposisi.create', [
            'users' => User::where('role', '=', 'pegawai')->get(),
            'suratmasuk' => SuratMasuk::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        Disposisi::create([
            'user_id'       => $request->tujuan,
            'suratmasuk_id' => $request->surat_masuk,
            'perihal'       => $request->perihal,
            'isi'           => $request->isi,
            'batas_waktu'   => $request->batas_waktu,
            'status'        => '0'
        ]);

        return redirect('/disposisi')->with('message', 'Disposisi berhasil ditambahkan.');
    }

    public function show($id)
    {
        return view('kepala.disposisi.show', [
            'disposisi' => Disposisi::with(['user','suratmasuk'])->findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('kepala.disposisi.edit', [
            'disposisi' => Disposisi::with(['user','suratmasuk'])->findOrFail($id),
            'users' => User::where('role', '=', 'pegawai')->get(),
            'suratmasuk' => SuratMasuk::latest()->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $disposisi = Disposisi::findOrFail($id);

        $disposisi->update([
            'user_id'       => $request->tujuan,
            'suratmasuk_id' => $request->surat_masuk,
            'perihal'       => $request->perihal,
            'isi'           => $request->isi,
            'batas_waktu'   => $request->batas_waktu,
            'status'        => '0'
        ]);

        return redirect('/disposisi')->with('message', 'Disposisi berhasil diedit.');
    }

    public function destroy($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $disposisi->delete();

        return response()->json(['code'=>200,'success' => 'Disposisi berhasil dihapus.']);
    }
}