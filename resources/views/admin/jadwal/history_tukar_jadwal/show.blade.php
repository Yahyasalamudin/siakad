@extends('template_backend.home')
@section('heading', 'Pindah Jadwal Guru')
@section('page')
    <li class="breadcrumb-item active">Pindah Jadwal guru</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Cek Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->jadwal->mapel->nama_mapel }}</td>
                                <td>{{ $data->jadwal->kelas->nama_kelas }}</td>
                                <td>
                                    <a href="{{ route('jadwal.history_tukar_jadwal.detail', Crypt::encrypt($data->id)) }}"
                                        class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#pindahJadwal").addClass("active");
    </script>
@endsection
