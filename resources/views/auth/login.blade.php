<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SISFO SARPRAS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        :root {
            --primary-color: #7e57c2;
            --secondary-color: #f0f3f7;
        }
        body {
            background: linear-gradient(135deg, #f5f0ff 0%, #e6e6fa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(45deg, #7e57c2, #5e35b1);
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 0;
            background: linear-gradient(to right, #f0f3f7, #e9ecef);
            position: relative;
        }
        .logo-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(to right, #7e57c2, #5e35b1);
        }
        .logo-container img {
            max-width: 140px;
            max-height: 140px;
            transition: transform 0.3s ease;
        }
        .logo-container img:hover {
            transform: scale(1.05);
        }
        .form-control {
            background-color: #f8f9fa;
            border: 1px solid #e2e6ea;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background-color: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(126, 87, 194, 0.15);
        }
        .btn-primary {
            background: linear-gradient(45deg, #7e57c2, #5e35b1);
            border: none;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            opacity: 0.9;
        }
        .register-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .register-link:hover {
            color: #5e35b1;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="logo-container">
                        <img src="{{ asset('storage/images/taruna.png') }}" alt="Logo" class="img-fluid">
                    </div>
                    <div class="card-header">
                        <h4 class="mb-0">Login Admin</h4>
                    </div>
                    <div class="card-body p-4">
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email Anda" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password Anda" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                        </form>
                        <p class="text-center mt-3 mb-0">
                            Belum punya akun? <a href="{{ route('register') }}" class="register-link">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>