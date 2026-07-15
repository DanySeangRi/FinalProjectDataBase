<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            background: #F8FAFC;
        }

        .register-card {
            max-width: 450px;
            border-radius: 20px;
            border: 1px solid #f1f1f1;
        }

        .title {
            color: #F59E0B;
        }

        .logo {
            width: 100px;
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
            border-color: #ced4da;
            box-shadow: none;
        }

        .btn-register {
            background: #F59E0B;
            border: none;
        }

        .btn-register:hover {
            background: #D97706;
        }

        .password-btn {
            background: #F3F4F6;
            border-left: none;
        }
    </style>
</head>

<body>

<div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">

    <div class="w-100" style="max-width:450px;">

        <!-- Logo -->
        <img
            src="{{ asset('image/image.png') }}"
            alt="Logo"
            class="logo d-block mx-auto mb-3"
        >

        <!-- Header -->
        <div class="text-center mb-4">

            <h2 class="fw-bold title">
                Create Account
            </h2>

            <p class="text-muted">
                Join Angkor Travel today
            </p>

        </div>

        <!-- Card -->
        <div class="card register-card shadow-lg p-4">

            <form method="POST" action="{{ route('register') }}">

                @csrf

                <!-- Name -->
                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            First Name
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i data-lucide="user"></i>
                            </span>

                            <input
                                type="text"
                                class="form-control"
                                name="first_name"
                                value="{{ old('first_name') }}"
                                placeholder="Sophea"
                            >

                        </div>

                        @error('first_name')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Last Name
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i data-lucide="user"></i>
                            </span>

                            <input
                                type="text"
                                class="form-control"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                placeholder="Meas"
                            >

                        </div>

                        @error('last_name')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

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
                            class="form-control"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@email.com"
                        >

                    </div>

                    @error('email')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Phone -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Phone
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i data-lucide="phone"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+855 12 345 678"
                        >

                    </div>

                    @error('phone')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Password -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i data-lucide="lock"></i>
                        </span>

                        <input
                            id="password"
                            type="password"
                            class="form-control"
                            name="password"
                            placeholder="8+ characters"
                        >

                        <button
                            type="button"
                            class="btn password-btn border"
                            onclick="togglePassword('password')"
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

                <!-- Confirm Password -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Confirm Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i data-lucide="lock-keyhole"></i>
                        </span>

                        <input
                            id="confirmPassword"
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            placeholder="Repeat password"
                        >

                        <button
                            type="button"
                            class="btn password-btn border"
                            onclick="togglePassword('confirmPassword')"
                        >
                            <i data-lucide="eye"></i>
                        </button>

                    </div>

                </div>

                <!-- Terms -->
                <div class="mb-4">

                    <small class="text-muted">
                        I agree to the
                        <a href="#" class="text-decoration-none fw-semibold">
                            Terms &amp; Conditions
                        </a>
                    </small>

                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="btn btn-register text-white w-100 py-2 fw-semibold rounded-3"
                >
                    Create Account
                </button>

            </form>

            <!-- Footer -->
            <div class="text-center mt-4">

                <p class="text-muted mb-0">

                    Already have an account?

                    <a
                        href="{{ route('login') }}"
                        class="text-decoration-none fw-semibold"
                    >
                        Sign In
                    </a>

                </p>

            </div>

        </div>

    </div>

</div>

<script>
function togglePassword(id) {

    const input = document.getElementById(id);

    input.type =
        input.type === "password"
            ? "text"
            : "password";
}

lucide.createIcons();
</script>

</body>
</html>