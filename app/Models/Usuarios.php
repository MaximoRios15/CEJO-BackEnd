<?php namespace App\Models;
use CodeIgniter\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuarios';
    protected $allowedFields = ['Nombres_Usuarios', 'Apellidos_Usuarios', 'DNI_Usuarios', 'Password_Usuarios', 'FechaCreacion_Usuarios', 'UltimoAcceso_Usuarios', 'idRoles_Usuarios', 'Activo_Usuarios'];
    
    public function obtenerUsuarios($data = [])
    {
        $usuario = $this->db->table('usuarios');
        if (!empty($data)) {
            $usuario->where($data);
        }
        return $usuario->get()->getResultArray();
    }
    
    public function crearUsuario($data)
    {
        try {
            return $this->db->table('usuarios')->insert($data);
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function actualizarUsuario($id, $data)
    {
        try {
            return $this->db->table('usuarios')
                          ->where('idUsuarios', $id)
                          ->update($data);
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function eliminarUsuario($id)
    {
        try {
            return $this->db->table('usuarios')
                          ->where('idUsuarios', $id)
                          ->delete();
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function obtenerUsuarioPorId($id)
    {
        return $this->db->table('usuarios')
                       ->where('idUsuarios', $id)
                       ->get()
                       ->getRowArray();
    }
    
    public function verificarUsuarioExiste($usuario)
    {
        $result = $this->db->table('usuarios')
                          ->where('DNI_Usuarios', $usuario)
                          ->get()
                          ->getResultArray();
        return count($result) > 0;
    }
    
    public function obtenerUsuariosPorRol($idRol)
    {
        return $this->db->table('usuarios')
                       ->where('idRoles_Usuarios', $idRol)
                       ->get()
                       ->getResultArray();
    }
    
    /**
     * Obtener usuarios con información de roles
     */
    public function obtenerUsuariosConRoles()
    {
        return $this->db->table('usuarios u')
                       ->join('roles r', 'u.idRoles_Usuarios = r.idRoles')
                       ->select('u.*, r.Descripcion_Roles as rol')
                       ->get()
                       ->getResultArray();
    }
    
    /**
     * Obtener usuario por ID con información del rol
     */
    public function obtenerUsuarioConRol($id)
    {
        return $this->db->table('usuarios u')
                       ->join('roles r', 'u.idRoles_Usuarios = r.idRoles')
                       ->select('u.*, r.Descripcion_Roles as rol')
                       ->where('u.idUsuarios', $id)
                       ->get()
                       ->getRowArray();
    }
}