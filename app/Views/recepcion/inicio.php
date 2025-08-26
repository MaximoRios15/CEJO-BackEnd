<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Recepción - CEJO</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <div class="container">
            <a class="navbar-brand" href="#">CEJO - Recepción</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Bienvenido, <?= session('usuario') ?></span>
                <a class="btn btn-outline-light btn-sm" href="<?= base_url('/salir') ?>">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Panel de Recepción</h1>
                <p class="lead">Gestión de pacientes y citas</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Registrar Paciente</h5>
                        <p class="card-text">Registrar un nuevo paciente en el sistema.</p>
                        <a href="<?= base_url('/recepcion/registrar-paciente') ?>" class="btn btn-primary">Registrar Paciente</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Agendar Cita</h5>
                        <p class="card-text">Programar una nueva cita para un paciente.</p>
                        <a href="<?= base_url('/recepcion/agendar-cita') ?>" class="btn btn-success">Agendar Cita</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ver Citas del Día</h5>
                        <p class="card-text">Consultar las citas programadas para hoy.</p>
                        <a href="<?= base_url('/recepcion/ver-citas') ?>" class="btn btn-info">Ver Citas</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Buscar Paciente</h5>
                        <p class="card-text">Buscar información de pacientes registrados.</p>
                        <a href="#" class="btn btn-warning">Buscar Paciente</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Resumen del Día</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h3 class="text-primary">-</h3>
                                    <p>Citas Programadas</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h3 class="text-success">-</h3>
                                    <p>Pacientes Atendidos</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h3 class="text-warning">-</h3>
                                    <p>Citas Pendientes</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <h3 class="text-info">-</h3>
                                    <p>Nuevos Pacientes</p>
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
                        <h5>Próximas Citas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Hora</th>
                                        <th>Paciente</th>
                                        <th>Tipo de Cita</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No hay citas programadas para mostrar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>