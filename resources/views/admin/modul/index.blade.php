@extends('template_backend.home')
@section('heading', 'Modul')
@section('page')
    <li class="breadcrumb-item active">Modul</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="get">
                    <div class="d-flex justify-content-between">
                        <div class="mb-3 col-md-3 px-0">
                            <select id="guru" type="text" class="form-control select2bs4" name="guru"
                                autocomplete="guru" onchange="getMapelGuru()">
                                <option value="">Pilih Guru</option>
                                @foreach ($guru as $item)
                                    <option @if (request('guru') == $item->id) selected @endif value="{{ $item->id }}">
                                        {{ $item->nama_guru }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="mb-3 col-md-4 ml-3 px-0">
                                <select id="mapel" name="mapel" class="form-control">
                                    <option value="">Pilih Mapel</option>
                                </select>
                            </div>
                            <div class="mb-3 ml-3 px-0">
                                <input type='date' value="{{ request('tanggal_awal') ?: now()->format('Y-m-d') }}"
                                    id="tanggal_awal" name='tanggal_awal' class="form-control">
                            </div>
                            <div class="mb-3 ml-3 px-0">
                                <input type='date' value="{{ request('tanggal_akhir') ?: now()->format('Y-m-d') }}"
                                    id="tanggal_akhir" name='tanggal_akhir' class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ml-3 px-3">Filter</button>
                            </div>
                        </div>
                </form>
            </div>
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tahun</th>
                        <th>Nama Guru</th>
                        <th>Mapel</th>
                        <th>Semester</th>
                        <th>File Name</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modul as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>{{ $data->guru->nama_guru }}</td>
                            <td>{{ $data->mapel->nama_mapel }}</td>
                            <td>{{ $data->semester }}</td>
                            <td>{{ $data->file_modul }}</td>
                            <td class="d-flex">
                                <a href="{{ route('modul.show_file', Crypt::encrypt($data->id)) }}" target="_blank"
                                    class="btn btn-info btn-sm mr-2"><i class="nav-icon fas fa-search-plus"></i>
                                    &nbsp;
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

@endsection
@section('script')
    <script>
        $("#DataModul").addClass("active");

        $("document").ready(function() {
            getMapelGuru();
        })

        function getMapelGuru() {
            let guru = document.getElementById('guru');
            let mapel = document.getElementById('mapel');

            if (!guru.value)
                return;

            $.ajax({
                type: "GET",
                dataType: "JSON",
                url: `{{ url('/modul-guru/get-mapel-guru/${guru.value}') }}`,
                success: function(result) {
                    if (result) {
                        $('#mapel').empty();
                        var option = $('<option value="">-- Pilih Mapel --</option>');
                        $('#mapel').append(option);
                        if (result) {
                            $.each(result, function(index, val) {
                                var option = $('<option></option>')
                                    .attr('value', val.id).text(
                                        val
                                        .nama_mapel)
                                    .prop('selected', ("{{ request('mapel') }}" == val.id));
                                $('#mapel').append(option);
                            });
                        }
                    } else {
                        toastr.error("Gagal mengambil data mapel.");
                    }
                },
                error: function(e) {
                    toastr.error("Terjadi kesalahan. Coba lagi nanti.");
                },
                complete: function() {}
            });
        }
    </script>
@endsection
