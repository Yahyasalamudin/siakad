@extends('template_backend.home')
@section('heading')
    Absensi {{ $karyawan->role }}
@endsection
@section('page')
    <li class="breadcrumb-item active">Absensi {{ $karyawan->role }}</li>
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
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th>Pukul</th>
                            <th>Kegiatan</th>
                            <th>Foto Awal</th>
                            <th>Foto Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absen_karyawan as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->created_at->format('Y-m-d') }}</td>
                                <td>{{ $data->absen_karyawan->hari->nama_hari }}</td>
                                <td>{{ $data->created_at->format('H:i') }}</td>
                                <td>{{ $data->keterangan }}</td>
                                <td>
                                    <img src="{{ asset($data->foto_awal) }}" id="preview" style="width: 100px"
                                        alt="Foto Kegiatan - {{ $data->name }}">
                                </td>
                                <td>
                                    <img src="{{ asset($data->foto_akhir) }}" id="preview" style="width: 100px"
                                        alt="Foto Kegiatan - {{ $data->name }}">
                                </td>
                                <td>
                                    @if ($data->user_id == auth()->user()->id || auth()->user()->role == 'Admin')
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
                                    <form method="post" action="{{ route('absensikaryawan.confirm', $data->id) }}">
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
                                    <form method="post" action="{{ route('absensikaryawan.reject', $data->id) }}">
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
        // $("#status-absensi").on('change', function() {
        //     let table = $("#example1").DataTable();
        //     let searchValue = $(this).val().toLowerCase();
        //     table.search(searchValue).draw();

        // if (table.page.info().recordsDisplay > 0) {
        //     if (searchValue === "dikonfirmasi") {
        //         $("#example1 tbody tr td:last-child").html(
        //             '<div class="badge badge-success p-2">Dikonfirmasi</div>');
        //     } else if (searchValue === "ditolak") {
        //         $("#example1 tbody tr td:last-child").html('<div class="badge badge-danger p-2">Ditolak</div>');
        //     } else {
        //         $("#example1 tbody tr td:last-child").html(`    
    //         <div class="d-flex gap-2">
    //             <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#confirmAbsen">
    //                 <i class="nav-icon fas fa-check"></i> &nbsp; Konfirmasi
    //             </button>
    //             <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectAbsen">
    //                 <i class="nav-icon fas fa-times"></i> &nbsp; Tolak
    //             </button>
    //         </div>
    //     `);
        //     }
        // }

        // var filteredData = table
        //     .column(7)
        //     .data()
        //     .filter(function(value, index) {
        //         console.log(value.toLowerCase().includes($("#status-absensi").val()));
        //         return value.toLowerCase().includes($("#status-absensi").val());
        //     }).draw();
        // })

        function getCreatePaket() {
            $("#judul").text('Tambah Aktivitas');
            $('#id').val('');
            $('#form_ket').html('');
            $('#form_ket').html(`
        <label for="kegiatan">Kegiatan</label>
        <input type='text' id="kegiatan" name='kegiatan' class="form-control @error('kegiatan') is-invalid @enderror" placeholder="{{ __('Kegiatan') }}">
        <label for="foto">Foto</label>
        <input type='file' id="foto" name='foto' class="form-control @error('foto') is-invalid @enderror" placeholder="{{ __('foto') }}">
      `);
        }

        function getEditPaket(id) {
            var parent = id;
            var form_ket = (`
                  <label for="ket">Nama Paket</label>
        <input type='text' id="ket" name='ket' class="form-control @error('ket') is-invalid @enderror" placeholder="{{ __('Nama Paket') }}">
                `);
            $.ajax({
                type: "GET",
                data: "id=" + parent,
                dataType: "JSON",
                url: "{{ url('/paket/edit/json') }}",
                success: function(result) {
                    // console.log(result);
                    if (result) {
                        $.each(result, function(index, val) {
                            $("#judul").text('Edit Data Paket : ' + val.ket);
                            $('#form_ket').html('');
                            $("#form_ket").append(form_ket);
                            $('#id').val(val.id);
                            $('#ket').val(val.ket);
                        });
                    }
                },
                error: function() {
                    toastr.error("Errors 404!");
                },
                complete: function() {}
            });
        }

        var role = "{{ $karyawan->role }}";
        $("#RekapAbsen" + role).addClass("active");
    </script>
@endsection
