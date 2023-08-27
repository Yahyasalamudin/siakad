@php
    use Carbon\Carbon;
@endphp
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
                            <th>Hari</th>
                            <th>Jam Pelajaran</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            @if (auth()->user()->role == 'Guru')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="data-jadwal">
                        @php
                            $hari = date('w');
                            $jam_mulai = date('H:i:s', strtotime('+10 minutes'));
                            $jam_selesai = date('H:i:s', strtotime('-10 minutes'));
                        @endphp
                        {{-- @if ($hari == 0)
                            <tr>
                                <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>
                                    Sekolah Libur!</td>
                            </tr>
                        @else --}}
                        @if ($jadwal->count() > 0)
                            @foreach ($jadwal as $data)
                                @if ($data->status_permintaan == 1)
                                    @if ($data->tukar_jadwal->hari_id == $hari && $data->tukar_jadwal->jam_selesai >= $jam_selesai)
                                        <tr>
                                            <td>{{ $data->jadwal->hari->nama_hari }}</td>
                                            <td>{{ $data->jadwal->jam_mulai . ' - ' . $data->jadwal->jam_selesai }}</td>
                                            <td>
                                                <h5 class="card-text mb-0">{{ $data->mapel->nama_mapel }}</h5>
                                                <p class="card-text"><small
                                                        class="text-muted">{{ $data->guru->nama_guru }}</small>
                                                </p>
                                            </td>
                                            <td>{{ $data->kelas->nama_kelas }}</td>
                                            @if (auth()->user()->role == 'Guru')
                                                <td>
                                                    @if ($data->jam_mulai <= $jam_mulai && $data->jam_selesai >= $jam_selesai)
                                                        @php
                                                            $absen = $data->absen_guru->last();
                                                            $created_at = '';
                                                            
                                                            if (!empty($absen)) {
                                                                $created_at = Carbon::parse($absen->created_at);
                                                            }
                                                            
                                                            $today = Carbon::now();
                                                        @endphp

                                                        @if ($created_at != '')
                                                            @if ($created_at->isSameDay($today) && $created_at->isSameYear($today))
                                                                <span class="badge badge-success font-weight-normal p-3"
                                                                    style="font-size: 14px;">
                                                                    Absen Berhasil
                                                                </span>
                                                            @else
                                                                <a href="{{ route('absen.harian', [
                                                                    'kelas_id' => Crypt::encrypt($data->kelas->id),
                                                                    'jadwal_id' => Crypt::encrypt($data->id),
                                                                ]) }}"
                                                                    class="btn btn-primary">
                                                                    Absen Kehadiran
                                                                </a>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('absen.harian', [
                                                                'kelas_id' => Crypt::encrypt($data->kelas->id),
                                                                'jadwal_id' => Crypt::encrypt($data->id),
                                                            ]) }}"
                                                                class="btn btn-primary">
                                                                Absen Kehadiran
                                                            </a>
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @else
                                    @if ($data->hari_id == $hari && $data->jam_selesai >= $jam_selesai)
                                        <tr>
                                            <td>{{ $data->hari->nama_hari }}</td>
                                            <td>{{ $data->jam_mulai . ' - ' . $data->jam_selesai }}</td>
                                            <td>
                                                <h5 class="card-text mb-0">{{ $data->mapel->nama_mapel }}</h5>
                                                <p class="card-text"><small
                                                        class="text-muted">{{ $data->guru->nama_guru }}</small>
                                                </p>
                                            </td>
                                            <td>{{ $data->kelas->nama_kelas }}</td>
                                            @if (auth()->user()->role == 'Guru')
                                                <td>
                                                    @if ($data->jam_mulai <= $jam_mulai && $data->jam_selesai >= $jam_selesai)
                                                        {{-- @php
                                                        $absen = $data->absen_guru->last();
                                                        $created_at = '';
                                                        
                                                        if (!empty($absen)) {
                                                            $created_at = Carbon::parse($absen->created_at);
                                                        }
                                                        
                                                        $today = Carbon::now();
                                                    @endphp

                                                    @if ($created_at != '')
                                                        @if ($created_at->isSameDay($today) && $created_at->isSameYear($today))
                                                            -
                                                        @else
                                                            <a href="{{ route('absen.harian', [
                                                                'kelas_id' => Crypt::encrypt($data->kelas->id),
                                                                'jadwal_id' => Crypt::encrypt($data->id),
                                                            ]) }}"
                                                                class="btn btn-primary">
                                                                Absen Kehadiran
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('absen.harian', [
                                                            'kelas_id' => Crypt::encrypt($data->kelas->id),
                                                            'jadwal_id' => Crypt::encrypt($data->id),
                                                        ]) }}"
                                                            class="btn btn-primary">
                                                            Absen Kehadiran
                                                        </a>
                                                    @endif --}}

                                                        <a href="{{ route('absen.harian', [
                                                            'kelas_id' => Crypt::encrypt($data->kelas->id),
                                                            'jadwal_id' => Crypt::encrypt($data->id),
                                                        ]) }}"
                                                            class="btn btn-primary">
                                                            Absen Kehadiran
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                                            data-target=".pindah-jadwal-{{ $data->id }}"> &nbsp; Pindah
                                                            Jadwal
                                                        </button>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endif

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
                                            <form action="{{ route('tukar_jadwal') }}" method="post">
                                                @csrf
                                                @method('put')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <input type="hidden" name="jadwal_id"
                                                                value="{{ $data->id }}">
                                                            <div class="form-group">
                                                                <label for="tukar_jadwal_id">Daftar Jadwal</label>
                                                                <select id="tukar_jadwal_id" name="tukar_jadwal_id"
                                                                    class="form-control @error('tukar_jadwal_id') is-invalid @enderror select2bs4">
                                                                    <option value="">-- Pilih Jadwal Lain --
                                                                    </option>
                                                                    @foreach ($tukar_jadwal as $jadwal)
                                                                        @if ($jadwal->kelas_id == $data->kelas_id)
                                                                            <option value="{{ $jadwal->id }}">
                                                                                {{ $jadwal->mapel->nama_mapel .
                                                                                    ' - ' .
                                                                                    $jadwal->guru->nama_guru .
                                                                                    ' (' .
                                                                                    $jadwal->hari->nama_hari .
                                                                                    ', ' .
                                                                                    Carbon::parse($jadwal->jam_mulai)->format('g:i A') .
                                                                                    ' - ' .
                                                                                    Carbon::parse($jadwal->jam_selesai)->format('g:i A') .
                                                                                    ')' }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                                            class='nav-icon fas fa-arrow-left'></i>
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
                        {{-- @endif --}}
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
@endsection
