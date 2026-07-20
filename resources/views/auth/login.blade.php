<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Angkor Travel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>


    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg,
                    #fff7ed,
                    #f8fafc);
        }


        .login-wrapper {
            width: 100%;
            max-width: 430px;
        }


        .login-card {

            border-radius: 24px;
            border: none;
            padding: 32px;

            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.08);

        }


        .logo {

            width: 75px;
            height: 75px;
            object-fit: contain;

        }


        .title {

            color: #f59e0b;
            font-weight: 800;

        }


        .subtitle {

            color: #64748b;

        }



        .input-group-text {

            background: #f8fafc;
            border-right: none;
            color: #94a3b8;

        }


        .form-control {

            background: #f8fafc;
            border-left: none;

        }


        .form-control:focus {

            background: #f8fafc;
            box-shadow: none;
            border-color: #f59e0b;

        }



        .btn-login {

            background: #f59e0b;
            border: none;

        }


        .btn-login:hover {

            background: #d97706;

        }



        .btn-admin {

            border: 1px solid #f59e0b;
            color: #d97706;
            background: white;

        }


        .btn-admin:hover {

            background: #fff7ed;
            color: #b45309;

        }
    </style>

</head>


<body>


    <div class="container min-vh-100 d-flex justify-content-center align-items-center">


        <div class="login-wrapper">


            <!-- Logo -->

            <div class="text-center mb-4">

                <img src="{{ asset('image/image.png') }}" class="logo mb-3">


                <h2 class="title">
                    Welcome Back
                </h2>


                <p class="subtitle">
                    Sign in to your Angkor Travel account
                </p>


            </div>




            <div class="card login-card">


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


                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                placeholder="you@email.com" required>

                        </div>


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


                            <input id="password" type="password" name="password" class="form-control"
                                placeholder="••••••••" required>


                            <button class="btn btn-light border" type="button" onclick="togglePassword()">

                                <i data-lucide="eye"></i>

                            </button>


                        </div>


                    </div>




                    <!-- Remember -->


                    <div class="form-check mb-4">

                        <input class="form-check-input" type="checkbox" name="remember">

                        <label class="form-check-label">

                            Remember me

                        </label>


                    </div>




                    <!-- User Login -->


                    <button class="btn btn-login text-white w-100 py-2 rounded-3 fw-semibold">

                        Sign In

                    </button>



                </form>




                <div class="text-center my-3 text-muted small">
                    OR
                </div>




                <!-- Admin Login Button -->


                <a href="{{ route('admin.auth.login') }}" class="btn btn-admin w-100 py-2 rounded-3 fw-semibold">

                    <i data-lucide="shield-check" class="me-2"></i>

                    Admin Login

                </a>




                <div class="text-center mt-4">


                    <span class="text-muted">
                        Don't have an account?
                    </span>


                    <a href="{{ route('register') }}" class="fw-semibold text-decoration-none text-warning">

                        Create Account

                    </a>


                </div>



            </div>


        </div>


    </div>




    <script>


        function togglePassword() {

            const password =
                document.getElementById("password");


            password.type =
                password.type === "password"
                    ? "text"
                    : "password";

        }



        lucide.createIcons();


    </script>


</body>

</html>