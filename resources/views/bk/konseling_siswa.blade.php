@extends('template_backend.home')
@section('heading', 'Konseling Siswa')
@section('page')
    <li class="breadcrumb-item active">Konseling Siswa</li>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- general form elements -->
        <form method="post" id="AddKonseling" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Konseling Siswa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_konseling">Tanggal Konseling</label>
                                <input type="text" id="tgl_konseling" name="tgl_konseling" class="form-control"
                                    value="{{ Date('d-m-Y') }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tgl_konseling">Jenis Konseling</label>
                                <div class="d-flex align-items-center">
                                    <input type="radio" name="jenis_konseling" value="pribadi"
                                        id="jenis_konseling_pribadi" checked onclick="getJenisKonselingPribadi()">
                                    <label class="mx-2" for="jenis_konseling_pribadi">Pribadi</label><br>
                                    <input type="radio" name="jenis_konseling" value="kelompok"
                                        id="jenis_konseling_kelompok" onclick="getJenisKonselingKelompok()">
                                    <label class="mx-2" for="jenis_konseling_kelompok">Kelompok</label><br>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tgl_konseling">Kelas</label>
                                <select name="kelas" id="tingkat_kelas" class="form-control" onchange="getSiswaByKelas()">
                                    <option value="">Pilih Kelas</option>
                                    @foreach ($kelas as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="siswa">Nama Siswa</label>
                                <select name="siswa" id="siswa" class="form-control">
                                    <option value="">Pilih Siswa</option>
                                </select>
                            </div>
                            <button name="submit" class="btn btn-primary mt-4"><i class="nav-icon fas fa-save"></i> &nbsp;
                                Simpan</button>
                        </div>
                        <div class="col-md-6 align-items-stretch">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Upload Foto</h3>
                                </div>
                                <div class="card-body">
                                    <div class="ml-2 col-sm-12">
                                        <div id="msg"></div>
                                        <input type="file" name="foto" class="file" accept="image/*">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Upload File"
                                                id="file">
                                            <div class="input-group-append">
                                                <button type="button" class="browse btn btn-primary">Browse...</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-2 col-sm-6">
                                        <img src="https://placehold.it/200x200" id="preview" style="width: 200px"
                                            class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <table id="KonselingSiswa" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis Konseling</th>
                                    <th>No Induk</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Foto Kegiatan</th>
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
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            getKonselingSiswa();

            $('#back').click(function() {
                window.location = "{{ url('/') }}";
            });

            $('#AddKonseling').on('submit', function(e) {
                e.preventDefault();
                clearErrors();

                let formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('bk.store') }}',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        toastr.success('Berhasil menyimpan konseling');
                        window.location.href = response.redirect_url;
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

        // upload file preview
        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        function getJenisKonselingPribadi() {
            $("#siswa").parent().removeClass('d-none');
            getSiswaByKelas();
        }

        function getJenisKonselingKelompok() {
            $("#siswa").parent().addClass('d-none');
        }

        // fetch SiswaByKelas
        function getSiswaByKelas() {
            $.ajax({
                type: "GET",
                data: "kelas_id=" + $("#tingkat_kelas").val(),
                dataType: "JSON",
                url: "{{ url('/get-siswa') }}",
                success: function(result) {
                    $('#siswa').empty();
                    var option = $('<option value="">Pilih Siswa</option>');
                    $('#siswa').append(option);
                    if (result) {
                        $.each(result, function(index, val) {
                            var option = $('<option></option>').attr('value', val.id).text(val
                                .nama_siswa);
                            // Append the option to a select element
                            $('#siswa').append(option);
                        });
                    }
                },
                error: function(err) {
                    toastr.error("Errors 404!");
                },
                complete: function() {}
            });
        }

        function getKonselingSiswa() {
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "{{ url('/bk/konseling-siswa') }}",
                success: function(result) {
                    if (result) {
                        const tbody = document.querySelector('#KonselingSiswa tbody');
                        tbody.innerHTML = "";
                        $.each(result, function(index, val) {
                            const row = document.createElement('tr');
                            if (val.jenis_konseling == "pribadi") {
                                row.innerHTML = `
                                    <td>${val.id}</td>
                                    <td>${val.tgl_konseling}</td>
                                    <td>${val.jenis_konseling}</td>
                                    <td>${val.siswa.no_induk}</td>
                                    <td>${val.siswa.nis}</td>
                                    <td>${val.siswa.nama_siswa}</td>
                                    <td>${val.kelas.nama_kelas}</td>
                                `;
                            } else {
                                row.innerHTML = `
                                    <td>${val.id}</td>
                                    <td>${val.tgl_konseling}</td>
                                    <td>${val.jenis_konseling}</td>
                                    <td colspan="4" class="text-center">${val.kelas.nama_kelas}</td>
                                `;
                            }
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
