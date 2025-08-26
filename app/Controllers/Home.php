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
        
        // Log para depuración
        log_message('info', 'Login attempt - Usuario: ' . $usuario . ', Password length: ' . strlen($password));
        
        $Usuario = new Usuarios();

        $datosUsuario = $Usuario -> obtenerUsuarios(['usuario' => $usuario]);
        
        // Log para depuración
        log_message('info', 'User found in DB: ' . (count($datosUsuario) > 0 ? 'Yes' : 'No'));

        // Verificar si es una petición AJAX
        $isAjax = $this->request->isAJAX() || $this->request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest';
        
        // Log para depuración
        log_message('info', 'Is AJAX request: ' . ($isAjax ? 'Yes' : 'No'));

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
            
            // Si es AJAX, devolver JSON
            if ($isAjax) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Login exitoso',
                    'rol' => $usuarioConRol['rol'],
                    'redirect_url' => $this->getRedirectUrl($usuarioConRol['rol'])
                ]);
            }
            
            // Redirigir según el rol del usuario (para peticiones normales)
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
            // Si es AJAX, devolver JSON de error
            if ($isAjax) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Credenciales incorrectas'
                ]);
            }
            
            return redirect()->to(base_url('/'))->with('mensaje','0');
        }
    }

    private function getRedirectUrl($rol) {
        switch ($rol) {
            case 'admin':
                return base_url('/admin/dashboard');
            case 'recepcionista':
                return base_url('/recepcion/inicio');
            case 'tecnico':
                return base_url('/tecnico/panel');
            default:
                return base_url('/inicio');
        }
    }

    public function salir(){
        $session = session();
        $session->destroy();
        return redirect()->to('http://localhost/CEJO/CEJO-FrontEnd/cejo-login/login.html');
    }
}
