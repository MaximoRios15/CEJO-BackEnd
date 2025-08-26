<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestión de Usuarios - CEJO</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/admin/dashboard') ?>">CEJO - Administrador</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Bienvenido, <?= session('usuario') ?></span>
                <a class="btn btn-outline-light btn-sm" href="<?= base_url('/salir') ?>">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h1>Gestión de Usuarios</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                    </ol>
                </nav>
            </div>
        </div>

        <?php if (session('mensaje')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session('mensaje') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Crear Nuevo Usuario</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('/admin/crear-usuario') ?>" method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_rol" class="form-label">Rol de Usuario</label>
                                <select class="form-select" id="id_rol" name="id_rol" required>
                                    <option value="">Seleccionar...</option>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= $rol['id_rol'] ?>"><?= ucfirst($rol['descripcion']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Usuarios</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($usuarios) && !empty($usuarios)): ?>
                                        <?php foreach ($usuarios as $usuario): ?>
                                            <tr>
                                                <td><?= $usuario['id_usuario'] ?></td>
                                                <td><?= $usuario['usuario'] ?></td>
                                                <td>
                                                    <?php 
                                                    $rolClass = '';
                                                    switch(strtolower($usuario['rol'])) {
                                                        case 'admin':
                                                            $rolClass = 'bg-danger';
                                                            break;
                                                        case 'recepcionista':
                                                            $rolClass = 'bg-info';
                                                            break;
                                                        case 'tecnico':
                                                            $rolClass = 'bg-success';
                                                            break;
                                                        default:
                                                            $rolClass = 'bg-secondary';
                                                    }
                                                    echo '<span class="badge ' . $rolClass . '">' . ucfirst($usuario['rol']) . '</span>';
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if ($usuario['usuario'] !== session('usuario')): ?>
                                                        <a href="<?= base_url('/admin/eliminar-usuario/' . $usuario['id_usuario']) ?>" 
                                                           class="btn btn-sm btn-danger" 
                                                           onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</a>
                                                    <?php else: ?>
                                                        <span class="text-muted">Usuario actual</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay usuarios registrados</td>
                                        </tr>
                                    <?php endif; ?>
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