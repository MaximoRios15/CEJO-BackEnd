<?php namespace App\Models;
use CodeIgniter\Model;

class Usuarios extends Model
{
    protected $table = 'tusuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['usuario', 'password', 'type'];
    
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
    
    public function obtenerUsuariosPorTipo($tipo)
    {
        return $this->db->table('tusuarios')
                       ->where('type', $tipo)
                       ->get()
                       ->getResultArray();
    }
}