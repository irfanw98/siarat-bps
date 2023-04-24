<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disposisi;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class DisposisiPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $disposisi = Disposisi::with(['user','suratmasuk'])
                                ->where('user_id', Auth::user()->id)
                                ->get();

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
                ->addColumn('surat', function($row) {
                    return $row->suratmasuk->file;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-primary acc_disposisi" role="button" id="' . $data->id . '">Terima</a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pegawai.disposisi_pegawai.index');
    }

    public function update(Request $request, $id)
    {
        $disposisi = Disposisi::findOrFail($id);

        if ($disposisi->status == '0')
        {
            $disposisi->status = '1';
            $disposisi->save();

            return response()->json(['success' => 'Disposisi berhasil diterima.']);
        }
            return response()->json(['errors' => 'Disposisi sudah diterima sebelumnya.']);
    }
}