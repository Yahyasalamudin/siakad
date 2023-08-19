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
                                    Nama Guru : {{ $data->jadwal->guru->nama_guru }}
                                </p>
                                <p class="card-text mb-0">
                                    Mapel : {{ $data->jadwal->mapel->nama_mapel }}
                                </p>
                                <p class="card-text mb-0">
                                    Kelas : {{ $data->jadwal->kelas->nama_kelas }}
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
                    <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-exchange-alt" style="font-size: 24px;"></i>
                        <div class="d-block float-right my-3">
                            @if ($data->status_permintaan == 1)
                                <span class="font-weight-bold text-success">Disetujui oleh {{ $data->user->name }}</span>
                            @else
                                <span class="font-weight-bold text-danger">Ditolak oleh {{ $data->user->name }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Jadwal Tukar</h5>
                                <p class="card-text mb-0">
                                    Nama Guru : {{ $data->tukar_jadwal->guru->nama_guru }}
                                </p>
                                <p class="card-text mb-0">
                                    Mapel : {{ $data->tukar_jadwal->mapel->nama_mapel }}
                                </p>
                                <p class="card-text mb-0">
                                    Kelas : {{ $data->tukar_jadwal->kelas->nama_kelas }}
                                </p>
                                <p class="card-text mb-0">
                                    Hari : {{ $data->tukar_jadwal->hari->nama_hari }}
                                </p>
                                <p class="card-text mb-0">
                                    Jam Mulai : {{ $data->tukar_jadwal->jam_mulai }}
                                </p>
                                <p class="card-text mb-0">
                                    Jam Selesai : {{ $data->tukar_jadwal->jam_selesai }}
                                </p>
                            </div>
                        </div>
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
