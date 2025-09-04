<?php

namespace App\Models;

use CodeIgniter\Model;

class Roles extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'idRoles';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['Descripcion_Roles'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Obtener todos los roles activos
     */
    public function obtenerRoles()
    {
        return $this->findAll();
    }

    /**
     * Obtener un rol por su ID
     */
    public function obtenerRolPorId($id)
    {
        return $this->find($id);
    }

    /**
     * Crear un nuevo rol
     */
    public function crearRol($data)
    {
        return $this->insert($data);
    }

    /**
     * Actualizar un rol
     */
    public function actualizarRol($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Eliminar un rol
     */
    public function eliminarRol($id)
    {
        return $this->delete($id);
    }

    /**
     * Verificar si existe un rol con una descripción específica
     */
    public function verificarRolExiste($descripcion)
    {
        return $this->where('Descripcion_Roles', $descripcion)->first();
    }
}
