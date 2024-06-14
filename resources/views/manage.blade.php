<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Asegurar que el contenido principal ocupe al menos el 100% de la altura de la ventana */
        html, body {
            height: 100%;
        }

        /* Flexbox para el body */
        body {
            display: flex;
            flex-direction: column;
        }

        /* El contenedor principal debe ocupar el espacio restante */
        .container.mt-5 {
            flex: 1;
        }

        /* El pie de página debe estar pegado al final */
        .footer {
            flex-shrink: 0;
            background-color: #f8f9fa;
            padding: 1rem 0;
        }

        /* Estilos adicionales para la tabla */
        .table thead th {
            background-color: #343a40;
            color: white;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table td, .table th {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar de Cabecera -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn btn-outline-light" href="#" id="userMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opciones
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#uploadInfoModal">Subir Información</a>
                        <a class="dropdown-item" href="{{ route('assets.manage') }}">Administrar Activos</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#confirmLogoutModal">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Navbar Principal -->
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">Mi Aplicación</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav"></div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Gestionar Activos</h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario de filtro por carrera -->
        <form action="{{ route('assets.manage') }}" method="GET" class="mb-4">
            <div class="form-group">
                <label for="filtroCarrera">Filtrar por Carrera:</label>
                <select class="form-control" id="filtroCarrera" name="filtroCarrera">
                    <option value="">Todas las Carreras</option>
                    <option value="Ingeniería Informática">Ingeniería Informática</option>
                    <option value="Medicina">Medicina</option>
                    <option value="Derecho">Derecho</option>
                    <option value="Administración de Empresas">Administración de Empresas</option>
                    <option value="Ingeniería Civil">Ingeniería Civil</option>
                    <option value="Psicología">Psicología</option>
                    <option value="Arquitectura">Arquitectura</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <!-- Tabla de activos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autores</th>
                    <th>Fecha</th>
                    <th>Carrera Universitaria</th>
                    <th>Archivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assets as $asset)
                <tr>
                    <td>{{ $asset->title }}</td>
                    <td>{{ $asset->authors }}</td>
                    <td>{{ $asset->date }}</td>
                    <td>{{ $asset->university_course }}</td>
                    <td>
                        <a href="{{ route('descargar.archivo', $asset->file_path) }}" class="btn btn-primary btn-sm" target="_blank">Descargar Archivo</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para subir información -->
    <div class="modal fade" id="uploadInfoModal" tabindex="-1" role="dialog" aria-labelledby="uploadInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="uploadInfoModalLabel">Subir Información</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('upload.info') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Título:</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Ingrese el título" required>
                        </div>
                        <div class="form-group">
                            <label for="authors">Autores:</label>
                            <input type="text" class="form-control" id="authors" name="authors" placeholder="Ingrese los autores" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Fecha:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="university_course">Carrera Universitaria:</label>
                            <select class="form-control" id="university_course" name="university_course" required>
                                <option value="">Seleccione una carrera</option>
                                <option value="Ingeniería Informática">Ingeniería Informática</option>
                                <option value="Medicina">Medicina</option>
                                <option value="Derecho">Derecho</option>
                                <option value="Administración de Empresas">Administración de Empresas</option>
                                <option value="Ingeniería Civil">Ingeniería Civil</option>
                                <option value="Psicología">Psicología</option>
                                <option value="Arquitectura">Arquitectura</option>
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file">Subir Archivo:</label>
                            <input type="file" class="form-control-file" id="file" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">
                    <h6>Contacto</h6>
                    <p>Correo: info@miaplicacion.com</p>
                    <p>Teléfono: +1 234 567 890</p>
                </div>
                <div class="col-md-4">
                    <h6>Dirección</h6>
                    <p>Calle Ejemplo 123</p>
                    <p>Ciudad, País</p>
                </div>
                <div class="col-md-4">
                    <h6>Enlaces</h6>
                    <p><a href="#">Política de Privacidad</a></p>
                    <p><a href="#">Términos y Condiciones</a></p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <span class="text-muted">© 2024 Mi Aplicación</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal de Cerrar Sesión -->
    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Cerrar Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres cerrar sesión?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
