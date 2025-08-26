<?php namespace App\Models;
use CodeIgniter\Model;

class Usuarios extends Model
{
    protected $table = 'tusuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['usuario', 'password', 'id_rol'];
    
    public function obtenerUsuarios($data = [])
    {
        $usuario = $this->db->table('tusuarios');
        if (!empty($data)) {
            $usuario->where($data);
        }
        return $usuario->get()->getResultArray();
    }
    
    public function crearUsuario($data)
    {
        try {
            return $this->db->table('tusuarios')->insert($data);
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function actualizarUsuario($id, $data)
    {
        try {
            return $this->db->table('tusuarios')
                          ->where('id_usuario', $id)
                          ->update($data);
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function eliminarUsuario($id)
    {
        try {
            return $this->db->table('tusuarios')
                          ->where('id_usuario', $id)
                          ->delete();
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function obtenerUsuarioPorId($id)
    {
        return $this->db->table('tusuarios')
                       ->where('id_usuario', $id)
                       ->get()
                       ->getRowArray();
    }
    
    public function verificarUsuarioExiste($usuario)
    {
        $result = $this->db->table('tusuarios')
                          ->where('usuario', $usuario)
                          ->get()
                          ->getResultArray();
        return count($result) > 0;
    }
    
    public function obtenerUsuariosPorRol($idRol)
    {
        return $this->db->table('tusuarios')
                       ->where('id_rol', $idRol)
                       ->get()
                       ->getResultArray();
    }
    
    /**
     * Obtener usuarios con información de roles
     */
    public function obtenerUsuariosConRoles()
    {
        return $this->db->table('tusuarios u')
                       ->join('troles r', 'u.id_rol = r.id_rol')
                       ->select('u.*, r.descripcion as rol')
                       ->get()
                       ->getResultArray();
    }
    
    /**
     * Obtener usuario por ID con información del rol
     */
    public function obtenerUsuarioConRol($id)
    {
        return $this->db->table('tusuarios u')
                       ->join('troles r', 'u.id_rol = r.id_rol')
                       ->select('u.*, r.descripcion as rol')
                       ->where('u.id_usuario', $id)
                       ->get()
                       ->getRowArray();
    }
}