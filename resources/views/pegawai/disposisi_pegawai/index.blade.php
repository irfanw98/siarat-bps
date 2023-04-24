@extends('template.master_template')

@section('title', 'SIARAT | Pegawai - Disposisi')

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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover nowrap" id="table-disposisi" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Asal Surat</th>
                                <th>Tujuan</th>
                                <th>Batas Waktu</th>
                                <th>Surat</th>
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
            url: "{{ route('disposisi-pegawai.index') }}",
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
                data: 'surat',
                name: 'surat',
                render: function(data, type, full, meta) {
                    // return "<img src={{ asset('file') }}/" + data + " width='80' height='70'/>";
                    return '<a href="{{ asset('file') }}/' + data + '" target="_blank">Lihat Surat</a>'
                },
                orderable: false
            },
            {
                data: 'status',
                name: 'status',
                render: function(data, type, row){
                    if(row.status  == 0 ){
                        return '<p style="background-color:#FFCA2C; color:#fff; padding:2px; margin:auto; border-radius:2px;">Proses</p>'
                    } else{
                        return '<p style="background-color:#157347; color:#fff; padding:2px; margin:auto; border-radius:2px;">Diterima</p>'
                    }
                },
                orderable: false,
                searchable: false
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
                "targets": [0,5,6,7],
                "className": "text-center",
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

$(document).on('click', '.acc_disposisi', function(e) {
    e.preventDefault()
    const id = $(this).attr('id')
    const confirmation = confirm(`Yakin, Disposisi diterima?.`)

    if (confirmation) {
        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `{{ url('/disposisi-pegawai/${id}') }}`,
            type: "POST",
            data: {
                multi: null,
                '_method': 'PUT',
                'id': id,
            },
            success: function(response){
                $('#table-disposisi').DataTable().ajax.reload()

                //show message
                if(response.success) {
                    $('#ajax-alert').removeClass('alert-danger alert-dismissible show fade').show(function(){
                        $(this).html(response.errors)
                    })
                    $('#ajax-alert').addClass('alert-success alert-dismissible show fade').show(function(){
                        $(this).html(response.success)
                    })
                    setTimeout(() => {
                        $('#ajax-alert').hide()
                    }, 3000)
                } else if(response.errors){
                    $('#ajax-alert').addClass('alert-danger alert-dismissible show fade').show(function(){
                        $(this).html(response.errors)
                    })
                    setTimeout(() => {
                        $('#ajax-alert').hide()
                    }, 3000)
                }
            }
        })
    }
})
</script>
@endsection
