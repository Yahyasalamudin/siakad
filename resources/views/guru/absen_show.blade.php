@extends('template_backend.home')
@section('heading', 'Absensi Guru')
@section('page')
    <li class="breadcrumb-item active">Absensi guru</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="get">
                    <div class="d-flex justify-content-end">
                        <div class="mb-3 col-md-3 ml-3 px-0">
                            <select id="status-absensi" name="status" class="form-control">
                                <option value="">Semua</option>
                                <option @if (request('status') == 'proses') selected @endif value="proses">Proses</option>
                                <option @if (request('status') == 'dikonfirmasi') selected @endif value="dikonfirmasi">Dikonfirmasi
                                </option>
                                <option @if (request('status') == 'ditolak') selected @endif value="ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="mb-3 ml-3 px-0">
                            <input type='date' value="{{ request('tanggal_awal') ?: now()->format('Y-m-d') }}"
                                id="tanggal_awal" name='tanggal_awal' class="form-control">
                        </div>
                        <div class="mb-3 ml-3 px-0">
                            <input type='date' value="{{ request('tanggal_akhir') ?: now()->format('Y-m-d') }}"
                                id="tanggal_akhir" name='tanggal_akhir' class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary ml-3 px-3">Filter</button>
                        </div>
                    </div>
                </form>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal Absensi</th>
                            {{-- <th>Keterangan</th> --}}
                            <th>Mapel</th>
                            <th>Cek Absensi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensi as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->created_at }}</td>
                                {{-- <td>
                                    @if ($data->keterangan == 'tepat_waktu')
                                        <span class="badge badge-pill badge-success p-3">
                                            Tepat Waktu
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-warning p-3">
                                            Terlambat
                                        </span>
                                    @endif
                                </td> --}}
                                <td>{{ $data->jadwal->mapel->nama_mapel ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('absen.detail', $data->id) }}" class="btn btn-info btn-sm"><i
                                            class="nav-icon fas fa-search-plus"></i> &nbsp;
                                        Detail
                                    </a>
                                </td>
                                <td>
                                    @if ($data->user_id == auth()->user()->id)
                                        @if ($data->status == 'dikonfirmasi')
                                            <div class="badge badge-success p-2">Dikonfirmasi</div>
                                        @elseif ($data->status == 'ditolak')
                                            <div class="badge badge-danger p-2">Ditolak</div>
                                        @else
                                            <div class="badge badge-warning p-2">Proses</div>
                                        @endif
                                    @else
                                        @if ($data->status == 'dikonfirmasi')
                                            <div class="badge badge-success p-2">Dikonfirmasi</div>
                                        @elseif ($data->status == 'ditolak')
                                            <div class="badge badge-danger p-2">Ditolak</div>
                                        @else
                                            <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal"
                                                data-target="#confirmAbsen-{{ $data->id }}">
                                                <i class="nav-icon fas fa-check"></i> &nbsp; Konfirmasi
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#rejectAbsen-{{ $data->id }}">
                                                <i class="nav-icon fas fa-times"></i> &nbsp; Tolak
                                            </button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="confirmAbsen-{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{ route('absen.confirm', $data->id) }}">
                                        @csrf
                                        @method('put')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin
                                                    mengonfirmasi
                                                    absensi?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">
                                                    &nbsp; Konfirmasi</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal fade" id="rejectAbsen-{{ $data->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="post" action="{{ route('absen.reject', $data->id) }}">
                                        @csrf
                                        @method('put')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menolak
                                                    absensi?
                                                </h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">
                                                    &nbsp; Tolak</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
