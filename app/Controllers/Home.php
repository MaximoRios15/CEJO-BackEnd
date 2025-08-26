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
            // Usuario y contraseña correctos
            $data =[
                "id_usuario" => $datosUsuario[0]['id_usuario'],
                "usuario" => $datosUsuario[0]['usuario'],
                "type" => $datosUsuario[0]['type']
            ];
            $session = session();
            $session->set($data);
            
            // Redirigir según el rol del usuario
            switch ($datosUsuario[0]['type']) {
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
