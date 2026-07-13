<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-light">


  <div class="min-vh-100 d-flex align-items-center justify-content-center px-3">


    <div class="card shadow-lg border-0 p-4" style="max-width:450px;width:100%;border-radius:20px;">


      <!-- Header -->
      <div class="text-center mb-4">

        <h1 class="fw-bold">
          Create Account
        </h1>

        <p class="text-muted small">
          Register to manage your bookings
        </p>

      </div>



      <form method="POST" action="{{ route('register') }}" class="d-grid gap-3">

        @csrf


        <!-- First Name + Last Name -->

        <div class="row">


          <div class="col-md-6">

            <label class="form-label small fw-medium">
              First Name
            </label>


            <div class="input-group">

              <span class="input-group-text bg-white">
                <i data-lucide="user"></i>
              </span>


              <input type="text" name="first_name" class="form-control" placeholder="John"
                value="{{ old('first_name') }}" required>


            </div>


            @error('first_name')
              <div class="text-danger small">
                {{ $message }}
              </div>
            @enderror


          </div>




          <div class="col-md-6">

            <label class="form-label small fw-medium">
              Last Name
            </label>


            <div class="input-group">

              <span class="input-group-text bg-white">
                <i data-lucide="user"></i>
              </span>


              <input type="text" name="last_name" class="form-control" placeholder="Doe" value="{{ old('last_name') }}"
                required>


            </div>


            @error('last_name')
              <div class="text-danger small">
                {{ $message }}
              </div>
            @enderror


          </div>


        </div>





        <!-- Email -->

        <div>

          <label class="form-label small fw-medium">
            Email Address
          </label>


          <div class="input-group">

            <span class="input-group-text bg-white">
              <i data-lucide="mail"></i>
            </span>


            <input type="email" name="email" class="form-control" placeholder="john@example.com"
              value="{{ old('email') }}" required>


          </div>


          @error('email')
            <div class="text-danger small">
              {{ $message }}
            </div>
          @enderror


        </div>





        <!-- Phone Number -->

        <div>

          <label class="form-label small fw-medium">
            Phone Number
          </label>


          <div class="input-group">


            <span class="input-group-text bg-white">
              <i data-lucide="phone"></i>
            </span>


            <input type="text" name="phone" class="form-control" placeholder="+855 12 345 678"
              value="{{ old('phone') }}" required>


          </div>


          @error('phone')
            <div class="text-danger small">
              {{ $message }}
            </div>
          @enderror


        </div>






        <!-- Password -->

        <div>


          <label class="form-label small fw-medium">
            Password
          </label>


          <div class="input-group">


            <span class="input-group-text bg-white">
              <i data-lucide="lock"></i>
            </span>



            <input id="password" type="password" name="password" class="form-control" placeholder="********" required>



            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">

              <i data-lucide="eye"></i>

            </button>


          </div>


          @error('password')
            <div class="text-danger small">
              {{ $message }}
            </div>
          @enderror


        </div>






        <!-- Confirm Password -->

        <div>


          <label class="form-label small fw-medium">
            Confirm Password
          </label>


          <div class="input-group">


            <span class="input-group-text bg-white">
              <i data-lucide="lock-keyhole"></i>
            </span>



            <input id="confirmPassword" type="password" name="password_confirmation" class="form-control"
              placeholder="********" required>



            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('confirmPassword')">

              <i data-lucide="eye"></i>

            </button>


          </div>


        </div>






        <!-- Button -->

        <button type="submit" class="btn btn-primary py-2 fw-semibold">

          Create Account

        </button>



      </form>





      <!-- Footer -->

      <div class="text-center mt-4">

        <p class="small text-muted mb-0">

          Already have an account?

          <a href="{{ route('login') }}" class="fw-bold text-decoration-none">

            Sign In

          </a>


        </p>


      </div>



    </div>


  </div>




  <script>


    function togglePassword(id) {

      const password = document.getElementById(id);


      password.type =
        password.type === "password"
          ? "text"
          : "password";

    }


    lucide.createIcons();


  </script>



</body>

</html>