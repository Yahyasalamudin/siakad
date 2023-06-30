@extends('template_backend.home')
@section('heading', 'Absen Harian Guru')
@section('page')
    <li class="breadcrumb-item active">Absen Harian guru</li>
@endsection
@section('content')
    @php
        $no = 1;
    @endphp
    <form action="{{ route('absen.simpan') }}" method="post" class="col-md-12" enctype="multipart/form-data">
        @csrf
        <div class="d-flex">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Absen Harian Guru</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_guru">Nama Guru</label>
                            <input type="text" id="nama_guru" class="form-control" value="{{ auth()->user()->name }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="mapel">Mapel</label>
                            <input type="text" id="mapel" name="mapel" maxlength="5"
                                onkeypress="return inputAngka(event)"
                                class="form-control @error('mapel') is-invalid @enderror"
                                value="{{ auth()->user()->guru(auth()->user()->id_card)->mapel->nama_mapel }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="ruang">Ruangan</label>
                            <input type="text" id="ruang" name="ruang"
                                class="form-control @error('ruang') is-invalid @enderror">
                            {{-- <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}"> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 align-items-stretch">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Upload Foto</h3>
                    </div>
                    <div class="card-body">
                        <div class="ml-2 col-sm-12">
                            <div id="msg"></div>
                            <input type="file" name="foto" class="file" accept="image/*">
                            <div class="input-group my-3">
                                <input type="text" class="form-control" disabled placeholder="Upload File"
                                    id="file">
                                <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">Browse...</button>
                                </div>
                            </div>
                        </div>
                        <div class="ml-2 col-sm-6">
                            <img src="https://placehold.it/200x200" id="preview" style="width: 200px"
                                class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <table id="AbsenSiswa" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Nama Siswa</th>
                                <th class="col-3">
                                    Absen
                                    <button type="button" id="toggleCheckBtn" class="btn text-primary ml-2"
                                        style="cursor: pointer;" onclick="toggleCheckAll()">Check All</button>
                                </th>
                                <th class="col-3">Keterangan</th>
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
                                                id="check-{{ $data->id }}" onchange="toggleKeterangan(event)">
                                            <label class="custom-control-label" for="check-{{ $data->id }}"
                                                data-id={{ $data->id }}>Hadir</label>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="custom-select" id="keterangan-{{ $data->id }}">
                                            <option selected>Keterangan</option>
                                            <option>Hadir</option>
                                            <option>Sakit</option>
                                            <option>Ijin</option>
                                        </select>
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

        const toggleKeterangan = (e) => {
            const checkbox = e.target;
            const checkboxId = checkbox.id;
            const selectId = 'keterangan-' + checkboxId.split('-')[1];
            const selectElement = document.getElementById(selectId);

            if (checkbox.checked) {
                addOptionHadir(selectElement);
                selectElement.value = "Hadir";
                selectElement.setAttribute('disabled', true);
            } else {
                removeOptionHadir(selectElement);
                selectElement.selectedIndex = 0;
                selectElement.removeAttribute('disabled');
            }

        }

        function addOptionHadir(selectElement) {
            var optionExists = false;
            var options = selectElement.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].text === "Hadir") {
                    optionExists = true;
                    break;
                }
            }

            // Add the "Hadir" option if it doesn't exist
            if (!optionExists) {
                var optionElement = document.createElement("option");
                optionElement.text = "Hadir";
                selectElement.appendChild(optionElement);
            }
        }

        function removeOptionHadir(selectElement) {
            var optionExists = false;
            var options = selectElement.options;
            for (var i = 0; i < options.length; i++) {
                if (options[i].text === "Hadir") {
                    selectElement.remove(i);
                    break;
                }
            }
        }

        // checkbox
        function toggleCheckAll() {
            const toggleCheckBtn = document.getElementById("toggleCheckBtn");
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            if (toggleCheckBtn.textContent == "Check All") {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                    toggleCheckBtn.textContent = "Uncheck All";

                    const checkboxId = checkbox.id;
                    const selectId = 'keterangan-' + checkboxId.split('-')[1];
                    const selectElement = document.getElementById(selectId);
                    if (selectElement != null) {
                        addOptionHadir(selectElement);
                        selectElement.value = "Hadir";
                        selectElement.setAttribute('disabled', true);
                    }
                });
            } else {
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                    toggleCheckBtn.textContent = "Check All";

                    const checkboxId = checkbox.id;
                    const selectId = 'keterangan-' + checkboxId.split('-')[1];
                    const selectElement = document.getElementById(selectId);
                    if (selectElement != null) {
                        removeOptionHadir(selectElement);
                        selectElement.selectedIndex = 0;
                        selectElement.removeAttribute('disabled');
                    }
                });
            }
        }
    </script>
@endsection
