<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    SuratMasuk,
    SuratKeluar
};

class DashboardTuController extends Controller
{
    public function index()
    {
        return view('tu.dashboard_tu', [
            'totalPegawai'     => User::where('role', '=', 'pegawai')->count(),
            'totalSuratMasuk'  => SuratMasuk::count(),
            'totalSuratKeluar' => SuratKeluar::count()
        ]);
    }
}