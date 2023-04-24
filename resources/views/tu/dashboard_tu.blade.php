@extends('template.master_template')

@section('title', 'SIARAT | Dashboard - Tata Usaha')

@section('header')
<style>
    .page-heading {
        margin-top: -30px;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title mb-2">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-muted font-semibold mt-2">Pegawai</h3>
                        <h2 class="font-extrabold mt-3 mb-0">{{ $totalPegawai }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-muted font-semibold mt-2">Surat Masuk</h3>
                        <h2 class="font-extrabold mt-3 mb-0">{{ $totalSuratMasuk }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-muted font-semibold mt-2">Surat Keluar</h3>
                        <h2 class="font-extrabold mt-3 mb-0">{{ $totalSuratKeluar }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>

</script>
@endsection
