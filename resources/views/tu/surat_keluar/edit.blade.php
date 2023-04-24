@extends('template.master_template')

@section('title', 'SIARAT | Edit - Surat Keluar')

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
                <h4 class="card-title">Edit Surat Keluar</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('surat-keluar.update', $suratkeluar->id) }}"" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor">Nomor Surat</label>
                                <input type="text" class="form-control" id="nomor" name="nomor" value="{{ $suratkeluar->nomor }}">
                                @error('nomor')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ $suratkeluar->tujuan }}">
                                @error('tujuan')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal Surat</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $suratkeluar->tanggal }}">
                                @error('tanggal')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <input type="text" class="form-control" id="perihal" name="perihal" value="{{ $suratkeluar->perihal }}">
                                @error('perihal')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ asset('file') }}/{{ $suratkeluar->file }}" width="200px" class="mb-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file">Upload Surat</label>
                                    <input type="file" class="form-control" id="file" name="file">
                                    @error('file')
                                        <div class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <a href="{{ url('/surat-keluar') }}" class="btn btn-danger me-1 mb-1">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script>
</script>
@endsection
