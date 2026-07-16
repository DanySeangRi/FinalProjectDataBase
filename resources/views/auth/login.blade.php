<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            background: #F8FAFC;
        }

        .login-card {
            max-width: 448px;
            border-radius: 20px;
            border: 1px solid #f1f1f1;
        }

        .input-group-text {
            background: #F3F4F6;
            border-right: none;
        }

        .form-control {
            background: #F3F4F6;
            border-left: none;
        }

        .form-control:focus {
            background: #F3F4F6;
            box-shadow: none;
            border-color: #ced4da;
        }

        .btn-login {
            background: #F59E0B;
            border: none;
        }

        .btn-login:hover {
            background: #D97706;
        }

        .logo {
            width: 64px;
        }

        .title {
            color: #F59E0B;
        }
    </style>
</head>

<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center">

    <div class="w-100" style="max-width:448px;">

        <!-- Logo -->
        <img
            src="{{ asset('image/image.png') }}"
            alt="Logo"
            class="logo d-block mx-auto mb-3"
        >

        <!-- Header -->
        <div class="text-center mb-4">
            <h2 class="fw-bold title">
                Welcome Back
            </h2>

            <p class="text-muted">
                Sign in to your Angkor Travel account
            </p>
        </div>

        <!-- Card -->
        <div class="card login-card shadow-lg p-4">

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <!-- Email -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Email
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i data-lucide="mail"></i>
                        </span>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                            placeholder="you@email.com"
                            required
                        >

                    </div>

                    @error('email')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Password -->
                <div class="mb-3">

                    <div class="d-flex justify-content-between">

                        <label class="form-label fw-semibold">
                            Password
                        </label>

                        <a href="#" class="small text-decoration-none">
                            Forgot Password?
                        </a>

                    </div>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i data-lucide="lock"></i>
                        </span>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="••••••••"
                            required
                        >

                        <button
                            class="btn btn-light border"
                            type="button"
                            onclick="togglePassword()"
                        >
                            <i data-lucide="eye"></i>
                        </button>

                    </div>

                    @error('password')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Remember -->
                <div class="form-check mb-4">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                    >

                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>

                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="btn btn-login text-white w-100 py-2 fw-semibold rounded-3"
                >
                    Sign In
                </button>

            </form>

            <!-- Divider -->
            <div class="d-flex align-items-center my-4">

                <hr class="grow">

                <span class="mx-3 text-muted small">
                    OR
                </span>

                <hr class="grow">

            </div>

            <!-- Register -->
            <div class="text-center">

                <p class="text-muted mb-0">

                    Don't have an account?

                    <a
                        href="{{ route('register') }}"
                        class="fw-semibold text-decoration-none"
                    >
                        Create Account
                    </a>

                </p>

            </div>

        </div>

    </div>

</div>

<script>

function togglePassword() {

    const input = document.getElementById('password');

    input.type =
        input.type === 'password'
            ? 'text'
            : 'password';
}

lucide.createIcons();

</script>

</body>
</html>