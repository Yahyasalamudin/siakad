@extends('template_backend.home')
@section('heading')
    Data User @foreach ($role as $d => $data)
        {{ $d }}
    @endforeach
@endsection
@section('page')
    <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">User</a></li>
    @foreach ($role as $d => $data)
        <li class="breadcrumb-item active">{{ $d }}</li>
    @endforeach
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('user.index') }}" class="btn btn-default btn-sm"><i
                            class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
                </h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Email</th>
                            @foreach ($role as $d => $data)
                                @if ($d == 'Guru')
                                    <th>No Id Card</th>
                                @elseif ($d == 'Siswa')
                                    <th>No Induk Siswa</th>
                                @elseif ($d == 'BK')
                                    <th>Tingkatan Kelas</th>
                                @endif
                            @endforeach
                            {{-- <th>Tanggal Register</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($user->count() > 0)
                            @foreach ($user as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-capitalize">{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    @if ($data->role == 'Siswa')
                                        <td>{{ $data->no_induk }}</td>
                                    @elseif ($data->role == 'Guru')
                                        <td>{{ $data->id_card }}</td>
                                    @elseif ($data->role == 'BK')
                                        <td>
                                            Kelas {{ $data->tingkatan_kelas }}
                                            <button type="button" class="btn" data-toggle="modal"
                                                data-target=".edit-kelas-{{ $data->id }}">
                                                <i class="fas fa-edit ml-2 text-primary"></i>
                                            </button>
                                        </td>
                                    @endif
                                    {{-- <td>{{ $data->created_at->format('l, d F Y') }}</td> --}}
                                    <td>
                                        <form action="{{ route('user.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i>
                                                &nbsp; Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade bd-example-modal-md edit-kelas-{{ $data->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Data User</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('bk/edit-kelas/' . $data->id) }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="tingkatanKelas">
                                                                <label for="tingkatan_kelas">Tingkatan Kelas</label><select
                                                                    id="tingkatan_kelas" type="text"
                                                                    class="form-control @error('tingkatan_kelas') is-invalid @enderror "
                                                                    name="tingkatan_kelas"
                                                                    value="{{ old('tingkatan_kelas') }}"
                                                                    autocomplete="tingkatan_kelas">
                                                                    <option value="">-- Select
                                                                        {{ __('Tingkatan Kelas') }} --</option>
                                                                    <option
                                                                        @if ($data->tingkatan_kelas == '10') selected @endif
                                                                        value="10">Kelas 10</option>
                                                                    <option
                                                                        @if ($data->tingkatan_kelas == '11') selected @endif
                                                                        value="11">Kelas 11</option>
                                                                    <option
                                                                        @if ($data->tingkatan_kelas == '12') selected @endif
                                                                        value="12">Kelas 12</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                                        class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
                                                <button type="submit" class="btn btn-primary"><i
                                                        class="nav-icon fas fa-save"></i> &nbsp;
                                                    Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <tr>
                                <td colspan='5'
                                    style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Silahkan
                                    Buat
                                    Akun Terlebih Dahulu!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataUser").addClass("active");
    </script>
@endsection
