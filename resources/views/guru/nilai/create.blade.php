@extends('template_backend.home')
@section('heading', 'Deskripsi Nilai')
@section('page')
    <li class="breadcrumb-item active">Deskripsi Nilai</li>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <form action="{{ route('nilai.store') }}" method="post">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Deskripsi Nilai</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @csrf
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="id" value="">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_guru">Nama Guru</label>
                                <input type="text" id="nama_guru" name="nama_guru" value="{{ $guru->nama_guru }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester" class="form-control">
                                    <option>Ganjil</option>
                                    <option>Genap</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tingkat_kelas">Tingkat Kelas</label>
                                <select name="tingkat_kelas" id="tingkat_kelas" class="form-control"
                                    onchange="getSiswaByKelas(event)">
                                    <option>Pilih Kelas</option>
                                    @foreach ($kelas as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_rombel">Jenis Rombongan Belajar</label>
                                <select name="jenis_rombel" id="jenis_rombel" class="form-control">
                                    <option value="reguler">Reguler</option>
                                    <option value="mapel_pilihan">Mapel Pilihan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <select name="mapel" id="mapel" class="form-control">
                                    <option value="reguler">{{ $guru->mapel->nama_mapel }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="konten">Konten</label>
                                <textarea type="text" id="konten" name="konten" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tujuan_pembelajaran">Tujuan Pembelajaran</label>
                                <textarea type="text" id="tujuan_pembelajaran" name="tujuan_pembelajaran" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="materi">Materi</label>
                                <textarea type="text" id="materi" name="materi" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <table id="AbsenSiswa" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th>Nama Siswa</th>
                                    <th class="col-3">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($siswa as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->siswa->nama_siswa }}</td>
                                        <td>
                                            {{ $data->jenis_absen }}
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="#" name="kembali" class="btn btn-default" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                            Simpan</button>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#back').click(function() {
                window.location = "{{ url('/') }}";
            });
        });
        $("#NilaiGuru").addClass("active");
        $("#liNilaiGuru").addClass("menu-open");
        $("#DesGuru").addClass("active");

        // fetch SiswaByKelas
        function getSiswaByKelas(e) {
            $.ajax({
                type: "GET",
                data: "kelas_id=" + e.target.value,
                dataType: "JSON",
                url: "{{ url('/nilai/get-siswa') }}",
                success: function(result) {
                    // console.log(result);
                    if (result) {
                        console.log(result);
                        // $.each(result, function(index, val) {
                        //     $('#id').val(val.id);
                        //     $('#form_nama').html('');
                        //     $('# ').html('');
                        //     $("#form_paket").append(form_paket);
                        //     $('#nama_kelas').val(val.nama);
                        //     $("#paket_id").val(val.paket_id);
                        //     $('#guru_id').val(val.guru_id);
                        // });
                    }
                },
                error: function() {
                    toastr.error("Errors 404!");
                },
                complete: function() {}
            });
        }
    </script>
@endsection
