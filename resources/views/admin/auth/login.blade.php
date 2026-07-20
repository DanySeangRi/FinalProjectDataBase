<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login | Angkor Travel</title>


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>


    <style>
        body {

            min-height: 100vh;

            background:
                linear-gradient(135deg,
                    #dbeeff,
                    #f8fafc);

        }



        .login-wrapper {

            width: 100%;
            max-width: 430px;

        }



        .login-card {

            border: none;
            border-radius: 24px;

            padding: 32px;

            box-shadow:
                0 20px 45px rgba(15, 23, 42, 0.12);

        }



        .logo {

            width: 75px;
            height: 75px;
            object-fit: contain;

        }



        .title {

            color: #2563eb;
            font-weight: 800;

        }



        .subtitle {

            color: #64748b;

        }



        .admin-badge {

            display: inline-flex;
            align-items: center;
            gap: 6px;

            background: #dbeafe;
            color: #2563eb;

            padding: 6px 14px;

            border-radius: 999px;

            font-size: 13px;
            font-weight: 600;

            margin-bottom: 15px;

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

            border-color: #2563eb;

        }




        .btn-login {

            background: #2563eb;

            border: none;

            transition: .2s;

        }



        .btn-login:hover {

            background: #1d4ed8;

        }




        .btn-back {

            border: 1px solid #cbd5e1;

            color: #475569;

            background: white;

        }



        .btn-back:hover {

            background: #f1f5f9;

        }
    </style>


</head>



<body>



    <div class="container min-vh-100 d-flex justify-content-center align-items-center">


        <div class="login-wrapper">



            <!-- Logo -->

            <div class="text-center mb-4">


                <img src="{{ asset('image/image.png') }}" class="logo mb-3" alt="Logo">



                <div class="admin-badge">

                    <i data-lucide="shield-check"></i>

                    Admin Portal

                </div>



                <h2 class="title">
                    Welcome Admin
                </h2>



                <p class="subtitle">

                    Sign in to manage Angkor Travel

                </p>


            </div>





            <div class="card login-card">


                <form method="POST" action="{{ route('admin.auth.login.submit') }}">

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
                                placeholder="admin@email.com" required>


                        </div>


                        @error('email')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

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




                            <input id="password" type="password" name="password" class="form-control"
                                placeholder="••••••••" required>




                            <button type="button" class="btn btn-light border" onclick="togglePassword()">

                                <i data-lucide="eye"></i>


                            </button>


                        </div>



                        @error('password')

                            <small class="text-danger">

                                {{ $message }}

                            </small>

                        @enderror



                    </div>






                    <!-- Remember -->


                    <div class="form-check mb-4">


                        <input class="form-check-input" type="checkbox" name="remember" id="remember">



                        <label class="form-check-label" for="remember">

                            Remember me

                        </label>


                    </div>







                    <!-- Login Button -->


                    <button class="btn btn-login text-white w-100 py-2 rounded-3 fw-semibold">

                        <i data-lucide="log-in" class="me-2"></i>

                        Admin Sign In


                    </button>



                </form>






                <!-- Back -->


                <div class="text-center mt-4">


                    <a href="{{ route('login') }}" class="btn btn-back w-100 py-2 rounded-3 fw-semibold">

                        <i data-lucide="arrow-left" class="me-2"></i>

                        User Login


                    </a>


                </div>




            </div>



        </div>



    </div>





    <script>


        function togglePassword() {


            const input = document.getElementById("password");


            input.type =
                input.type === "password"
                    ? "text"
                    : "password";


        }



        lucide.createIcons();


    </script>



</body>

</html>