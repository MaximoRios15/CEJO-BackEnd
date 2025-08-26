<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CEJO Backend - Login</title>
  </head>
  <body>
    <div class="container">
        
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h1>Login Cejo Backend</h1>
                <form action="<?php echo base_url("/login") ?>" method="POST">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Username" required>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <br>
                    <button class="btn btn-primary">Entrada</button>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>