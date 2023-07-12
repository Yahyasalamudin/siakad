@extends('template_backend.home')
@section('heading', 'Dashboard')
@section('page')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
    <div class="col-md-12" id="load_content">
        <div class="card card-primary">
            <div class="card-body">
                <table class="table table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th>Jam Pelajaran</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data-jadwal">
                        @php
                            $hari = date('w');
                            $jam_mulai = date('H:i:s');
                            $jam_selesai = date('H:i:s', strtotime('+10 minutes'));
                        @endphp
                        @if ($hari == 0)
                            <tr>
                                <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>
                                    Sekolah Libur!</td>
                            </tr>
                        @else
                            @if ($jadwal->count() > 0)
                                @foreach ($jadwal as $data)
                                    <tr>
                                        <td>{{ $data->jam_mulai . ' - ' . $data->jam_selesai }}</td>
                                        <td>
                                            <h5 class="card-text mb-0">{{ $data->mapel->nama_mapel }}</h5>
                                            <p class="card-text"><small
                                                    class="text-muted">{{ $data->guru->nama_guru }}</small>
                                            </p>
                                        </td>
                                        <td>{{ $data->kelas->nama_kelas }}</td>
                                        <td>
                                            @if ($data->jam_mulai <= $jam_mulai && $data->jam_selesai >= $jam_selesai)
                                                <a href="{{ route('absensi.harian', [
                                                    'kelas_id' => Crypt::encrypt($data->kelas->id),
                                                    'jadwal_id' => Crypt::encrypt($data->id),
                                                ]) }}"
                                                    class="btn btn-primary">
                                                    Absen Kehadiran
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target=".pindah-jadwal-{{ $data->id }}"> &nbsp; Pindah Jadwal
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <div class="modal fade bd-example-modal-lg pindah-jadwal-{{ $data->id }}"
                                        tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Permintaan Pindah Jadwal</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('pindah-jadwal') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="hidden" name="jadwal_id"
                                                                    value="{{ $data->id }}">
                                                                <div class="form-group">
                                                                    <label for="hari_id">Hari</label>
                                                                    <select id="hari_id" name="hari_id"
                                                                        class="form-control @error('hari_id') is-invalid @enderror select2bs4">
                                                                        <option value="">-- Pilih Hari --</option>
                                                                        @foreach ($days as $day)
                                                                            <option value="{{ $day->id }}">
                                                                                {{ $day->nama_hari }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jam_mulai">Jam Mulai</label>
                                                                    <input type='time' id="jam_mulai" name='jam_mulai'
                                                                        class="form-control @error('jam_mulai') is-invalid @enderror jam_mulai"
                                                                        placeholder="{{ Date('H:i') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="jam_selesai">Jam Selesai</label>
                                                                    <input type='time' id="jam_selesai"
                                                                        name='jam_selesai'
                                                                        class="form-control @error('jam_selesai') is-invalid @enderror"
                                                                        placeholder="{{ Date('H:i') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i>
                                                            &nbsp; Kembali</button>
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="nav-icon fas fa-save"></i> &nbsp;
                                                            Kirim Permintaan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan='5'
                                        style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Jadwal
                                        Anda
                                        Hari ini telah habis</td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-warning" style="min-height: 385px;">
            <div class="card-header">
                <h3 class="card-title" style="color: white;">
                    Pengumuman
                </h3>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    @if (!empty($pengumuman->isi))
                        {!! $pengumuman->isi !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Keterangan :
                </h3>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <table class="table" style="margin-top: -21px; margin-bottom: -10px;">
                        @foreach ($kehadiran as $data)
                            <tr>
                                <td>
                                    <div style="width:30px;height:30px;background:#{{ $data->color }}"></div>
                                </td>
                                <td>:</td>
                                <td>{{ $data->ket }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
