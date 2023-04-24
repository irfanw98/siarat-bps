@extends('template.master_template')

@section('title', 'SIARAT | Kepala - Surat Masuk')

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
                    <table class="table table-bordered table-hover nowrap" id="table-kepalasm" style="width:100%">
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
    $('#table-kepalasm').DataTable({
        responsive: true,
        ordering: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('/kepala/surat-masuk') }}",
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
$(document).on('click', '.detail_suratmasuk', function(e){
    e.preventDefault()
    const id = $(this).attr('id')

    $.ajax({
        url: `{{ url('/kepala/surat-masuk/${id}') }}`,
        method: 'GET',
        success: function(response){
            window.location.replace(`{{ url('/kepala/surat-masuk/${id}') }}`)
        }
    })
})

//Ubah Surat Masuk
// $('body').on('click', '.edit_surat', function(e){
//         e.preventDefault()
//         const id = $(this).attr('id')

//         $.ajax({
//             url: `{{ url('/surat-masuk/${id}/edit') }}`,
//             method: 'GET',
//             success: function(response){
//                 window.location.replace(`{{ url('surat-masuk/${id}/edit') }}`)
//             }
//         })
// })

//Hapus Surat Masuk
// $(document).on('click', '.hapus_surat', function(e){
//         e.preventDefault()
//         const id = $(this).attr('id')
//         const no_surat = $(this).attr('no_surat')
//         const asal_surat = $(this).attr('asal_surat')
//         var confirmation = confirm(`Yakin, surat masuk nomor surat ${no_surat}, dari ${asal_surat} akan dihapus?`)

//         if (confirmation) {
//             $.ajax({
//                 headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 url: `{{ url('/surat-masuk/${id}') }}`,
//                 type: "POST",
//                 data: {
//                     multi: null,
//                     '_method': 'DELETE',
//                     'id': id,
//                 },
//                 success: function(response){
//                     $('#table-suratmasuk').DataTable().ajax.reload()

//                     //show message
//                     if(response.code === 200) {
//                         $('#ajax-alert').addClass('alert-success alert-dismissible show fade').show(function(){
//                             $(this).html(response.success)
//                         })
//                         setTimeout(() => {
//                             $('#ajax-alert').hide()
//                         }, 2000)
//                     } else {
//                         $('#ajax-alert').addClass('alert-danger alert-dismissible show fade').show(function(){
//                             $(this).html(response.errors)
//                         })
//                     }
//                 }
//             })
//         }
//     })
</script>
@endsection
