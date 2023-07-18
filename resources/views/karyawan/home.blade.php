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
                            <th>Jam</th>
                            <th>Tempat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="data-jadwal">
                        @php
                            $hari = date('w');
                            $jam_mulai = date('H:i:s', strtotime('+10 minutes'));
                            $jam_selesai = date('H:i:s', strtotime('-10 minutes'));
                        @endphp
                        {{-- @if ($hari == 0) --}}
                        {{-- <tr>
                            <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>
                                Sekolah Libur!</td>
                        </tr> --}}
                        {{-- @else --}}
                        @if ($jadwal->count() > 0)
                            @foreach ($jadwal as $data)
                                <tr>
                                    <td>{{ $data->hari->nama_hari }}</td>
                                    <td>{{ $data->jam_mulai . ' - ' . $data->jam_selesai }}</td>
                                    <td>
                                        {{ $data->tempat }}
                                    </td>
                                    <td>
                                        @if ($data->jam_mulai <= $jam_mulai && $data->jam_selesai >= $jam_selesai)
                                            @php
                                                $absen = $data->absen_karyawan->first();
                                                $created_at = '';
                                                
                                                if (!empty($absen)) {
                                                    $created_at = Carbon::parse($absen->created_at);
                                                }
                                                $today = Carbon::now();
                                            @endphp

                                            @if ($created_at != '')
                                                @if ($created_at->isSameDay($today))
                                                    -
                                                @else
                                                    <a href="{{ route('karyawan.absen.harian', ['jadwal_id' => Crypt::encrypt($data->id)]) }}"
                                                        class="btn btn-primary">
                                                        Absen Kehadiran
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('karyawan.absen.harian', ['jadwal_id' => Crypt::encrypt($data->id)]) }}"
                                                    class="btn btn-primary">
                                                    Absen Kehadiran
                                                </a>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                                <div class="modal fade bd-example-modal-lg pindah-jadwal-{{ $data->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Permintaan Pindah Jadwal</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
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
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#JadwalKaryawan").addClass("active");
    </script>
@endsection
