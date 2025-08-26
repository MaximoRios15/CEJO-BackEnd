<?php namespace App\Controllers;
use App\Models\Usuarios;

class Home extends BaseController
{
    public function index()
    {
        $mensaje = session('mensaje');
        return view('login', ['mensaje' => $mensaje]);
    }

    public function inicio(){
        return view('inicio');
    }

    public function login(){

        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
        $Usuario = new Usuarios();

        $datosUsuario = $Usuario -> obtenerUsuarios(['usuario' => $usuario]);

        

        if (count($datosUsuario) > 0 && password_verify($password, $datosUsuario[0]['password'])) {
            // Obtener información del usuario con su rol
            $usuarioConRol = $Usuario->obtenerUsuarioConRol($datosUsuario[0]['id_usuario']);
            
            // Usuario y contraseña correctos
            $data =[
                "id_usuario" => $usuarioConRol['id_usuario'],
                "usuario" => $usuarioConRol['usuario'],
                "id_rol" => $usuarioConRol['id_rol'],
                "rol" => $usuarioConRol['rol'],
                "type" => $usuarioConRol['rol'] // Mantener compatibilidad con filtros existentes
            ];
            $session = session();
            $session->set($data);
            
            // Redirigir según el rol del usuario
            switch ($usuarioConRol['rol']) {
                case 'admin':
                    return redirect()->to(base_url('/admin/dashboard'))->with('mensaje','1');
                case 'recepcionista':
                    return redirect()->to(base_url('/recepcion/inicio'))->with('mensaje','1');
                case 'tecnico':
                    return redirect()->to(base_url('/tecnico/panel'))->with('mensaje','1');
                default:
                    return redirect()->to(base_url('/inicio'))->with('mensaje','1');
            }
        } else {
            return redirect()->to(base_url('/'))->with('mensaje','0');
        }
    }

    public function salir(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
