<!DOCTYPE html>
<html lang="en">
<head>
    <title>404 - Page Not Found</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('Logo TML.png') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/main.css') }}">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .container-login100 {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .wrap-login100 {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        .login100-pic img {
            border-radius: 10px;
        }
        .login100-form-btn {
            background-color: #ff7e5f;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login100-form-btn:hover {
            background-color: #f06;
        }
    </style>
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img width="90%" src="{{ asset('Logo TML side.png') }}" alt="IMG">
                </div>
                <h1>404 - Page Not Found</h1>
                <p>The page you are looking for does not exist.</p>
                <a href="{{ url('/welcome') }}" class="login100-form-btn">Go to Home</a>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('login/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="{{ asset('login/js/main.js') }}"></script>

</body>
</html>
