<?php namespace App\Models;
use CodeIgniter\Model;
class Usuarios extends Model{
    public function obtenerUsuarios($data){
        $usuario = $this -> db -> table('tusuarios');
        $usuario -> where($data);
        return $usuario -> get() -> getResultArray();
    }
}