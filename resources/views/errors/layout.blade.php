<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="{{asset( '../imgs/logo/logo.png')}}">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Arial', sans-serif;
                background-color: #f2f2f2;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                color: #333;
            }

            .container {
                text-align: center;
            }

            h1 {
                font-size: 160px;
                margin: 0;
                color: #FFB427;
            }

            h2 {
                font-size: 40px;
                margin: 10px 0;
                color: #2f3542;
            }

            p {
                font-size: 20px;
                margin-bottom: 30px;
                color: #57606f;
            }

            .btn-container {
                display: flex;
                justify-content: center;
                gap: 20px;
            }

            .btn {
                align-content: center;
                height: 52px;
                width: 270px;
                font-size: 20px;
                text-decoration: none;
                color: white;
                background-color: #FFB427;
                border-radius: 12px;
                transition: background-color 0.3s ease;
            }

            .btn:hover {
                background-color: #F19D00;
            }

            .animation {
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0);
                }
                50% {
                    transform: translateY(-20px);
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1 class="animation">@yield('error')</h1>
            <h2>@yield('info')</h2>
            <p>@yield('message')</p>
            <div class="btn-container">
                <a href="@yield('buttonRoute', '/')" class="btn">@yield('buttonText', 'Homepage')</a>
            </div>
        </div>

        @stack('js')
    </body>
</html>


