<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoModel extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'idEstados';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'Descripcion_Estados'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'Descripcion_Estados' => 'required|max_length[50]|is_unique[estados.Descripcion_Estados,idEstados,{idEstados}]'
    ];

    protected $validationMessages = [
        'Descripcion_Estados' => [
            'required' => 'La descripción del estado es obligatoria',
            'max_length' => 'La descripción no puede exceder 50 caracteres',
            'is_unique' => 'Este estado ya existe'
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
     * Obtener todos los estados activos
     */
    public function obtenerEstadosActivos()
    {
        return $this->findAll();
    }
}