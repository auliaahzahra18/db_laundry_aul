<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LaundryKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary mb-1">🧺 LaundryKu</h3>
                        <p class="text-muted small mb-0">Sistem Informasi Manajemen Laundry</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger py-2 small">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="admin@laundry.com" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Masuk</button>
                    </form>

                    <hr class="my-4">
                    <div class="small text-muted">
                        <strong>Akun Uji Coba:</strong><br>
                        Admin: <code>admin@laundry.com</code> / <code>password</code><br>
                        Kasir: <code>kasir@laundry.com</code> / <code>password</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>