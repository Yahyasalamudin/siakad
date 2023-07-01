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
                            <input type="text" id="ruang" name="ruang" placeholder="Masukkan Ruangan"
                                value="{{ old('ruang') }}" class="form-control @error('ruang') is-invalid @enderror">
                            <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="request_guru_tamu" name="request_guru_tamu"
                                onclick="toggleInputGuruTamu(event)">
                            <label for="request_guru_tamu" class="ml-2">Request Guru Tamu</label>
                        </div>
                        <div class="form-group d-none">
                            <label for="guru_tamu">Guru Tamu</label>
                            <input type="text" id="guru_tamu" name="guru_tamu" placeholder="Masukkan Guru Tamu"
                                value="{{ old('guru_tamu') }}"
                                class="form-control @error('guru_tamu') is-invalid @enderror">
                        </div>
                        <div class="form-group d-none">
                            <label for="agensi">Agensi</label>
                            <input type="text" id="agensi" name="agensi" placeholder="Masukkan Agensi"
                                value="{{ old('agensi') }}" class="form-control @error('agensi') is-invalid @enderror">
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
                            @php
                                $siswa_id = 0;
                                $jenis_absen = 0;
                            @endphp
                            @foreach ($siswa as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama_siswa }}</td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="hidden" name="input[{{ $siswa_id++ }}][siswa_id]"
                                                value="{{ $data->id }}">
                                            <input type="checkbox" class="custom-control-input checkboxAbsensi"
                                                id="check-{{ $data->id }}" onchange="toggleKeterangan(event)">
                                            <label class="custom-control-label" for="check-{{ $data->id }}"
                                                data-id={{ $data->id }}>Hadir</label>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="custom-select" name="input[{{ $jenis_absen++ }}][jenis_absen]"
                                            required id="keterangan-{{ $data->id }}">
                                            <option selected value="">Keterangan</option>
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

        function toggleInputGuruTamu(e) {
            const guruTamu = document.getElementById("guru_tamu");
            const agensi = document.getElementById("agensi");

            if (e.target.checked) {
                guruTamu.parentElement.classList.remove('d-none');
                agensi.parentElement.classList.remove('d-none');
            } else {
                guruTamu.value = "";
                agensi.value = "";
                guruTamu.parentElement.classList.add('d-none');
                agensi.parentElement.classList.add('d-none');
            }
        }

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
            var checkboxes = document.getElementsByClassName('checkboxAbsensi');

            if (toggleCheckBtn.textContent == "Check All") {
                toggleCheckBtn.textContent = "Uncheck All";
                Array.from(checkboxes).forEach(function(checkbox) {
                    checkbox.checked = true;

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
                toggleCheckBtn.textContent = "Check All";
                Array.from(checkboxes).forEach(function(checkbox) {
                    checkbox.checked = false;

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
