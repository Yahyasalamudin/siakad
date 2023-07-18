@extends('template_backend.home')
@section('heading', 'Absensi Guru')
@section('page')
    <li class="breadcrumb-item active">Absensi guru</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Absensi</th>
                            {{-- <th>Keterangan</th> --}}
                            <th>Mapel</th>
                            <th>Cek Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensi as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->created_at }}</td>
                                {{-- <td>
                                    @if ($data->keterangan == 'tepat_waktu')
                                        <span class="badge badge-pill badge-success p-3">
                                            Tepat Waktu
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-warning p-3">
                                            Terlambat
                                        </span>
                                    @endif
                                </td> --}}
                                <td>{{ $data->jadwal->mapel->nama_mapel }}</td>
                                <td>
                                    <a href="{{ route('absen.detail', Crypt::encrypt($data->jadwal_id)) }}"
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
        $("#AbsensiGuru").addClass("active");
    </script>
@endsection
