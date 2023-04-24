@extends('template.master_template')

@section('title', 'SIARAT | Detail - Disposisi')

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
                <h4 class="card-title">Detail Disposisi</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="300px">Nomor Surat</th>
                                <td>{{ $disposisi->suratmasuk->nomor }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Asal Surat</th>
                                <td>{{ $disposisi->suratmasuk->pengirim }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Tujuan</th>
                                <td>{{ $disposisi->user->name }} - {{ $disposisi->user->jabatan }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Batas Waktu</th>
                                <td>{{ Carbon\Carbon::parse($disposisi->batas_waktu)->isoFormat('D MMMM Y') }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Perihal</th>
                                <td>{{ $disposisi->perihal }}</td>
                            </tr>
                            <tr>
                                <th width="300px">Status</th>
                                <td>{{ $disposisi->status == '0' ?  'Diproses' : 'Diterima'}} </td>
                            </tr>
                            <tr>
                                <th width="300px">Isi</th>
                                <td>{{ $disposisi->isi }}</td>
                            </tr>
                        </thead>
                    </table>
                    <div class="col-12 d-flex justify-content-end mt-2">
                        <a href="{{ route('disposisi.index') }}" class="btn btn-danger me-1 mb-1">Kembali</a>
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
