@extends('template.master_template')

@section('title', 'SIARAT | Pegawai')

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
                <h3>Pegawai</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <a href="{{ route('users.create') }}" name="tambah" class="btn btn-primary me-1 mb-3" role="button" style="color: white;"><i class="fa-solid fa-plus"></i></a>
                    <table class="table table-bordered table-hover nowrap" id="table-pegawai" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Jabatan</th>
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
    $('#table-pegawai').DataTable({
        responsive: true,
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('/users') }}",
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
                data: 'name',
                name: 'name'
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data:'jabatan',
                name:'jabatan'
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

//Edit Pegawai
$('body').on('click', '.edit_pegawai', function(e){
    e.preventDefault()
    const id = $(this).attr('id')

    $.ajax({
        url: `{{ url('/users/${id}/edit') }}`,
        method: 'GET',
        success: function(response){
            window.location.replace(`{{ url('users/${id}/edit') }}`)
        }
    })
})

//Hapus Surat Masuk
$(document).on('click', '.hapus_pegawai', function(e){
        e.preventDefault()
        const id = $(this).attr('id')
        const nama_pegawai = $(this).attr('nama_pegawai')
        var confirmation = confirm(`Yakin, ${nama_pegawai} akan dihapus?`)

        if (confirmation) {
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `{{ url('/users/${id}') }}`,
                type: "POST",
                data: {
                    multi: null,
                    '_method': 'DELETE',
                    'id': id,
                },
                success: function(response){
                    $('#table-pegawai').DataTable().ajax.reload()

                    //show message
                    if(response.success) {
                        $('#ajax-alert').removeClass('alert-danger')
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
