@extends('template.master_template')

@section('title', 'SIARAT | Detail - Surat Keluar')

@section('header')
<style>
    .page-heading {
        margin-top: -20px;
    },
</style>
@endsection

@section('content')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Surat Keluar</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="300px">Nomor Surat</th>
                                <td>{{ $suratkeluar->nomor }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Asal Surat</th>
                                <td>{{ $suratkeluar->tujuan }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Tanggal Surat</th>
                                <td>{{ Carbon\Carbon::parse($suratkeluar->tanggal)->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Perihal Surat</th>
                                <td>{{ $suratkeluar->perihal }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Lihat Surat</th>
                                <td><a href="{{ asset('file/'. $suratkeluar->file) }}" target="_blank">Lihat Surat</a></td>
                            </tr>
                        </thead>
                    </table>
                    <div class="col-12 d-flex justify-content-end mt-2">
                        <a href="{{ url('/kepala/surat-keluar') }}" class="btn btn-danger me-1 mb-1">Kembali</a>
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
