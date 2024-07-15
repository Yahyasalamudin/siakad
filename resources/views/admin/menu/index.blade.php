@extends('template_backend.home')
@section('heading', 'Menu User')
@section('page')
    <li class="breadcrumb-item active">Menu User</li>
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route('guru.import_excel') }}" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h5 class="modal-title">Petunjuk :</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul>
                                            <li>rows 1 = nama guru</li>
                                            <li>rows 2 = nipm guru</li>
                                            <li>rows 3 = jenis kelamin</li>
                                            <li>rows 4 = mata pelajaran</li>
                                        </ul>
                                    </div>
                                </div>
                                <label>Pilih file excel</label>
                                <div class="form-group">
                                    <input type="file" name="file" required="required">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="dropTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="{{ route('guru.deleteAll') }}">
                        @csrf
                        @method('delete')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Sure you drop all data?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cencel</button>
                                <button type="submit" class="btn btn-danger">Drop</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Hak Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->role }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target=".hak-akses-{{ $data->id }}">
                                        <i class="nav-icon fas fa-edit"></i> &nbsp; Atur Hak Akses
                                    </button>
                                </td>
                            </tr>

                            <!-- Extra large modal -->
                            <div class="modal fade bd-example-modal-lg hak-akses-{{ $data->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="judul-jadwal">Hak Akses</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        @foreach ($menu_all as $menu)
                                                            @if ($menu->route != null && $menu->menu_id == null)
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="menu-{{ $data->id }}-{{ $menu->id }}"
                                                                            onchange="updateHakAkses(event)"
                                                                            data-menu-id="{{ $menu->id }}"
                                                                            data-role-id="{{ $data->id }}"
                                                                            @if ($data->menu()->pluck('user_menus.id')->contains($menu->id)) checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="menu-{{ $data->id }}-{{ $menu->id }}">
                                                                            {{ $menu->title }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @elseif ($menu->route == null)
                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="menu-{{ $data->id }}-{{ $menu->id }}"
                                                                            onchange="updateHakAkses(event)"
                                                                            data-menu-id="{{ $menu->id }}"
                                                                            data-role-id="{{ $data->id }}"
                                                                            @if ($data->menu()->pluck('user_menus.id')->contains($menu->id)) checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="menu-{{ $data->id }}-{{ $menu->id }}">
                                                                            {{ $menu->title }}
                                                                        </label>
                                                                    </div>
                                                                    @foreach ($menu->sub_menu as $sub_menu)
                                                                        <div class="form-check ml-3 mt-1">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                id="submenu-{{ $data->id }}-{{ $sub_menu->id }}"
                                                                                onchange="updateHakAkses(event)"
                                                                                data-menu-id="{{ $sub_menu->id }}"
                                                                                data-role-id="{{ $data->id }}"
                                                                                @if ($data->menu()->pluck('user_menus.id')->contains($sub_menu->id)) checked @endif>
                                                                            <label class="form-check-label"
                                                                                for="submenu-{{ $data->id }}-{{ $sub_menu->id }}">
                                                                                {{ $sub_menu->title }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                                                        class="nav-icon fas fa-arrow-left"></i>
                                                    &nbsp; Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // function checkMenu() {
        //     console.log($(`input[data-menu-id=${menu_id}]`));
        //     // $(`input[data-menu-id=${menu_id}]`).prop('checked', true);
        // }

        function updateHakAkses(e) {
            const menu_id = e.target.getAttribute('data-menu-id');
            const role_id = e.target.getAttribute('data-role-id');

            let url = "{{ route('admin.update-menu', ':role_id') }}";
            url = url.replace(':role_id', role_id);

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    'menu_id': menu_id,
                },
                success: function(result) {
                    if (result.success) {
                        toastr.success(result.success);
                    }
                },
                error: function() {
                    toastr.error('Terjadi kesalahan.');
                }
            })
        }
    </script>

@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataGuru").addClass("active");
    </script>
@endsection
