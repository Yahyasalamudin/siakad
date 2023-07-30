@extends('template_backend.home')
@section('heading', 'Deskripsi Nilai')
@section('page')
    <li class="breadcrumb-item active">Edit Nilai</li>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <form id="AddNilai">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Nilai</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_guru">Nama Guru</label>
                                <input type="text" id="nama_guru" name="nama_guru" value="{{ $guru->nama_guru }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester" class="form-control" disabled>
                                    <option value="">Pilih Semester</option>
                                    <option @if ($nilai->semester == 'Ganjil') selected @endif>Ganjil</option>
                                    <option @if ($nilai->semester == 'Genap') selected @endif>Genap</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tingkat_kelas">Tingkat Kelas</label>
                                <select name="tingkat_kelas" id="tingkat_kelas" class="form-control"
                                    onchange="getSiswaByKelas(event)" disabled>
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $data)
                                        <option value="{{ $data->id }}"
                                            @if ($nilai->tingkat_kelas == $data->id) selected @endif>{{ $data->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_rombel">Jenis Rombongan Belajar</label>
                                <select name="jenis_rombel" id="jenis_rombel" class="form-control" disabled>
                                    <option value="reguler" @if ($nilai->jenis_rombel == 'Reguler') selected @endif>Reguler
                                    </option>
                                    <option value="mapel_pilihan" @if ($nilai->jenis_rombel == 'Mapel Pilihan') selected @endif>Mapel
                                        Pilihan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <select name="mapel" id="mapel" class="form-control" disabled>
                                    @foreach ($guru->mapel as $mapel)
                                        <option @if ($nilai->mapel_nilai->nama_mapel == $mapel->nama_mapel) selected @endif
                                            value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="konten">Konten</label>
                                <textarea type="text" id="konten" name="konten" class="form-control" rows="4">{{ $nilai->konten }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="tujuan_pembelajaran">Tujuan Pembelajaran</label>
                                <textarea type="text" id="tujuan_pembelajaran" name="tujuan_pembelajaran" class="form-control" rows="4">{{ $nilai->tujuan_pembelajaran }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="materi">Materi</label>
                                <textarea type="text" id="materi" name="materi" class="form-control" rows="4">{{ $nilai->materi }}</textarea>
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
                                    <th>No Induk</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No Telepon</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai->siswa as $key => $row)
                                    <tr>
                                        <input type="hidden" name="input[{{ $key }}][siswa_id]"
                                            value="{{ $row->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->no_induk }}</td>
                                        <td>{{ $row->nis }}</td>
                                        <td>{{ $row->nama_siswa }}</td>
                                        <td>{{ $row->jk }}</td>
                                        <td>{{ $row->telp }}</td>
                                        <td>
                                            <input type="text" placeholder="0" value="{{ $row->pivot->nilai }}"
                                                name="input[{{ $key }}][nilai]" class="form-control" required>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('nilai.index') }}" name="kembali" class="btn btn-default" id="back"><i
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

            $('#AddNilai').on('submit', function(e) {
                e.preventDefault();
                clearErrors();

                let formData = $(this).serialize();
                $.ajax({
                    type: 'PUT',
                    url: `{{ route('nilai.update', $nilai->id) }}`,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        toastr.success('Berhasil mengupdate nilai');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            displayErrors(errors);
                        }
                    }
                });
            })

            function clearErrors() {
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('textarea').removeClass('is-invalid');
            }

            function displayErrors(errors) {
                clearErrors();
                for (var field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        var messages = errors[field];
                        for (var i = 0; i < messages.length; i++) {
                            toastr.error(messages[i]);
                            $('input[name="' + field + '"]').addClass('is-invalid');
                            $('select[name="' + field + '"]').addClass('is-invalid');
                            $('textarea[name="' + field + '"]').addClass('is-invalid');
                        }


                    }
                }
            }
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
                    if (result) {
                        const tbody = document.querySelector('#AbsenSiswa tbody');
                        tbody.innerHTML = "";
                        $.each(result, function(index, val) {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <input type="hidden" name="input[${index}][siswa_id]" value="${val.id}">
                                <td>${index + 1}</td>
                                <td>${val.no_induk}</td>
                                <td>${val.nis}</td>
                                <td>${val.nama_siswa}</td>
                                <td>${val.jk}</td>
                                <td>${val.telp}</td>
                                <td>
                                    <input type="text" placeholder="0" name="input[${index}][nilai]" class="form-control" required>
                                </td>
                            `;
                            tbody.appendChild(row);
                        });
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
