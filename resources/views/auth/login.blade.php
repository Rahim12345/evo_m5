<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df 0%, #1cc88a 100%);
            font-family: 'Nunito', sans-serif;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: #fff;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: #4e73df;
            border-bottom: none;
            padding: 1.5rem;
        }

        .card-body {
            background: #f8f9fc;
            padding: 2rem 3rem;
        }

        .form-control {
            border-radius: 10px;
            padding-left: 40px;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #4e73df;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #4e73df;
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3756c1;
        }

        .login-illustration {
            width: 100%;
            max-width: 120px;
            margin: 0 auto 15px auto;
            display: block;
        }

        .school-bg {
            background: url('https://cdn-icons-png.flaticon.com/512/3135/3135755.png') no-repeat center;
            background-size: 200px;
            opacity: 0.05;
            position: absolute;
            inset: 0;
        }
    </style>
</head>
<body>
<div class="container position-relative">
    <div class="school-bg"></div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Student"
                         class="login-illustration">
                    {{ __('Təhsil Sisteminə Daxil ol') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3 position-relative">
                            <i class="fa-solid fa-envelope input-icon"></i>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="E-poçt ünvanınızı daxil edin">
                            @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3 position-relative">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="current-password"
                                   placeholder="Şifrənizi daxil edin">
                            @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Yadda saxla') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-primary text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Şifrəni unutdun?') }}
                                </a>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa-solid fa-right-to-bracket me-2"></i> {{ __('Daxil ol') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
