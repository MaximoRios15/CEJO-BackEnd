<?php

namespace App\Models;

use CodeIgniter\Model;

class ProveedorModel extends Model
{
    protected $table = 'Proveedor';
    protected $primaryKey = 'idProveedor';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'Nombre_Proveedor'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'Nombre_Proveedor' => 'required|max_length[45]'
    ];

    protected $validationMessages = [
        'Nombre_Proveedor' => [
            'required' => 'El nombre del proveedor es obligatorio',
            'max_length' => 'El nombre del proveedor no puede exceder 45 caracteres'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Obtener todos los proveedores activos
     */
    public function getProveedoresActivos()
    {
        return $this->orderBy('Nombre_Proveedor', 'ASC')->findAll();
    }

    /**
     * Buscar proveedor por nombre
     */
    public function buscarPorNombre($nombre)
    {
        return $this->like('Nombre_Proveedor', $nombre)->findAll();
    }

    /**
     * Verificar si existe un proveedor con el nombre dado
     */
    public function existeProveedor($nombre, $excludeId = null)
    {
        $builder = $this->where('Nombre_Proveedor', $nombre);
        
        if ($excludeId) {
            $builder->where('idProveedor !=', $excludeId);
        }
        
        return $builder->countAllResults() > 0;
    }
}