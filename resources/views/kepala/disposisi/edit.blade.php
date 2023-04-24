@extends('template.master_template')

@section('title', 'SIARAT | Edit - Disposisi')

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
                <h4 class="card-title">Edit Disposisi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('disposisi.update', $disposisi->id) }}" method="POST" autocomplete="off">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tujuan">Didisposisikan Kepada</label>
                                <select class="form-select" id="tujuan" name="tujuan">
                                    <option value="" disabled selected>-- Pilih --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                            @if($user->id == $disposisi->user_id)
                                                selected
                                            @endif>{{ $user->name }} - {{ $user->jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tujuan')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surat_masuk">Surat Masuk</label>
                                <select class="form-select" id="surat_masuk" name="surat_masuk">
                                    <option value="" disabled selected>-- Pilih --</option>
                                    @foreach($suratmasuk as $sm)
                                        <option value="{{ $sm->id }}"
                                            @if($sm->id == $disposisi->suratmasuk_id)
                                                selected
                                            @endif>{{ $sm->nomor }} - {{ $sm->pengirim }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('surat_masuk')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="perihal">Perihal</label>
                                <input type="text" class="form-control" id="perihal" name="perihal" value="{{ $disposisi->perihal }}">
                                @error('perihal')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="batas_waktu">Batas Waktu</label>
                                <input type="date" class="form-control" id="batas_waktu" name="batas_waktu" value="{{ $disposisi->batas_waktu }}">
                                @error('tanggal')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="isi">Isi</label>
                                <textarea name="isi" id="isi" class="form-control" cols="30" rows="4" value="{{ old('isi') }}">{{ $disposisi->isi }}</textarea>
                                @error('isi')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="col-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <a href="{{ route('disposisi.index') }}" class="btn btn-danger me-1 mb-1">Kembali</a>
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
