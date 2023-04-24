<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratKeluarController extends Controller
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
                    <a href="" class="btn btn-warning edit_suratkeluar" role="button" id="' . $data->id . '"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-danger hapus_suratkeluar" role="button" id="' . $data->id . '" no_surat="' . $data->nomor . '" asal_surat="' . $data->pengirim . '"><i class="fa-solid fa-trash"></i></a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('tu.surat_keluar.index');
    }

    public function create()
    {
        return view('tu.surat_keluar.create');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $extension = $files->getClientOriginalExtension();
            $filename = base64_encode(time()) . '.' . $extension;
            $files->move(public_path().'/file', $filename);
            $files->file = $filename;
        } else {
            $filename = '';
        }

        $suratKeluar = SuratKeluar::create([
            'user_id'    => Auth::user()->id,
            'nomor'      => $request->nomor,
            'tujuan'     => $request->tujuan,
            'tanggal'    => $request->tanggal,
            'perihal'    => $request->perihal,
            'file'       => $filename
        ]);

        return redirect('/surat-keluar')->with('message', 'Surat keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        return view('tu.surat_keluar.show', [
            'suratkeluar' => SuratKeluar::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('tu.surat_keluar.edit', [
            'suratkeluar' => SuratKeluar::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $suratKeluar = SuratKeluar::FindOrFail($id);

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $extension = $files->getClientOriginalExtension();
            $filename = base64_encode(time()) . '.' . $extension;
            $files->move(public_path().'/file', $filename);
            $oldFilename = $suratKeluar->file;
            $suratKeluar->file = $filename;
        } else {
            $filename = $suratKeluar->file;
        }

        $suratKeluar->update([
            'nomor'      => $request->nomor,
            'tujuan'     => $request->tujuan,
            'tanggal'    => $request->tanggal,
            'perihal'    => $request->perihal,
            'file'       => $filename
        ]);

        return redirect('/surat-keluar')->with('message', 'Surat keluar berhasil diedit.');
    }

    public function destroy($id)
    {
        $suratKeluar = SuratKeluar::FindOrFail($id);
        $suratKeluar->delete();

        return response()->json(['code'=>200,'success' => 'Surat Keluar berhasil dihapus.']);
    }

    public function cetakPdf(Request $request)
    {
        $tglmulai = $request->tglAwal;
        $tglsampai = $request->tglAkhir;

        if ($request->tglAawal === null && $request->tglAkhir === null) {
            $suratKeluar = SuratKeluar::with('user')->get()->toArray();

            $pdf = Pdf::loadView('tu.surat_keluar.cetak_pdf', compact('suratKeluar'));
            return $pdf->download('Laporan Surat Keluar.pdf');
        } else if($request->tglAawal <= $request->tglAkhir) {
            $suratKeluar = SuratKeluar::with('user')
                                    ->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])
                                    ->get()
                                    ->toArray();

            $pdf = Pdf::loadView('tu.surat_keluar.cetak_pdf', compact(['suratKeluar','tglmulai','tglsampai']));
            return $pdf->download('Laporan Surat Keluar.pdf');
        }
    }
}