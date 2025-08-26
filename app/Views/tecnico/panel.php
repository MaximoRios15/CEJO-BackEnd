<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Panel Técnico - CEJO</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">CEJO - Técnico</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Bienvenido, <?= session('usuario') ?></span>
                <a class="btn btn-outline-light btn-sm" href="<?= base_url('/salir') ?>">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Panel Técnico</h1>
                <p class="lead">Gestión de tratamientos y equipos</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ver Pacientes</h5>
                        <p class="card-text">Consultar la lista de pacientes asignados.</p>
                        <a href="<?= base_url('/tecnico/ver-pacientes') ?>" class="btn btn-primary">Ver Pacientes</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Registrar Tratamiento</h5>
                        <p class="card-text">Registrar un nuevo tratamiento para un paciente.</p>
                        <a href="<?= base_url('/tecnico/registrar-tratamiento') ?>" class="btn btn-success">Registrar Tratamiento</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Equipos</h5>
                        <p class="card-text">Administrar y verificar el estado de los equipos.</p>
                        <a href="<?= base_url('/tecnico/equipos') ?>" class="btn btn-info">Gestionar Equipos</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Generar reportes de tratamientos y actividades.</p>
                        <a href="#" class="btn btn-warning">Ver Reportes</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Resumen de Actividades</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h3 class="text-primary">-</h3>
                                    <p>Pacientes Asignados</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h3 class="text-success">-</h3>
                                    <p>Tratamientos Hoy</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h3 class="text-warning">-</h3>
                                    <p>Equipos en Uso</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h3 class="text-info">-</h3>
                                    <p>Sesiones Completadas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Próximos Tratamientos</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Hora</th>
                                        <th>Paciente</th>
                                        <th>Tipo de Tratamiento</th>
                                        <th>Equipo</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No hay tratamientos programados para mostrar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Estado de Equipos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card border-success">
                                    <div class="card-body text-center">
                                        <h5 class="text-success">Equipos Disponibles</h5>
                                        <h2 class="text-success">-</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-warning">
                                    <div class="card-body text-center">
                                        <h5 class="text-warning">En Mantenimiento</h5>
                                        <h2 class="text-warning">-</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-danger">
                                    <div class="card-body text-center">
                                        <h5 class="text-danger">Fuera de Servicio</h5>
                                        <h2 class="text-danger">-</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>