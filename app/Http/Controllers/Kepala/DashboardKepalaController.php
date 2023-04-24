<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disposisi;

class DashboardKepalaController extends Controller
{
    public function index()
    {
        return view('kepala.dashboard_kepala', [
            'totalDisposisi'  => Disposisi::count(),
            'terimaDisposisi' => Disposisi::where('status', '=', '1')->count(),
            'prosesDisposisi' => Disposisi::where('status', '=', '0')->count()
        ]);
    }
}