@extends('template.master_template')

@section('title', 'SIARAT | Detail - Surat Masuk')

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
                <h4 class="card-title">Detail Surat Masuk</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="300px">Nomor Surat</th>
                                <td>{{ $suratmasuk->nomor }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Asal Surat</th>
                                <td>{{ $suratmasuk->pengirim }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Tanggal Surat</th>
                                <td>{{ Carbon\Carbon::parse($suratmasuk->tanggal)->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Perihal Surat</th>
                                <td>{{ $suratmasuk->perihal }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Tanggal Terima Surat</th>
                                <td>{{ Carbon\Carbon::parse($suratmasuk->terima_surat)->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Keterangan Surat</th>
                                <td>{{ $suratmasuk->keterangan }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Lihat Surat</th>
                                <td><a href="{{ asset('file/'. $suratmasuk->file) }}" target="_blank">Lihat Surat</a></td>
                            </tr>
                        </thead>
                    </table>
                    <div class="col-12 d-flex justify-content-end mt-2">
                        <a href="{{ url('/surat-masuk') }}" class="btn btn-danger me-1 mb-1">Kembali</a>
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
