@extends('template_backend.home')
@section('heading')
    Data {{ $role }}
@endsection
@section('page')
    <li class="breadcrumb-item active"><a href="{{ route('karyawan.all', $role) }}">Absen
            {{ $role }}</a></li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    <a href="{{ route('absensikaryawan.index', ['user_id' => Crypt::encrypt($data->id)]) }}"
                                        class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus">
                                        </i> &nbsp;
                                        Detail Absensi
                                    </a>
                                    <a href="{{ route('aktivitas-tambahan.index', ['user_id' => Crypt::encrypt($data->id)]) }}"
                                        class="btn btn-secondary btn-sm"><i class="nav-icon fas fa-search-plus">
                                        </i> &nbsp;
                                        Detail Aktivitas Tambahan
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
        var role = "{{ $role }}";
        $("#RekapAbsen" + role).addClass("active");
    </script>
@endsection
