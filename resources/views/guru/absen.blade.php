@extends('template_backend.home')
@section('heading', 'Absen Harian Guru')
@section('page')
    <li class="breadcrumb-item active">Absen Harian guru</li>
@endsection
@section('content')
    @php
        $no = 1;
    @endphp
    <form action="{{ route('absen.simpan') }}" method="post" class="col-md-12">
        <div class="d-flex">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Absen Harian Guru</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_card">Nomor ID Card</label>
                            <input type="text" id="id_card" name="id_card" maxlength="5"
                                onkeypress="return inputAngka(event)"
                                class="form-control @error('id_card') is-invalid @enderror"
                                value="{{ auth()->user()->id_card }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_guru">Nama Guru</label>
                            <input type="text" id="nama_guru" class="form-control" value="{{ auth()->user()->name }}"
                                readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 align-items-stretch">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Upload Foto</h3>
                    </div>
                    @csrf
                    <div class="card-body">
                        <div class="ml-2 col-sm-12">
                            <div id="msg"></div>
                            <form method="post" id="image-form">
                                <input type="file" name="img[]" class="file" accept="image/*">
                                <div class="input-group my-3">
                                    <input type="text" class="form-control" disabled placeholder="Upload File"
                                        id="file">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse...</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="ml-2 col-sm-6">
                            <img src="https://placehold.it/200x200" id="preview" name="image" style="width: 200px"
                                class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <table id="AbsenSiswa" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>
                                    Absen
                                    <button class="btn">
                                        <span class="ml-4 text-primary" id="toggleCheckBtn" onclick="toggleCheckAll()">Check
                                            All</span>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_siswa }}</td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="check-{{ $data->id }}">
                                            <label class="custom-control-label"
                                                for="check-{{ $data->id }}">Hadir</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-5 py-2 my-4">Selesai</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        // upload file preview
        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });
        $('input[type="file"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        // checkbox
        function toggleCheckAll() {
            const toggleCheckBtn = document.getElementById("toggleCheckBtn");
            console.log(toggleCheckBtn.textContent);
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            if (toggleCheckBtn.textContent == "Check All") {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                    toggleCheckBtn.textContent = "Uncheck All";
                });
            } else {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                    toggleCheckBtn.textContent = "Check All";
                });
            }
        }
    </script>
@endsection
