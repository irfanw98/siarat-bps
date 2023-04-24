@extends('template.master_template')

@section('title', 'SIARAT | Disposisi')

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
                <h3>Disposisi</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('disposisi.create') }}" name="tambah" class="btn btn-primary me-1 mb-3" role="button" style="color: white;"><i class="fa-solid fa-plus"></i></a>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover nowrap" id="table-disposisi" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Asal Surat</th>
                                <th>Tujuan</th>
                                <th>Batas Waktu</th>
                                <th>Status</th>
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
    $('#table-disposisi').DataTable({
        responsive: true,
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('disposisi.index') }}",
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
                data: 'no_surat',
                name: 'no_surat'
            },
            {
                data: 'asal_surat',
                name: 'asal_surat'
            },
            {
                data: 'tujuan',
                name: 'tujuan'
            },
            {
                data: 'batas_waktu',
                name: 'batas_waktu'
            },
            {
                data: 'status',
                name: 'status'
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
                "targets": [0,5,6],
                "className": "text-center",
            },
            {
                "targets": [5],
                render: function(data, type, row){
                    if(row.status  == 0 ){
                        return '<p style="background-color:#FFCA2C; color:#fff; padding:2px; margin:auto; border-radius:2px;">Proses</p>'
                    } else{
                        return '<p style="background-color:#157347; color:#fff; padding:2px; margin:auto; border-radius:2px;">Diterima</p>'
                    }
                }
            }
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
$(document).on('click', '.detail_disposisi', function(e){
    e.preventDefault()
    const id = $(this).attr('id')

    $.ajax({
        url: `{{ url('/disposisi/${id}') }}`,
        method: 'GET',
        success: function(response){
            window.location.replace(`{{ url('/disposisi/${id}') }}`)
        }
    })
})

//Ubah Disposisi
$('body').on('click', '.edit_disposisi', function(e){
    e.preventDefault()
    const id = $(this).attr('id')

    $.ajax({
        url: `{{ url('/disposisi/${id}/edit') }}`,
        method: 'GET',
        success: function(response){
            window.location.replace(`{{ url('disposisi/${id}/edit') }}`)
        }
    })
})

//Hapus Disposisi
$(document).on('click', '.hapus_disposisi', function(e){
        e.preventDefault()
        const id = $(this).attr('id')
        var confirmation = confirm(`Yakin, disposisi akan dihapus?`)

        if (confirmation) {
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ url('/disposisi/${id}') }}`,
                type: "POST",
                data: {
                    multi: null,
                    '_method': 'DELETE',
                    'id': id,
                },
                success: function(response){
                    $('#table-disposisi').DataTable().ajax.reload()

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
