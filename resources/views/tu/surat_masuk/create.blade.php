@extends('template.master_template')

@section('title', 'SIARAT | Tambah - Surat Masuk')

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
                <h4 class="card-title">Tambah Surat Masuk</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('surat-masuk.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor">Nomor Surat</label>
                                <input type="text" class="form-control" id="nomor" name="nomor" value="{{ old('nomor') }}">
                                @error('nomor')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengirim">Pengirim</label>
                                <input type="text" class="form-control" id="pengirim" name="pengirim" value="{{ old('pengirim') }}">
                                @error('pengirim')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal Surat</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                                @error('tanggal')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <input type="text" class="form-control" id="perihal" name="perihal" value="{{ old('perihal') }}">
                                @error('perihal')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="4" value="{{ old('keterangan') }}"></textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="terima_surat">Terima Surat</label>
                                <input type="date" class="form-control" id="terima_surat" name="terima_surat" value="{{ old('terima_surat') }}">
                                @error('terima_surat')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file">Upload Surat</label>
                                <input type="file" class="form-control" id="file" name="file" value="{{ old('file') }}">
                                @error('file')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="col-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <a href="{{ url('/surat-masuk') }}" class="btn btn-danger me-1 mb-1">Kembali</a>
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
