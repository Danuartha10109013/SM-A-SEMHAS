<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login || Sistem Informasi Digital WH</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/responsive.css">
      <style>
         body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            height: 100vh;
         }
         .sign-in-page {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
         }
         .sign-in-from {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
         }
         .sign-in-from h1 {
            color: #4e54c8;
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
         }
         .form-control {
            border-radius: 50px;
            padding: 10px 20px;
            border: 1px solid #d3d3d3;
         }
         .form-control:focus {
            box-shadow: none;
            border-color: #4e54c8;
         }
         .btn-primary {
            background-color: #4e54c8;
            border-color: #4e54c8;
            border-radius: 50px;
            padding: 10px 30px;
         }
         .btn-primary:hover {
            background-color: #8f94fb;
            border-color: #8f94fb;
         }
         .sign-in-detail {
            background: url('{{asset('login-background.jpg')}}') no-repeat center center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 50px;
            border-radius: 10px;
         }
         .sign-in-detail img {
            max-width: 70%;
            margin-bottom: 30px;
         }
         .slick-slider11 {
            color: #fff;
            text-align: center;
         }
         .alert {
            border-radius: 50px;
            padding: 15px;
         }
         @media (max-width: 768px) {
            .sign-in-detail {
               display: none;
            }
         }
      </style>
   </head>
   <body>
      <section class="sign-in-page">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-8">
                  <div class="row">
                     <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                           <h1>Sign in</h1>
                           @if (session('error'))
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 {{ session('error') }}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                           @elseif (session('success'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                 {{ session('success') }}
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                           @endif
                           <p>Enter your email address and password to access admin panel.</p>
                           <form method="POST" action="{{route('login-proses')}}" class="mt-4">
                              @csrf
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Email address</label>
                                 @if(session('email'))
                                 <input type="email" name="email" class="form-control mb-3" value="{{ session('email') }}" id="exampleInputEmail1" placeholder="Enter email">
                                 @else
                                 <input type="email" name="email" class="form-control mb-3"  id="exampleInputEmail1" placeholder="Enter email">
                                 @endif
                              </div>
                              <!-- Bootstrap CSS (pastikan sudah dimuat di layout utama) -->
                              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                              <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

                                                            <div class="mb-3">
                              <label for="password" class="form-label">Password</label>
                              <div class="password-wrapper">
                                 <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                 <i class="bi bi-eye-fill toggle-password" id="togglePassword"></i>
                              </div>
                              </div>

                              <style>
                              .password-wrapper {
                              position: relative;
                              }

                              .password-wrapper input {
                              padding-right: 40px; /* space for the eye icon */
                              }

                              .toggle-password {
                              position: absolute;
                              right: 10px;
                              top: 50%;
                              transform: translateY(-50%);
                              cursor: pointer;
                              font-size: 1.2rem;
                              color: #6c757d;
                              transition: transform 0.2s ease, color 0.2s ease;
                              }

                              .toggle-password:hover {
                              transform: translateY(-50%) scale(1.2);
                              color: #000;
                              }
                              </style>

                              <script>
                              document.getElementById("togglePassword").addEventListener("click", function () {
                              const passwordInput = document.getElementById("password");
                              const icon = this;

                              if (passwordInput.type === "password") {
                                 passwordInput.type = "text";
                                 icon.classList.remove("bi-eye-fill");
                                 icon.classList.add("bi-eye-slash-fill");
                              } else {
                                 passwordInput.type = "password";
                                 icon.classList.remove("bi-eye-slash-fill");
                                 icon.classList.add("bi-eye-fill");
                              }
                              });
                              </script>



                              <button type="submit" class="btn btn-primary btn-block mt-4">Sign in</button>
                           </form>
                        </div>
                     </div>
                     <div class="col-sm-6 text-center">
                        <div class="sign-in-detail">
                           <div class="slick-slider11">
                              <div class="item">
                                <p style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-weight: bolder;font-size: 20px">Sistem Informasi Manajemen Operasional
                                </p>
                              </div>
                              <div class="item mt-5">
                                 <img src="{{asset('Logo_TML.png')}}" alt="logo">
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Optional JavaScript -->
      <script src="{{asset('vendor')}}/js/jquery.min.js"></script>
      <script src="{{asset('vendor')}}/js/popper.min.js"></script>
      <script src="{{asset('vendor')}}/js/bootstrap.min.js"></script>
      <script src="{{asset('vendor')}}/js/slick.min.js"></script>
   </body>
</html>
