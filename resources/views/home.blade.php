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
                            $jam = date('H:i:s');
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
                                            {{-- @if ($data->jam_mulai <= $jam && $data->jam_selesai >= $jam) --}}
                                            <form action="{{ route('absen.harian') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="kelas_id" value="{{ $data->kelas->id }}">
                                                <input type="hidden" name="jadwal_id" value="{{ $data->id }}">
                                                <button class="btn btn-primary">
                                                    Absen Kehadiran
                                                </button>
                                            </form>
                                            {{-- @endif --}}
                                        </td>
                                    </tr>
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
                    {!! $pengumuman->isi !!}
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
@section('script')
    <script>
        $(document).ready(function() {
            setInterval(function() {
                var date = new Date();
                var hari = date.getDay();
                var h = date.getHours();
                var m = date.getMinutes();
                var s = date.getSeconds();
                h = (h < 10) ? "0" + h : h;
                m = (m < 10) ? "0" + m : m;
                s = (s < 10) ? "0" + s : s;
                var jam = h + ":" + m + ":" + s;

                if (hari == '0') {
                    $("#data-jadwal").html(
                        `<tr>
                            <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Sekolah Libur!</td>
                        </tr>`
                    );
                } else {
                    $.ajax({
                        type: "GET",
                        data: {
                            hari: hari,
                            jam: jam
                        },
                        dataType: "JSON",
                        url: "{{ url('/jadwal/sekarang') }}",
                        success: function(data) {
                            var html = "";
                            if (data.jadwalCount > 0) {
                                $.each(data.data, function(index, val) {
                                    html += "<tr>";
                                    html += "<td>" + val.jam_mulai + ' - ' + val
                                        .jam_selesai + "</td>";
                                    html += "<td><h5 class='card-text mb-0'>" + val
                                        .mapel +
                                        "</h5><p class='card-text'><small class='text-muted'>" +
                                        val.guru + "</small></p></td>";
                                    html += "<td>" + val.kelas + "</td>";
                                    if (val.jam_mulai <= jam &&
                                        val.jam_selesai >= jam) {
                                        html +=
                                            "<td><a href='#' class='btn btn-primary'>Absen Kehadiran</a></td>"
                                    } else {
                                        html += "<td></td>";
                                    }
                                    html += "</tr>"
                                })
                            } else {
                                html +=
                                    `<tr>
                                        <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Jadwal Anda
                                        Hari ini telah habis</td>
                                    </tr>`
                            }
                            $("#data-jadwal").html(html);
                        },
                        error: function() {}
                    });
                }
            }, 60 * 1000);
        });

        $("#Dashboard").addClass("active");
        $("#liDashboard").addClass("menu-open");
        $("#Home").addClass("active");
    </script>
@endsection
