@extends('template.master_template')

@section('title', 'SIARAT | Dashboard - Kepala')

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
        <div class="row">
            <div class="col-12">
                <div class="card text-center" style="height: 180px">
                    <div class="card-header bg-primary" style="height: 70px">
                        <h4 class="text-white mb-5">Total Disposisi</h4>
                    </div>
                    <div class="card-body mt-4">
                        <blockquote class="blockquote mb-0">
                        <h1>{{ $totalDisposisi }}</h1>
                        </blockquote>
                    </div>
                </div>
        </div>
        <div class="row text-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-muted font-semibold mt-2">Diterima</h3>
                        <h2 class="font-extrabold mt-3 mb-0">{{ $terimaDisposisi }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-muted font-semibold mt-2">Diproses</h3>
                        <h2 class="font-extrabold mt-3 mb-0">{{ $prosesDisposisi }}</h2>
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
