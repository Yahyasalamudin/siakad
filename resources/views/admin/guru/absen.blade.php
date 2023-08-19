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
                            <th>Nama Guru</th>
                            <th>Cek Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guru as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_guru }}</td>
                                <td>
                                    <a href="{{ route('absen.show', $data->id) }}" class="btn btn-info btn-sm"><i
                                            class="nav-icon fas fa-search-plus"></i> &nbsp; Detail
                                        Absensi
                                    </a>
                                    @php
                                        $user = \App\User::where('id_card', $data->id_card)->first();
                                    @endphp
                                    @if ($user)
                                        <a href="{{ route('aktivitas-tambahan.index', ['user_id' => Crypt::encrypt($user->id)]) }}"
                                            class="btn btn-secondary btn-sm"><i class="nav-icon fas fa-search-plus">
                                            </i> &nbsp;
                                            Detail Aktivitas Tambahan
                                        </a>
                                    @endif
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
