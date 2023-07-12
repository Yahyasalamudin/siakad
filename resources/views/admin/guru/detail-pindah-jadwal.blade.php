@extends('template_backend.home')
@section('heading', 'Pindah Jadwal Guru')
@section('page')
    <li class="breadcrumb-item active">Pindah Jadwal guru</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{-- <a href="{{ route('guru.mapel', Crypt::encrypt($data->mapel_id)) }}" class="btn btn-default btn-sm"><i
                        class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> --}}
            </div>
            <div class="card-body">
                <div class="row display-flex justify-content-between no-gutters ml-2 mb-2 mr-2">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Jadwal Awal</h5>
                                <p class="card-text mb-0">
                                    Mapel : {{ $data->jadwal->mapel->nama_mapel }}
                                </p>
                                <p class="card-text mb-0">
                                    Kelas : {{ $data->kelas->nama_kelas }}
                                </p>
                                <p class="card-text mb-0">
                                    Hari : {{ $data->jadwal->hari->nama_hari }}
                                </p>
                                <p class="card-text mb-0">
                                    Jam Mulai : {{ $data->jadwal->jam_mulai }}
                                </p>
                                <p class="card-text mb-0">
                                    Jam Selesai : {{ $data->jadwal->jam_selesai }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Permintaan Perpindahan Jadwal</h5>
                                <p class="card-text mb-0">
                                    Mapel : {{ $data->mapel->nama_mapel }}
                                </p>
                                <p class="card-text mb-0">
                                    Kelas : {{ $data->kelas->nama_kelas }}
                                </p>
                                <p class="card-text mb-0">
                                    Hari : {{ $data->hari->nama_hari }}
                                </p>
                                <p class="card-text mb-0">
                                    Jam Mulai : {{ $data->jam_mulai }}
                                </p>
                                <p class="card-text mb-0">
                                    Jam Selesai : {{ $data->jam_selesai }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ url('/permintaan/approve?id=' . $data->jadwal->id . '&id_request=' . $data->id) }}"
                            class="btn btn-primary float-right">Setujui</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#pindahJadwal").addClass("active");
    </script>
@endsection
