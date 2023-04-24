<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class SuratMasukKepalaController extends Controller
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
                    <a href="" class="btn btn-success detail_suratmasuk" role="button" id="' . $data->id . '"><i class="fa-solid fa-eye"></i></a>
                ';
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('kepala.surat_masuk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('kepala.surat_masuk.show', [
            'suratmasuk' => SuratMasuk::with('user')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}