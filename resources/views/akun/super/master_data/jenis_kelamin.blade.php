@extends('akun.layouts.app')
@section('title', 'Master Data ' . $title)

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="d-flex">
            <button class="btn btn-primary ml-auto" type="button" id="btn_add">Tambah Data</button>
        </div>
        <div class="bg-white container-fluid border border-dark mt-3 py-3">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody> </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Vertically centered scrollable modal -->
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form" action="{{ $route_createOrUpdate }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label required">Nama</label>
                            <input type="text" class="form-control" name="text" id="text">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>

        </div>
    </div>

    <!-- /.container-fluid -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '{{ $route_data }}'
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'text',
                        name: 'text'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                "lengthChange": true,
                "autoWidth": false,
            });
            $(document).on('click', '#btn_add', function(e) {
                clearForm();
                $('#Modal .modal-title').html('Tambah @yield('title')')
                $('#Modal .modal-footer button:last').html('Tambah');
                $('#Modal').modal('show');
            });
            $(document).on('click', '#Modal .modal-footer .btn-primary', function(e) {
                $('#form').submit();
            });
            $(document).on('submit', '#form', function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                Swal.fire({
                    title: "Sudah Yakin Dengan @yield('title') Yang Anda Masukkan ?",
                    text: "",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#009ef7',
                    cancelButtonColor: '#ddd',
                    confirmButtonText: 'Konfirmasi',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            dataType: 'json',
                            method: 'POST',
                            type: 'POST',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: new FormData(this),
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Info',
                                    text: 'Sedang Menginput Data',
                                    icon: 'info',
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    confirmButtonColor: '#d9214e',
                                    confirmButtonText: 'Tutup',
                                });
                            },
                            success: function(response) {
                                var icon = 'success';
                                var action = 'Success';
                                if (response.status == false) {
                                    icon = 'error';
                                    action = 'Error';
                                } else {
                                    table.ajax.reload();
                                    $('#Modal').modal('hide');
                                }
                                Swal.fire({
                                    html: response.pesan,
                                    icon: status,
                                    title: action,
                                    showConfirmButton: true
                                });

                            }
                        })
                    }
                });
            });
            $(document).on('click', '[id^=btn_edit]', function() {

                var route = $(this).data('href');
                $.ajax({
                    url: route,
                    cache: false,
                    dataType: 'json',
                    method: 'GET',
                    beforeSend: function() {
                        clearForm();
                        Swal.fire({
                            title: 'Info',
                            text: 'Sedang Menagmbil Data',
                            icon: 'info',
                            showCancelButton: false,
                            showConfirmButton: false,
                            confirmButtonColor: '#d9214e',
                            confirmButtonText: 'Tutup',
                        });
                    },
                    success: function(response) {
                        if (response.status == false) {
                            Swal.fire({
                                title: 'Error',
                                text: response.pesan,
                                icon: 'error',
                                confirmButtonColor: '#d9214e',
                                confirmButtonText: 'Tutup',
                            });
                        } else {
                            $('#Modal .modal-title').html('Edit @yield('title')')
                            $('#Modal .modal-footer button:last').html('Edit');
                            $('#text').val(response.data.text);
                            $('#form').attr('action', response.data.createOrUpdate);
                            Swal.close();
                            $('#Modal').modal('show');
                        }
                    }
                });
            });
            $(document).on('click', '[id^=btn_delete]', function() {
                var route = $(this).data('href');
                Swal.fire({
                    title: 'Hapus @yield('title')',
                    text: "Apakah Anda yakin ingin menghapus data ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#ddd',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: route,
                            cache: false,
                            dataType: 'json',
                            method: 'POST',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            beforeSend: function() {
                                clearForm();
                                Swal.fire({
                                    title: 'Info',
                                    text: 'Sedang Menghapus Data',
                                    icon: 'info',
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    confirmButtonColor: '#d9214e',
                                    confirmButtonText: 'Tutup',
                                });
                            },
                            success: function(response) {

                                if (response.status == false) {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.pesan,
                                        icon: 'error',
                                        confirmButtonColor: '#d9214e',
                                        confirmButtonText: 'Tutup',
                                    });
                                } else {
                                    Swal.close();
                                    Swal.fire({
                                        title: 'Success',
                                        text: response.pesan,
                                        icon: 'success',
                                        confirmButtonColor: '#d9214e',
                                        confirmButtonText: 'Tutup',
                                    });
                                }
                                table.ajax.reload();
                            }
                        });
                    }
                });
            });
        });

        function clearForm() {
            $('#form').attr('action', '{{ $route_createOrUpdate }}');
            $('#form input:not([name="_token"])').val(null);
            $('#form input:not([type="hidden"])').val(null);
            $('#form select option').attr('selected', false);
            $('#form select').trigger('change');
            $("#form textarea").val(null);
        }
    </script>
@endsection
