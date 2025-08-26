<?php

namespace App\Controllers;

use App\Models\Usuarios;

class AdminController extends BaseController
{
    public function index()
    {
        // Verificar que el usuario sea admin
        if (session('type') !== 'admin') {
            return redirect()->to(base_url('/'));
        }
        
        return view('admin/dashboard');
    }
    
    public function usuarios()
    {
        // Verificar que el usuario sea admin
        if (session('type') !== 'admin') {
            return redirect()->to(base_url('/'));
        }
        
        $usuarioModel = new Usuarios();
        $usuarios = $usuarioModel->obtenerUsuarios([]);
        
        return view('admin/usuarios', ['usuarios' => $usuarios]);
    }
    
    public function crearUsuario()
    {
        // Verificar que el usuario sea admin
        if (session('type') !== 'admin') {
            return redirect()->to(base_url('/'));
        }
        
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
        $tipo = $this->request->getPost('tipo');
        
        if ($usuario && $password && $tipo) {
            $usuarioModel = new Usuarios();
            $resultado = $usuarioModel->crearUsuario([
                'usuario' => $usuario,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'type' => $tipo
            ]);
            
            if ($resultado) {
                return redirect()->to(base_url('/admin/usuarios'))->with('mensaje', 'Usuario creado exitosamente');
            } else {
                return redirect()->to(base_url('/admin/usuarios'))->with('error', 'Error al crear usuario');
            }
        }
        
        return redirect()->to(base_url('/admin/usuarios'))->with('error', 'Datos incompletos');
    }
    
    public function eliminarUsuario($id)
    {
        // Verificar que el usuario sea admin
        if (session('type') !== 'admin') {
            return redirect()->to(base_url('/'));
        }
        
        $usuarioModel = new Usuarios();
        $resultado = $usuarioModel->eliminarUsuario($id);
        
        if ($resultado) {
            return redirect()->to(base_url('/admin/usuarios'))->with('mensaje', 'Usuario eliminado exitosamente');
        } else {
            return redirect()->to(base_url('/admin/usuarios'))->with('error', 'Error al eliminar usuario');
        }
    }
}