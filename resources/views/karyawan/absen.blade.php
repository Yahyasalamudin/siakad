@extends('template_backend.home')
@section('heading')
    Absen Harian {{ auth()->user()->role . ' ' . ucwords(auth()->user()->name) }}
@endsection
@section('page')
    <li class="breadcrumb-item active">Absen Harian {{ auth()->user()->role }}</li>
@endsection
@section('content')
    @php
        $no = 1;
    @endphp
    <form action="{{ route('karyawan.absen.simpan') }}" method="post" class="col-md-12" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Absen Harian {{ auth()->user()->role }}</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                        <div class="form-group">
                            <label for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" id="nama_karyawan" class="form-control" value="{{ auth()->user()->name }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input type="text" id="tempat" name="tempat" maxlength="5"
                                onkeypress="return inputAngka(event)"
                                class="form-control @error('tempat') is-invalid @enderror" value="{{ $jadwal->tempat }}"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" id="keterangan" name="keterangan"
                                class="form-control @error('keterangan') is-invalid @enderror"
                                value="{{ $jadwal->keterangan }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 align-items-stretch">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Upload Foto</h3>
                    </div>
                    <div class="card-body d-flex flex-column flex-md-row gap-4">
                        <div class="ml-2 mb-4 col-sm-6">
                            <input type="file" name="foto_awal" class="file" accept="image/*">
                            <img src="https://placehold.it/200x200" id="preview-awal" style="width: 300px"
                                class="img-thumbnail browse_foto_awal cursor-pointer">
                        </div>
                        <div class="ml-2 mb-4 col-sm-6">
                            <input type="file" name="foto_akhir" class="file" accept="image/*">
                            <img src="https://placehold.it/200x200" id="preview-akhir" style="width: 300px"
                                class="img-thumbnail browse_foto_akhir cursor-pointer">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5 py-2">Selesai</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        // upload file preview
        $(document).on("click", ".browse_foto_awal", function() {
            var file = $(this).parents().find('input[name="foto_awal"]');
            file.trigger("click");
        });
        $(document).on("click", ".browse_foto_akhir", function() {
            var file = $(this).parents().find('input[name="foto_akhir"]');
            file.trigger("click");
        });
        $('input[name="foto_awal"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview-awal").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
        $('input[name="foto_akhir"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("preview-akhir").src = e.target.result;
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
