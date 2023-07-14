@extends('template_backend.home')
@section('heading', 'Modul')
@section('page')
    <li class="breadcrumb-item active">Modul</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <button type="button" class="btn btn-primary btn-sm" onclick="getCreatePaket()" data-toggle="modal"
                        data-target="#form-paket">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Modul
                    </button>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal / Waktu</th>
                            <th>Tahun</th>
                            <th>Semester</th>
                            <th>File Preview</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modul as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->created_at->format('d-m-Y H:i') }}</td>
                                <td>{{ $data->tahun }}</td>
                                <td>{{ $data->semester }}</td>
                                <td>{{ $data->file_modul }}</td>
                                <td>
                                    <a href="{{ route('modul.show', Crypt::encrypt($data->id)) }}"
                                        class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp;
                                        Detail</a>
                                    <form action="{{ route('modul.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i>
                                            &nbsp; Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

    <!-- Extra large modal -->
    <div class="modal fade bd-example-modal-md" id="form-paket" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="judul"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('modul.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="id" name="id">
                                <div class="form-group" id="form_ket"></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                    <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                        Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra large modal -->
    <div class="modal fade bd-example-modal-lg view-siswa" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="judul-siswa">View Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No Induk Siswa</th>
                                            <th>Nama Siswa</th>
                                            <th>L/P</th>
                                            <th>Foto Siswa</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-siswa">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</button>
                        <a id="link-siswa" href="#" class="btn btn-primary"><i class="nav-icon fas fa-download"></i>
                            &nbsp; Download PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra large modal -->
    <div class="modal fade bd-example-modal-xl view-jadwal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="judul-jadwal">View Jadwal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Jadwal</th>
                                            <th>Jam Pelajaran</th>
                                            <th>Ruang Paket</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-jadwal">
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</button>
                        <a id="link-jadwal" href="#" class="btn btn-primary"><i
                                class="nav-icon fas fa-download"></i> &nbsp; Download PDF</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            function getCreatePaket() {
                $("#judul").text('Tambah Modul');
                $('#id').val('');
                $('#form_ket').html('');
                $('#form_ket').html(`
                    <label for="semester">Semester</label>
                    <select id="semester" type="text"
                        class="form-control @error('semester') is-invalid @enderror "
                        name="semester">
                        <option value="">-- Pilih {{ __('Semester') }} --</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                    <label for="file_modul">File Modul</label><input type='file' id="file_modul" name='file_modul' class="form-control @error('file_modul') is-invalid @enderror" placeholder="{{ __('file_modul') }}">
                        `);
            }

            function getEditPaket(id) {
                var parent = id;
                var form_ket = (` <
                        label
                        for = "ket" > Nama Paket < /label> <
                        input type = 'text'
                        id = "ket"
                        name = 'ket'
                        class =
                        "form-control @error('ket') is-invalid @enderror"
                        placeholder = "{{ __('Nama Paket') }}" >
                        `);
                $.ajax({
                    type: "GET",
                    data: "id=" + parent,
                    dataType: "JSON",
                    url: "{{ url('/paket/edit/json') }}",
                    success: function(result) {
                        // console.log(result);
                        if (result) {
                            $.each(result, function(index, val) {
                                $("#judul").text('Edit Data Paket : ' + val.ket);
                                $('#form_ket').html('');
                                $("#form_ket").append(form_ket);
                                $('#id').val(val.id);
                                $('#ket').val(val.ket);
                            });
                        }
                    },
                    error: function() {
                        toastr.error("Errors 404!");
                    },
                    complete: function() {}
                });
            }

            $("#MasterData").addClass("active");
            $("#liMasterData").addClass("menu-open");
            $("#DataPaket").addClass("active");
        </script>
    @endsection
