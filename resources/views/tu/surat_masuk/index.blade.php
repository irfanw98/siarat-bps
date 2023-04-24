@extends('template.master_template')

@section('title', 'SIARAT | Surat Masuk')

@section('header')
<style>
    .page-heading {
        margin-top: -20px;
    },
</style>
@endsection

@section('content')
<div class="page-heading">
    {{-- Message --}}
    <div id="ajax-alert" class="alert" style="display:none"></div>
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible show fade" id="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- End Message --}}
    <div class="page-title mb-2">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Surat Masuk</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <a href="{{ url('/surat-masuk/create') }}" name="tambah" class="btn btn-primary me-1 mb-1" role="button" style="color: white;"><i class="fa-solid fa-plus"></i></a>
                        </div>
                        <div class="col-md-8 d-flex justify-content-end">
                            <form action="{{ route('surat-masuk.pdf') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tglAwal" class="font-weight-bold">Mulai Tanggal :</label>
                                            <input type="date" id="tglAwal" class="form-control" name="tglAwal">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tglAkhir" class="font-weight-bold">Sampai Tanggal :</label>
                                            <input type="date" id="tglAkhir" class="form-control" name="tglAkhir">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-4 mb-1 text-center">
                                        <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-print"></i> Cetak Laporan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover nowrap" id="table-suratmasuk" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Asal Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#table-suratmasuk').DataTable({
        responsive: true,
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('/surat-masuk') }}",
            type: "GET",
            dataType: "JSON"
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nomor',
                name: 'nomor'
            },
            {
                data: 'pengirim',
                name: 'pengirim'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            }
        ],
        'columnDefs': [
            {
                "targets": [0,4],
                "className": "text-center",
            },
        ]
    })
})

//Aler Check
if ($("#alert" ).length) {
    setTimeout(() => {
        $('#alert').hide()
    }, 3000)
}

//Detail
$(document).on('click', '.detail_surat', function(e){
    e.preventDefault()
    const id = $(this).attr('id')

    $.ajax({
        url: `{{ url('/surat-masuk/${id}') }}`,
        method: 'GET',
        success: function(response){
            window.location.replace(`{{ url('/surat-masuk/${id}') }}`)
        }
    })
})

//Ubah Surat Masuk
$('body').on('click', '.edit_suratmasuk', function(e){
        e.preventDefault()
        const id = $(this).attr('id')

        $.ajax({
            url: `{{ url('/surat-masuk/${id}/edit') }}`,
            method: 'GET',
            success: function(response){
                window.location.replace(`{{ url('surat-masuk/${id}/edit') }}`)
            }
        })
})

//Hapus Surat Masuk
$(document).on('click', '.hapus_suratmasuk', function(e){
        e.preventDefault()
        const id = $(this).attr('id')
        const no_surat = $(this).attr('no_surat')
        const asal_surat = $(this).attr('asal_surat')
        var confirmation = confirm(`Yakin, surat masuk nomor surat ${no_surat}, dari ${asal_surat} akan dihapus?`)

        if (confirmation) {
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ url('/surat-masuk/${id}') }}`,
                type: "POST",
                data: {
                    multi: null,
                    '_method': 'DELETE',
                    'id': id,
                },
                success: function(response){
                    $('#table-suratmasuk').DataTable().ajax.reload()

                    //show message
                    if(response.code === 200) {
                        $('#ajax-alert').addClass('alert-success alert-dismissible show fade').show(function(){
                            $(this).html(response.success)
                        })
                        setTimeout(() => {
                            $('#ajax-alert').hide()
                        }, 2000)
                    } else {
                        $('#ajax-alert').addClass('alert-danger alert-dismissible show fade').show(function(){
                            $(this).html(response.errors)
                        })
                    }
                }
            })
        }
    })
</script>
@endsection
