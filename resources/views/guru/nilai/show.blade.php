@extends('template_backend.home')
@section('heading', 'Deskripsi Nilai')
@section('page')
    <li class="breadcrumb-item active">Deskripsi Nilai</li>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <form method="post" id="AddNilai">
            <div class="card card-primary">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title align-self-center">Deskripsi Nilai</h3>
                    <a href="{{ route('nilai.create') }}" class="ml-auto float-right btn btn-light text-dark btn-sm">
                        <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Nilai
                    </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_guru">Nama Guru</label>
                                <input type="text" id="nama_guru" onchange="getNilaiSiswa()" name="nama_guru"
                                    value="{{ $guru->nama_guru }}" class="form-control" readonly>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <div class="form-group col-4 pl-0 pr-2">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" onchange="getNilaiSiswa()" class="form-control">
                                        <option value="">Pilih Tahun</option>
                                        @foreach ($tahun as $data)
                                            <option>{{ $data->tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-8 px-0">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" onchange="getNilaiSiswa()" class="form-control">
                                        <option value="">Pilih Semester</option>
                                        <option>Ganjil</option>
                                        <option>Genap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tingkat_kelas">Tingkat Kelas</label>
                                <select name="tingkat_kelas" id="tingkat_kelas" onchange="getNilaiSiswa()"
                                    class="form-control">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_penilaian">Jenis Penilaian</label>
                                <select name="jenis_penilaian" id="jenis_penilaian" onchange="getNilaiSiswa()"
                                    class="form-control">
                                    <option value="">Pilih Jenis Penilaian</option>
                                    <option value="submatif">Submatif</option>
                                    <option value="formatif">Formatif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_rombel">Jenis Rombongan Belajar</label>
                                <select name="jenis_rombel" id="jenis_rombel" onchange="getNilaiSiswa()"
                                    class="form-control">
                                    <option value="reguler">Reguler
                                    </option>
                                    <option value="mapel_pilihan">Mapel
                                        Pilihan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <select name="mapel" id="mapel" onchange="getNilaiSiswa()" class="form-control">
                                    @foreach ($guru->mapel as $mapel)
                                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <span class="badge badge-warning col-12 p-4 my-4 d-none" id="BadgeNotFound">
                            <h6 class="p-0 m-0">Data Tidak Ditemukan.</h6>
                        </span>
                        <table id="TabelPertemuan" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th>Konten</th>
                                    <th>Tujuan Pembelajaran</th>
                                    <th>Materi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </form>
    </div>

    <!-- Extra large modal -->
    <div class="modal fade modal-data-nilai" id="modal-data-nilai" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Nilai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="TabelNilaiSiswa" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>No Induk</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                    <a href="#" id="edit-btn" class="btn btn-primary text-light"><i
                            class="nav-icon fas fa-edit"></i>
                        &nbsp;
                        Edit</a>
                </div>
            </div>
        </div>
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

        // fetch nilai siswa
        function getNilaiSiswa(e) {
            let tahun = document.getElementById('tahun');
            let semester = document.getElementById('semester');
            let tingkat_kelas = document.getElementById('tingkat_kelas');
            let jenis_rombel = document.getElementById('jenis_rombel');
            let jenis_penilaian = document.getElementById('jenis_penilaian');
            let mapel = document.getElementById('mapel');

            $.ajax({
                type: "GET",
                data: {
                    'tahun': tahun.value,
                    'semester': semester.value,
                    'tingkat_kelas': tingkat_kelas.value,
                    'jenis_penilaian': jenis_penilaian.value,
                    'jenis_rombel': jenis_rombel.value,
                    'mapel': mapel.value,
                },
                dataType: "JSON",
                url: "{{ url('/nilai/get-nilai-siswa') }}",
                success: function(result) {
                    if (result) {
                        $("#BadgeNotFound").addClass('d-none');

                        const tbody = document.querySelector('#TabelPertemuan tbody');
                        tbody.innerHTML = "";
                        $.each(result, function(index, val) {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${index + 1}</td>
                                <td>${val.konten}</td>
                                <td>${val.tujuan_pembelajaran}</td>
                                <td>${val.materi}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target=".modal-data-nilai" data-detail='${JSON.stringify(val)}' class="btn btn-primary detail-btn">
                                        Detail
                                    </button>
                                </td>
                            `;
                            tbody.appendChild(row);
                        });
                    } else {
                        $("#BadgeNotFound").removeClass('d-none');
                        konten.value = '';
                        tujuan_pembelajaran.value = '';
                        materi.value = '';
                    }
                },
                error: function() {
                    toastr.error("Terjadi kesalahan. Coba lagi nanti.");
                },
                complete: function() {}
            });

            $(document).on('click', '.detail-btn', function() {
                const detailData = $(this).data('detail');

                const tbody = document.querySelector('#TabelNilaiSiswa tbody');
                tbody.innerHTML = "";
                $.each(detailData.siswa, function(index, val) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <input type="hidden" name="siswa_id" value="${val.id}">
                        <td>${index + 1}</td>
                        <td>${val.no_induk}</td>
                        <td>${val.nis}</td>
                        <td>${val.nama_siswa}</td>
                        <td>${val.jk}</td>
                        <td>${val.pivot.nilai ?? "Kosong"}</td>
                    `;
                    tbody.appendChild(row);
                });

                const edit_btn = document.getElementById('edit-btn');
                edit_btn.href = `{{ url('nilai/${detailData.id}/edit/') }}`
            });
        }
    </script>
@endsection
