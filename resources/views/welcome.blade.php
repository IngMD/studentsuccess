<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a nuestro sitio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff;
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #ffffff;
        }
        .header {
            background-color: #ffffff;
            text-align: center;
            padding: 100px 0;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #343a40;
            font-weight: bold;
            font-size: 36px;
        }
        .header p {
            color: #6c757d;
            font-size: 20px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            text-align: center;
            padding: 10px 0;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Student Success</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <header class="header">
        <div class="container">
            <h1>¡Bienvenido a nuestro sitio!</h1>
            <p class="lead">Por favor, inicia sesión o regístrate para continuar.</p>
        </div>
    </header>

    <footer class="footer">
        <div class="container">
            <p>Pie de Página &copy; 2024</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
