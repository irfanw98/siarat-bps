<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        $suratMasuk = SuratMasuk::with('user')->latest();

        if ($request->ajax()) {
            return DataTables::of($suratMasuk)
                ->editColumn('tanggal', function($data){
                    $formatedDate = Carbon::parse($data->tanggal)->isoFormat('D MMMM Y');
                    return $formatedDate;
                })
                ->addColumn('aksi', function ($data) {
                    return '
                    <a href="" class="btn btn-success detail_surat" role="button" id="' . $data->id . '"><i class="fa-solid fa-eye"></i></a>
                    <a href="" class="btn btn-warning edit_suratmasuk" role="button" id="' . $data->id . '"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="" class="btn btn-danger hapus_suratmasuk" role="button" id="' . $data->id . '" no_surat="' . $data->nomor . '" asal_surat="' . $data->pengirim . '"><i class="fa-solid fa-trash"></i></a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('tu.surat_masuk.index');
    }

    public function create()
    {
        return view('tu.surat_masuk.create');
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

        $suratMasuk = SuratMasuk::create([
            'user_id'       => Auth::user()->id,
            'nomor'         => $request->nomor,
            'pengirim'      => $request->pengirim,
            'tanggal'       => $request->tanggal,
            'terima_surat'  => $request->terima_surat,
            'perihal'       => $request->perihal,
            'keterangan'    => $request->keterangan,
            'file'          => $filename
        ]);

        return redirect('/surat-masuk')->with('message', 'Surat masuk berhasil ditambahkan.');
    }

    public function show($id)
    {
        return view('tu.surat_masuk.show', [
            'suratmasuk' => SuratMasuk::with('user')->findOrfail($id)
        ]);
    }

    public function edit($id)
    {
        return view('tu.surat_masuk.edit', [
            'suratmasuk' => SuratMasuk::with('user')->findOrfail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $suratMasuk = SuratMasuk::FindOrFail($id);

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $extension = $files->getClientOriginalExtension();
            $filename = base64_encode(time()) . '.' . $extension;
            $files->move(public_path().'/file', $filename);
            $oldFilename = $suratMasuk->file;
            $suratMasuk->file = $filename;
        } else {
            $filename = $suratMasuk->file;
        }

        $suratMasuk->update([
            'nomor'         => $request->nomor,
            'pengirim'      => $request->pengirim,
            'tanggal'       => $request->tanggal,
            'terima_surat'  => $request->terima_surat,
            'perihal'       => $request->perihal,
            'keterangan'    => $request->keterangan,
            'file'          => $filename
        ]);

        return redirect('/surat-masuk')->with('message', 'Surat masuk berhasil diedit.');
    }

    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::FindOrFail($id);
        $suratMasuk->delete();

        return response()->json(['code'=>200,'success' => 'Surat Masuk berhasil dihapus.']);
    }

    public function cetakPdf(Request $request)
    {
        $tglmulai = $request->tglAwal;
        $tglsampai = $request->tglAkhir;

        if ($request->tglAawal === null && $request->tglAkhir === null) {
            $suratMasuk = SuratMasuk::with('user')->get()->toArray();

            $pdf = Pdf::loadView('tu.surat_masuk.cetak_pdf', compact('suratMasuk'));
            return $pdf->download('Laporan Surat Masuk.pdf');
        } else if($request->tglAawal <= $request->tglAkhir) {
            $suratMasuk = SuratMasuk::with('user')
                                    ->whereBetween('tanggal', [$request->tglAwal, $request->tglAkhir])
                                    ->get()
                                    ->toArray();

            $pdf = Pdf::loadView('tu.surat_masuk.cetak_pdf', compact(['suratMasuk','tglmulai','tglsampai']));
            return $pdf->download('Laporan Surat Masuk.pdf');
        }
    }
}