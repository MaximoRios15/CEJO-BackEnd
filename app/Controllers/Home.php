<?php namespace App\Controllers;
use App\Models\Usuarios;

class Home extends BaseController
{
    public function index()
    {
        // Solo obtener mensaje si hay una sesión activa
        $mensaje = null;
        if (session_status() === PHP_SESSION_ACTIVE && session()->has('mensaje')) {
            $mensaje = session('mensaje');
        }
        return view('login', ['mensaje' => $mensaje]);
    }

    public function inicio(){
        return view('inicio');
    }

    public function login(){
        // Obtener datos tanto de POST tradicional como de JSON
        $input = null;
        
        // Intentar obtener JSON solo si el Content-Type es application/json
        $contentType = $this->request->getHeaderLine('Content-Type');
        if (strpos($contentType, 'application/json') !== false) {
            try {
                $input = $this->request->getJSON(true);
            } catch (\Exception $e) {
                log_message('warning', 'Failed to parse JSON: ' . $e->getMessage());
                $input = null;
            }
        }
        
        if ($input && is_array($input)) {
            // Datos enviados como JSON
            $usuario = $input['usuario'] ?? '';
            $password = $input['password'] ?? '';
        } else {
            // Datos enviados como POST tradicional (FormData)
            $usuario = $this->request->getPost('usuario');
            $password = $this->request->getPost('password');
        }
        
        // Validación básica de entrada
        if (empty($usuario) || empty($password)) {
            $isAjax = $this->request->isAJAX() || $this->request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest';
            if ($isAjax) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Usuario y contraseña son requeridos'
                ]);
            }
            return redirect()->to(base_url('/'))->with('mensaje','0');
        }
        
        // Inicializar sesión de forma segura
        $session = session();
        
        // Solo regenerar si ya hay una sesión activa
        if (session_status() === PHP_SESSION_ACTIVE) {
            $session->regenerate(true);
        }
        
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

        // Validación robusta de credenciales
        if (count($datosUsuario) > 0) {
            $usuarioDB = $datosUsuario[0];
            
            // Verificar que el hash de la contraseña sea válido
            if (empty($usuarioDB['password']) || !password_verify($password, $usuarioDB['password'])) {
                // Log de intento fallido
                log_message('warning', 'Failed login attempt for user: ' . $usuario);
                
                if ($isAjax) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Credenciales incorrectas'
                    ]);
                }
                return redirect()->to(base_url('/'))->with('mensaje','0');
            }
            
            // Obtener información del usuario con su rol
            $usuarioConRol = $Usuario->obtenerUsuarioConRol($usuarioDB['id_usuario']);
            
            // Verificar que se obtuvo la información del rol correctamente
            if (empty($usuarioConRol) || empty($usuarioConRol['rol'])) {
                log_message('error', 'Error obtaining user role for user: ' . $usuario);
                
                if ($isAjax) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Error en la autenticación'
                    ]);
                }
                return redirect()->to(base_url('/'))->with('mensaje','0');
            }
            
            // Usuario y contraseña correctos
            $data =[
                "id_usuario" => $usuarioConRol['id_usuario'],
                "usuario" => $usuarioConRol['usuario'],
                "id_rol" => $usuarioConRol['id_rol'],
                "rol" => $usuarioConRol['rol'],
                "type" => $usuarioConRol['rol'] // Mantener compatibilidad con filtros existentes
            ];
            
            // Crear nueva sesión segura
            $session = session();
            $session->regenerate(true);
            $session->set($data);
            
            // Log de login exitoso
            log_message('info', 'Successful login for user: ' . $usuario . ' with role: ' . $usuarioConRol['rol']);
            
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
                case 'recepcion':
                    return redirect()->to('http://localhost/CEJO/CEJO-FrontEnd/cejo-recepcion/recepcion.html');
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
            case 'recepcion':
                return 'http://localhost/CEJO/CEJO-FrontEnd/cejo-recepcion/recepcion.html';
            case 'tecnico':
                return base_url('/tecnico/panel');
            default:
                return base_url('/inicio');
        }
    }

    public function salir(){
        $session = session();
        
        // Limpiar todas las variables de sesión
        $session->remove(['id_usuario', 'usuario', 'id_rol', 'rol', 'type']);
        
        // Destruir la sesión completamente
        $session->destroy();
        
        // Limpiar cookies de sesión y CSRF
        $response = $this->response;
        $response->deleteCookie('ci_session');
        $response->deleteCookie('csrf_cookie_name');
        
        // Regenerar ID de sesión para prevenir session fixation
        $session->regenerate(true);
        
        return redirect()->to('http://localhost/CEJO/CEJO-FrontEnd/cejo-login/login.html');
    }
}
