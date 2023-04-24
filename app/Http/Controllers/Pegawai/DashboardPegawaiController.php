<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Disposisi;

class DashboardPegawaiController extends Controller
{
    public function index()
    {
        return view('pegawai.dashboard_pegawai', [
            'totalDisposisi'  => Disposisi::where('user_id', Auth::user()->id)->count(),
            'terimaDisposisi' => Disposisi::where('user_id', Auth::user()->id)
                                            ->where('status', '=', '1')
                                            ->count(),
            'prosesDisposisi' => Disposisi::where('user_id', Auth::user()->id)
                                            ->where('status', '=', '0')
                                            ->count()
        ]);
    }
}