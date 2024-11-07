@extends('layouts.app')
@section('title', 'Pendaftaran')
@section('css')
    <link rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/components/registrations/registration-3/assets/css/registration-3.css">
@endsection
@section('content')
    <section class="p-3 p-md-4 p-xl-5 bg-secondary h-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                    <div class="d-flex flex-column  h-100 p-3 p-md-4 p-xl-5">
                        <h3 class="m-0">Selamat Datang di {{ env('APP_NAME') }} !</h3>
                        <img class="img-fluid rounded mx-auto my-auto" loading="lazy" src="../assets/img/bsb-logo.svg"
                            width="245" height="80" alt="BootstrapBrain Logo">

                    </div>
                </div>
                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                    <div class="p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h2 class="h3">Pendaftaran Akun</h2>

                                </div>
                            </div>
                        </div>
                        <form action="{{ url('/register') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-12">
                                    <label for="email" class="form-label">Username <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="nama" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="name@example.com" required>
                                </div>
                                <div class="col-12">
                                    <label for="password" class="form-label">Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        value="" required>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary" type="submit">Daftar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <hr class="mt-5 mb-4 border-secondary-subtle">
                                <p class="m-0 text-secondary text-end">Sudah Memiliki Akun ? <a href="#!"
                                        class="link-primary text-decoration-none">Login Disini</a></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="mt-5 mb-4"></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(
            $(document).on('submit', 'form', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Anda Yakin Menghapus Pengaduan Anda ?",
                    text: "Hapus",
                    iconHtml: '<i class="fa-solid fa-circle-info text-dark display-5"></i>',
                    showCancelButton: true,
                    customClass: {
                        icon: 'border-0'
                    },
                    confirmButtonColor: '#009ef7',
                    cancelButtonColor: '#ddd',
                    confirmButtonText: 'Konfirmasi',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: $(this).attr('data-href'),
                            type: 'POST',
                            data: $(this).serialize(),
                            cache: false,
                            dataType: 'json',
                            beforeSend: () => {
                                Swal.fire({
                                    title: 'Mendaftar Akun',
                                    text: 'Mohon Menunggu',
                                    icon: 'info',
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    backdrop: true,
                                    allowOutsideClick: false,
                                });
                            },
                            success: res => {
                                let icon = 'error';
                                let title = 'Error';
                                if (res.status == true) {
                                    icon = 'success';
                                    title = 'Berhasil';
                                    $('form input:not([name="_token"])').val(null);
                                }
                                Swal.fire({
                                    title: title,
                                    text: res.pesan,
                                    icon: icon,
                                    confirmButtonColor: '#d9214e',
                                    confirmButtonText: 'Tutup',
                                });
                            }
                        });
                    }
                })
            })
        );
    </script>
@endsection
