<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario está logueado
        if (!session('usuario')) {
            return redirect()->to(base_url('/'));
        }

        // Si se especifica un rol, verificar que el usuario tenga ese rol
        if ($arguments && count($arguments) > 0) {
            $requiredRole = $arguments[0];
            $userRole = session('type');
            
            if ($userRole !== $requiredRole) {
                // Redirigir según el rol del usuario
                switch ($userRole) {
                    case 'admin':
                        return redirect()->to(base_url('/admin/dashboard'));
                    case 'recepcionista':
                        return redirect()->to(base_url('/recepcion/inicio'));
                    case 'tecnico':
                        return redirect()->to(base_url('/tecnico/panel'));
                    default:
                        return redirect()->to(base_url('/'));
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}