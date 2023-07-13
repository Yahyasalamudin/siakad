@extends('template_backend.home')
@section('heading', 'Tukar Jadwal Guru')
@section('page')
    <li class="breadcrumb-item active">Tukar Jadwal guru</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Guru</th>
                            <th>Cek Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->guru->nama_guru }}</td>
                                <td>
                                    <a href="{{ route('request.show', Crypt::encrypt($data->guru->id)) }}"
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
