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
                                <select name="tingkat_kelas" id="tingkat_kelas" onchange="getNilaiSiswa()""
                                    class="form-control" onchange="getSiswaByKelas(event)">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_rombel">Jenis Rombongan Belajar</label>
                                <select name="jenis_rombel" id="jenis_rombel" onchange="getNilaiSiswa()""
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="konten">Konten</label>
                                <textarea type="text" id="konten" name="konten" class="form-control" rows="4" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tujuan_pembelajaran">Tujuan Pembelajaran</label>
                                <textarea type="text" id="tujuan_pembelajaran" name="tujuan_pembelajaran" class="form-control" rows="4"
                                    readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="materi">Materi</label>
                                <textarea type="text" id="materi" name="materi" class="form-control" rows="4" readonly></textarea>
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
                        <table id="AbsenSiswa" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th>No Induk</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No Telepon</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($nilai_siswa->siswa as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->no_induk }}</td>
                                        <td>{{ $data->nis }}</td>
                                        <td>{{ $data->nama_siswa }}</td>
                                        <td>{{ $data->jk }}</td>
                                        <td>{{ $data->telp }}</td>
                                        <td>{{ $data->pivot->nilai }}</td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="card-footer">
                        <a href="#" name="kembali" class="btn btn-default" id="back"><i
                                class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
                        <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp;
                            Simpan</button>
                    </div> --}}
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

            // $('#AddNilai').on('submit', function(e) {
            //     e.preventDefault();
            //     clearErrors();

            //     let formData = $(this).serialize();
            //     $.ajax({
            //         type: 'POST',
            //         url: '{{ route('nilai.store') }}',
            //         data: formData,
            //         dataType: 'json',
            //         success: function(response) {
            //             toastr.success('Berhasil menambahkan nilai');
            //             window.location.href = response.redirect_url;
            //         },
            //         error: function(xhr, textStatus, errorThrown) {
            //             if (xhr.status === 422) {
            //                 var errors = xhr.responseJSON.errors;
            //                 displayErrors(errors);
            //             }
            //         }
            //     });
            // })

            // function clearErrors() {
            //     $('input').removeClass('is-invalid');
            //     $('select').removeClass('is-invalid');
            //     $('textarea').removeClass('is-invalid');
            // }

            // function displayErrors(errors) {
            //     clearErrors();
            //     for (var field in errors) {
            //         if (errors.hasOwnProperty(field)) {
            //             var messages = errors[field];
            //             for (var i = 0; i < messages.length; i++) {
            //                 toastr.error(messages[i]);
            //                 $('input[name="' + field + '"]').addClass('is-invalid');
            //                 $('select[name="' + field + '"]').addClass('is-invalid');
            //                 $('textarea[name="' + field + '"]').addClass('is-invalid');
            //             }
            //         }
            //     }
            // }
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
            let mapel = document.getElementById('mapel');
            let konten = document.getElementById('konten');
            let tujuan_pembelajaran = document.getElementById('tujuan_pembelajaran');
            let materi = document.getElementById('materi');

            $.ajax({
                type: "GET",
                data: {
                    'tahun': tahun.value,
                    'semester': semester.value,
                    'tingkat_kelas': tingkat_kelas.value,
                    'jenis_rombel': jenis_rombel.value,
                    'mapel': mapel.value,
                },
                dataType: "JSON",
                url: "{{ url('/nilai/get-nilai-siswa') }}",
                success: function(result) {
                    if (result) {
                        $("#BadgeNotFound").addClass('d-none');

                        konten.value = result.konten;
                        tujuan_pembelajaran.value = result.tujuan_pembelajaran;
                        materi.value = result.materi;

                        const tbody = document.querySelector('#AbsenSiswa tbody');
                        tbody.innerHTML = "";
                        $.each(result.siswa, function(index, val) {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <input type="hidden" name="input[${index}][siswa_id]" value="${val.id}">
                                <td>${val.id}</td>
                                <td>${val.no_induk}</td>
                                <td>${val.nis}</td>
                                <td>${val.nama_siswa}</td>
                                <td>${val.jk}</td>
                                <td>${val.telp}</td>
                                <td>${val.pivot.nilai}</td>
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
        }
    </script>
@endsection
