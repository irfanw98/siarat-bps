<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class SuratKeluarPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $suratKeluar = SuratKeluar::with('user')->latest();

        if ($request->ajax()) {
            return DataTables::of($suratKeluar)
                ->editColumn('tanggal', function($data){
                    $formatedDate = Carbon::parse($data->tanggal)->isoFormat('D MMMM Y');
                    return $formatedDate;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-success detail_suratkeluar" role="button" id="' . $data->id . '"><i class="fa-solid fa-eye"></i></a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('pegawai.surat_keluar.index');
    }

    public function show($id)
    {
        return view('pegawai.surat_keluar.show', [
            'suratkeluar' => SuratKeluar::findOrFail($id)
        ]);
    }
}
