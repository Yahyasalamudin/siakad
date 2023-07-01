@extends('template_backend.home')
@section('heading', 'Detail Absensi')
@section('page')
    <li class="breadcrumb-item active">Detail Absensi</li>
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
                            <input type="text" id="nama_guru" class="form-control"
                                value="{{ $absensi->guru->nama_guru }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="mapel">Mapel</label>
                            <input type="text" id="mapel" name="mapel" maxlength="5"
                                onkeypress="return inputAngka(event)"
                                class="form-control @error('mapel') is-invalid @enderror"
                                value="{{ $absensi->guru->mapel->nama_mapel }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="ruang">Ruangan</label>
                            <input type="text" id="ruang" name="ruang"
                                class="form-control @error('ruang') is-invalid @enderror" value="{{ $absensi->ruang }}"
                                readonly>
                        </div>
                        @if ($absensi->guru_tamu != null)
                            <div class="form-group">
                                <label for="guru_tamu">Guru Tamu</label>
                                <input type="text" id="guru_tamu" value="{{ $absensi->guru_tamu }}" name="guru_tamu"
                                    class="form-control @error('guru_tamu') is-invalid @enderror"
                                    value="{{ $absensi->guru_tamu }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="agensi">Agensi</label>
                                <input type="text" id="agensi" name="agensi" value="{{ $absensi->agensi }}"
                                    class="form-control @error('agensi') is-invalid @enderror"
                                    value="{{ $absensi->agensi }}" readonly>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 align-items-stretch">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Upload Foto</h3>
                    </div>
                    <div class="card-body">
                        <div class="ml-2 col-sm-6">
                            <img src="{{ asset($absensi->foto) }}" id="preview" style="width: 300px"
                                alt="Foto Kegiatan - {{ $absensi->guru->nama_guru }}">
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
                                <th class="col-3">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->siswa->nama_siswa }}</td>
                                    <td>
                                        {{ $data->jenis_absen }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex py-5 justify-content-end">
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
