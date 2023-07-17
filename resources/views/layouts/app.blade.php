<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistem Management SMK MULU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="shrotcut icon" href="{{ asset('img/favicon.ico') }}">
</head>

<body class="hold-transition login-page my-3"
    style="background-image: url('{{ asset('img/wallup.jpg') }}'); background-size: cover; background-attachment: fixed;">
    <div class="login-box">
        <div class="login-logo">
            <!--<img src="{{ asset('img/logosiakad.png') }}" width="100%" alt="">-->
            <h1 class="text-white">Sistem Managemen</h1>
        </div>

        <div class="login-logo" style="color: white;">
            @yield('page')
        </div>

        <div class="card">
            @yield('content')
        </div>

        <footer style="color: white;">
            <marquee>
                <strong>Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> &diams; <a href="http://piramidsoft.com/" style="color: white;">SMK
                        Muhammadiyah Lumajang</a>.
                </strong>
            </marquee>
        </footer>

        {{-- <div class="d-flex justify-content-center flex-wrap my-4">
            <button type="button" onclick="handleSelectRole(event)" data-role="admin"
                class="btn btn-info mx-2 mb-2">{{ __('Admin') }}
                &nbsp; <i class="nav-icon fas fa-user"></i></button>
            <button type="button" onclick="handleSelectRole(event)" data-role="guru"
                class="btn btn-dark mx-2 mb-2">{{ __('Guru') }}
                &nbsp; <i class="nav-icon fas fa-user"></i></button>
            <button type="button" onclick="handleSelectRole(event)" data-role="bk"
                class="btn btn-success mx-2 mb-2">{{ __('BK') }}
                &nbsp; <i class="nav-icon fas fa-user"></i></button>
            <button type="button" onclick="handleSelectRole(event)" data-role="cs"
                class="btn btn-success mx-2 mb-2">{{ __('CS') }}
                &nbsp; <i class="nav-icon fas fa-user"></i></button>
        </div> --}}
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(document).ready(function() {
            $('#role').change(function() {
                var kel = $('#role option:selected').val();
                if (kel == "Guru") {
                    $("#noId").addClass("mb-3");
                    $("#noId").html(`
              <input id="nomer" type="text" maxlength="5" onkeypress="return inputAngka(event)" placeholder="No Id Card" class="form-control @error('nomer') is-invalid @enderror" name="nomer" autocomplete="nomer">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-id-card"></span>
                </div>
              </div>
              `);
                    $("#pesan").html(`
              @error('nomer')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
                } else if (kel == "Siswa") {
                    $("#noId").addClass("mb-3");
                    $("#noId").html(`
              <input id="nomer" type="text" placeholder="No Induk Siswa" class="form-control" name="nomer" autocomplete="nomer">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-id-card"></span>
                </div>
              </div>
            `);
                    $("#pesan").html(`
              @error('nomer')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            `);
                } else {
                    $('#noId').removeClass("mb-3");
                    $('#noId').html('');
                }
            });
        });

        function inputAngka(e) {
            var charCode = (e.which) ? e.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
    @yield('script')

    @error('id_card')
        <script>
            toastr.error("Maaf User ini tidak terdaftar sebagai Guru SMKN 1 Jenangan Ponorogo!");
        </script>
    @enderror
    @error('guru')
        <script>
            toastr.error("Maaf Guru ini sudah terdaftar sebagai User!");
        </script>
    @enderror
    @error('no_induk')
        <script>
            toastr.error("Maaf User ini tidak terdaftar sebagai Siswa SMKN 1 Jenangan Ponorogo!");
        </script>
    @enderror
    @error('siswa')
        <script>
            toastr.error("Maaf Siswa ini sudah terdaftar sebagai User!");
        </script>
    @enderror
    @if (session('status'))
        <script>
            toastr.success("{{ Session('success') }}");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.error("{{ Session('error') }}");
        </script>
    @endif

</body>

</html>
