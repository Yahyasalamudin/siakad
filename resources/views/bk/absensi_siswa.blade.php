@extends('template_backend.home')
@section('heading', 'Dashboard')
@section('page')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="col-md-12" id="load_content">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <select class="form-control" id="pilih_kelas" onchange="getSiswaByKelas()">
                            <option value="">Pilih Kelas</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <select class="form-control" id="pilih_siswa"></select>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control" id="date-start" name="start"
                                    value="<?php echo date('d-m-Y'); ?>" />
                                <span class="p-1 px-3 bg-info b-0 text-white pt-2">To</span>
                                <input type="text" class="form-control" id="date-end" name="end"
                                    value="<?php echo date('d-m-Y'); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-12">
                        <button class="btn btn-info btn-block" type="button" onclick="getAbsensi()"><i
                                class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
                <table class="table table-striped table-hover text-center" id="data-absensi">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status Presensi</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($siswa as $data)
                            <tr>
                                <td>{{ $data['nama_siswa'] }}</td>
                                <td>{{ $data['kelas'] }}</td>
                                <td>
                                    @if (isset($data['jam_masuk']))
                                        {{ $data['jam_masuk'] }}
                                    @endif
                                </td>
                                <td>
                                    @if (isset($data['jam_pulang']))
                                        {{ $data['jam_pulang'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        getAllKelas();

        function getSiswaByKelas() {
            $.ajax({
                type: "GET",
                data: "id_kelas=" + $("#pilih_kelas").val(),
                dataType: "JSON",
                url: "{{ url('/bk/get-siswa') }}",
                success: function(result) {
                    $('#pilih_siswa').empty();
                    var option = $('<option value="">Pilih Siswa</option>');
                    $('#pilih_siswa').append(option);
                    if (result) {
                        $.each(result, function(index, val) {
                            var option = $('<option></option>').attr('value', val.id_siswa).text(
                                val
                                .nama_lengkap);
                            // Append the option to a select element
                            $('#pilih_siswa').append(option);
                        });
                    }
                },
                error: function(err) {
                    toastr.error("Errors 404!");
                },
                complete: function() {}
            });
        }

        function getAllKelas() {
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "{{ url('/bk/get-kelas') }}",
                success: function(result) {
                    $('#pilih_kelas').empty();
                    var option = $('<option value="">Pilih Kelas</option>');
                    $('#pilih_kelas').append(option);
                    if (result) {
                        $.each(result, function(index, val) {
                            var option = $('<option></option>').attr('value', val.id_kelas).text(
                                val
                                .tingkatan_kelas + " " + val.nama_kelas);
                            // Append the option to a select element
                            $('#pilih_kelas').append(option);
                        });
                    }
                },
                error: function(err) {
                    toastr.error("Terjadi Kesalahan. Coba lagi nanti.");
                },
                complete: function() {}
            });
        }

        function getAbsensi() {
            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: "{{ url('/bk/get-absensi-siswa') }}",
                data: {
                    pilih_kelas: $("#pilih_kelas").val(),
                    pilih_siswa: $("#pilih_siswa").val(),
                    date_start: $("#date_start").val(),
                    date_end: $("#date_end").val(),
                },
                success: function(result) {
                    if (result) {
                        const tbody = document.querySelector('#data-absensi tbody');
                        tbody.innerHTML = "";
                        $.each(result, function(index, val) {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td>${val.tanggal}</td>
                            <td>${val.nama_siswa}</td>
                                <td>${val.kelas}</td>
                                <td>
                                    ${val.status_presensi !== undefined ? val.status_presensi : 'Kosong'}
                                </td>
                                <td>
                                    ${val.jam_masuk !== undefined ? val.jam_masuk : ''}
                                </td>
                                <td>
                                    ${val.jam_pulang !== undefined ? val.jam_pulang : ''}
                                </td>
                            `;
                            tbody.appendChild(row);
                        });
                    }
                },
                error: function() {
                    toastr.error("Terjadi Kesalahan. Coba lagi nanti.");
                },
                complete: function() {}
            });
        }
    </script>
@endsection
