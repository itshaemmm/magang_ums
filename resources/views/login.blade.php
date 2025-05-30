<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/material-kit.css', 'resources/css/nucleo-icons.css', 'resources/css/nucleo-svg.css'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light min-vh-100 d-flex align-items-center justify-content-center">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="login-card card shadow-sm border border-2">
                    
                    <div class="card-header text-center">
                        <h4>Welcome To Jadwal Ruangan SIC</h4>
                        <h6 class="form-text fw-semibold">Masukkan Email dan Password Anda</h6>
                    </div>

                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control border border-2 shadow-sm" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control border border-2 shadow-sm" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn bg-gradient-dark">Login</button>
                            </div>
                        </form>
                    </div>

                    <hr class="horizontal dark">

                    <div class="card-footer text-center">
                        <small>Belum punya akun? <a href="/register">Daftar</a></small>
                    </div>
                    
                </div> <!-- end of card -->
            </div>
        </div>
    </div>

</body>
</html>
