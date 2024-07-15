@extends('template_backend.home')
@section('heading')
    Data Jadwal {{ $karyawan->role . ' ' . ucwords($karyawan->name) }}
@endsection
@section('page')
    <li class="breadcrumb-item active"><a href="{{ route('jadwal.karyawan.index', strtolower($karyawan->role)) }}">Jadwal
            {{ $karyawan->role }}</a></li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('jadwal.karyawan.index', strtolower($karyawan->role)) }}" class="btn btn-default btn-sm"><i
                        class="nav-icon fas fa-arrow-left"></i>
                    &nbsp; Kembali</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hari as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_hari }}</td>
                                <td>
                                    <a href="{{ route('jadwalkaryawan.show', ['id' => Crypt::encrypt($data->id), 'user_id' => Crypt::encrypt($karyawan->id)]) }}"
                                        class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus">
                                        </i> &nbsp;
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Hari</th>
                            <th>Tempat</th>
                            <th>Jam Kerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->hari->nama_hari }}</td>
                                <td>
                                    {{ $data->tempat }}
                                </td>
                                <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                                <td>
                                    <form action="{{ route('jadwalkaryawan.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('jadwalkaryawan.edit', Crypt::encrypt($data->id)) }}"
                                            class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp;
                                            Edit</a>
                                        <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i>
                                            &nbsp; Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>
@endsection
@section('script')
    <script>
        var role = "{{ $karyawan->role }}";

        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataJadwal" + role.toLowerCase()).addClass("active");
    </script>
@endsection
