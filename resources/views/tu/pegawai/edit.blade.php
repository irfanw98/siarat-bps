@extends('template.master_template')

@section('title', 'SIARAT | Pegawai')

@section('header')
<style>

</style>
@endsection

@section('content')
<div class="page-heading">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Pegawai</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $pegawai->id) }}" method="POST" autocomplete="off">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $pegawai->name }}" required>
                                @error('name')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $pegawai->username }}" required>
                                @error('username')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <select class="form-select" id="jabatan" name="jabatan" required>
                                    <option value="" disabled selected>--Pilih Jabatan--</option>
                                    <option value="Kepala Seksi Produksi" @if($pegawai->jabatan == 'Kepala Seksi Peoduksi') selected @endif>Kepala Seksi Produksi</option>
                                    <option value="Kepala Seksi Distribusi" @if($pegawai->jabatan == 'Kepala Seksi Distribusi') selected @endif>Kepala Seksi Distribusi</option>
                                    <option value="Kepala Seksi Sosial" @if($pegawai->jabatan == 'Kepala Seksi Sosial') selected @endif>Kepala Seksi Sosial</option>
                                    <option value="Kepala Seksi Neraca" @if($pegawai->jabatan == 'Kepala Seksi Neraca') selected @endif>Kepala Seksi Neraca</option>
                                    <option value="Ipds" @if($pegawai->jabatan == 'Ipds') selected @endif>Ipds</option>
                                </select>
                                @error('jabatan')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger me-1 mb-1">Kembali</a>
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
