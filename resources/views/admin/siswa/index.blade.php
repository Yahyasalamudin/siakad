@extends('template_backend.home')
@section('heading', 'Data Kelas')
@section('page')
    <li class="breadcrumb-item active">Data Kelas</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                        data-target=".bd-example-modal-lg">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Siswa
                    </button>
                    <a href="{{ route('siswa.export_excel') }}" class="btn btn-success btn-sm my-3" target="_blank"><i
                            class="nav-icon fas fa-file-export"></i> &nbsp; EXPORT EXCEL</a>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importExcel">
                        <i class="nav-icon fas fa-file-import"></i> &nbsp; IMPORT EXCEL
                    </button>
                    {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#dropTable">
                    <i class="nav-icon fas fa-minus-circle"></i> &nbsp; Drop
                </button> --}}
                </h3>
            </div>
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route('siswa.import_excel') }}" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h5 class="modal-title">Petunjuk :</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul>
                                            <li>rows 1 = nama siswa</li>
                                            <li>rows 2 = no induk siswa</li>
                                            <li>rows 3 = jenis kelamin (L/P)</li>
                                            <li>rows 4 = nama kelas</li>
                                        </ul>
                                    </div>
                                </div>
                                <label>Pilih file excel</label>
                                <div class="form-group">
                                    <input type="file" name="file" required="required">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="dropTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route('siswa.deleteAll') }}">
                        @csrf
                        @method('delete')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sure you drop all data?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                                <button type="submit" class="btn btn-danger">Drop</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_kelas }}</td>
                                <td>
                                    <a href="{{ route('siswa.kelas', Crypt::encrypt($data->id)) }}"
                                        class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp;
                                        Detail</a>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="getSubsSiswa({{$data->id}}, 'view-naik-kelas')" data-toggle="modal" data-target=".naik-kelas">
                                        <i class="nav-icon fas fa-users"></i> &nbsp; Pindah Kelas
                                    </button>
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
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Siswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_induk">Nomor Induk</label>
                                    <input type="text" id="no_induk" name="no_induk"
                                        onkeypress="return inputAngka(event)"
                                        class="form-control @error('no_induk') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" id="nama_siswa" name="nama_siswa"
                                        class="form-control @error('nama_siswa') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select id="jk" name="jk"
                                        class="select2bs4 form-control @error('jk') is-invalid @enderror">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tmp_lahir">Tempat Lahir</label>
                                    <input type="text" id="tmp_lahir" name="tmp_lahir"
                                        class="form-control @error('tmp_lahir') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label for="foto">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="foto"
                                                class="custom-file-input @error('foto') is-invalid @enderror"
                                                id="foto">
                                            <label class="custom-file-label" for="foto">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nis">NISN</label>
                                    <input type="text" id="nis" name="nis"
                                        onkeypress="return inputAngka(event)"
                                        class="form-control @error('nis') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                    <select id="kelas_id" name="kelas_id"
                                        class="select2bs4 form-control @error('kelas_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="telp">Nomor Telpon/HP</label>
                                    <input type="text" id="telp" name="telp"
                                        onkeypress="return inputAngka(event)"
                                        class="form-control @error('telp') is-invalid @enderror">
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir"
                                        class="form-control @error('tgl_lahir') is-invalid @enderror">
                                </div>
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

    <div class="modal fade bd-example-modal-lg naik-kelas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="judul-siswa">Pindah Kelas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('siswa.naik_kelas') }}" id="form-pindah-siswa" method="post">
                @csrf
                    <div class="row">
                        <div class="col-md-12">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="d-flex align-items-center">
                                    <span>Kelas asal : </span>
                                    <span class="mx-3 font-weight-bold" id="kelas_asal">-</span>
                                </div>
                                <div id="kelas_wrapper" class="d-flex align-items-center">
                                    <label class="m-0 p-0 mr-3 font-weight-normal" for="kelas_id">Pindah ke kelas : </label>
                                    <select id="kelas_id" name="kelas_id" class="select2bs4 form-control @error('kelas_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kelas Tujuan --</option>
                                        @foreach ($kelas as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" id="tipe_pindah_siswa" name="tipe_pindah_siswa">
                                <div id="tahun_lulus_wrapper" class="d-none">
                                    <label class="m-0 p-0 mr-3 font-weight-normal" for="tahun_lulus">Lulus pada tahun ajaran : </label>
                                    <input type="text" id="tahun_lulus" name="tahun_lulus"
                                            class="form-control @error('tahun_lulus') is-invalid @enderror" readonly>
                                </div>
                            <table class="table table-bordered table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                <th>No Induk Siswa</th>
                                <th>Nama Siswa</th>
                                <th>L/P</th>
                                <th>Pilih Siswa</th>
                                </tr>
                            </thead>
                            <tbody id="data-naik-kelas">
                            </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</button>
                        <button type="submit" id="btn_pindah_siswa" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Pindah Kelas</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
@endsection
@section('script')
    <script>
        function getSubsSiswa(id, type){
            var parent = id;
            $.ajax({
                type:"GET",
                data:"id="+parent,
                dataType:"JSON",
                url:"{{ url('/siswa/view/json') }}",
                success:function(result){
                    if(result){
                        const isMaxClassroom = result.is_max_classroom;
                        if (isMaxClassroom) {
                            const currentYear = new Date().getFullYear();
                            $('#tipe_pindah_siswa').val('graduate');
                            $('#kelas_wrapper').addClass('d-none')
                            $('#kelas_wrapper').removeClass('d-flex align-items-center')
                            $('#tahun_lulus_wrapper').removeClass('d-none')
                            $('#tahun_lulus_wrapper').addClass('d-flex align-items-center')
                            $('#tahun_lulus').val(currentYear);
                            $('#btn_pindah_siswa').text('Luluskan Siswa');
                            $('#btn_pindah_siswa').off('click');
                            $('#btn_pindah_siswa').click((e) => {
                                e.preventDefault()
                                if (confirm('Apakah Anda yakin ingin meluluskan siswa?')) {
                                    $('#form-pindah-siswa').submit();
                                }
                            });
                        } else {
                            $('#tipe_pindah_siswa').val('change-class');
                            $('#tahun_lulus_wrapper').addClass('d-none')
                            $('#tahun_lulus_wrapper').removeClass('d-flex align-items-center')
                            $('#kelas_wrapper').removeClass('d-none')
                            $('#kelas_wrapper').addClass('d-flex align-items-center')
                            $('#btn_pindah_siswa').text('Pindah Kelas');
                            $('#btn_pindah_siswa').off('click');
                            $('#btn_pindah_siswa').click((e) => {
                                e.preventDefault()
                                if (confirm('Apakah Anda yakin ingin memindahkan siswa?')) {
                                    $('#form-pindah-siswa').submit();
                                }
                            });
                        }
                        
                        var siswa = "";
                        $.each(result.siswa,function(index, val){
                            $('#kelas_asal').text(val.kelas);
                            siswa += "<tr>";
                            siswa += "<td>"+val.no_induk+"</td>";
                            siswa += "<td>"+val.nama_siswa+"</td>";
                            siswa += "<td>"+val.jk+"</td>";
                            siswa += `
                                <td>
                                <input type="checkbox" name="siswa_id[` + index + `]" value="` + val.id + `" class="checkboxSiswa" checked>
                                </td>
                            `;
                            siswa+="</tr>";
                        });

                        $("#data-naik-kelas").html(siswa);
                    }
                },
                error:function(){
                    $("#data-naik-kelas").html('');
                    toastr.error("Errors 404!");
                },
                complete:function(){
                }
            });
            $("#link-siswa").attr("href", "https://siakad.didev.id/listsiswapdf/"+id);
        }
        
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataSiswa").addClass("active");
    </script>
@endsection
