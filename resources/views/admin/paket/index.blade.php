@extends('template_backend.home')
@section('heading', 'Data Paket')
@section('page')
    <li class="breadcrumb-item active">Data Paket</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <button type="button" class="btn btn-primary btn-sm" onclick="getCreatePaket()" data-toggle="modal"
                        data-target="#form-paket">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Paket
                    </button>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Paket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paket as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->ket }}</td>
                                <td>
                                    <form action="{{ route('paket.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-success btn-sm"
                                            onclick="getEditPaket({{ $data->id }})" data-toggle="modal"
                                            data-target="#form-paket">
                                            <i class="nav-icon fas fa-edit"></i> &nbsp; Edit
                                        </button>
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
                    <form action="{{ route('paket.store') }}" method="post">
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
                $("#judul").text('Tambah Data Paket');
                $('#id').val('');
                $('#form_ket').html('');
                $('#form_ket').html(`
        <label for="ket">Nama Paket</label>
        <input type='text' id="ket" name='ket' class="form-control @error('ket') is-invalid @enderror" placeholder="{{ __('Nama Paket') }}">
      `);
            }

            function getEditPaket(id) {
                var parent = id;
                var form_ket = (`
                  <label for="ket">Nama Paket</label>
        <input type='text' id="ket" name='ket' class="form-control @error('ket') is-invalid @enderror" placeholder="{{ __('Nama Paket') }}">
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
