<?php

namespace App\Models;

use CodeIgniter\Model;

class GarantiaModel extends Model
{
    protected $table = 'garantias';
    protected $primaryKey = 'idGarantias';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'Descripcion_Garantias'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'Descripcion_Garantias' => 'required|max_length[50]|is_unique[garantias.Descripcion_Garantias,idGarantias,{idGarantias}]'
    ];

    protected $validationMessages = [
        'Descripcion_Garantias' => [
            'required' => 'La descripción de la garantía es requerida',
            'max_length' => 'La descripción de la garantía no puede exceder 50 caracteres',
            'is_unique' => 'Ya existe una garantía con esta descripción'
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
     * Buscar garantías por descripción
     */
    public function searchByDescription($description)
    {
        return $this->like('Descripcion_Garantias', $description)
                   ->orderBy('Descripcion_Garantias', 'ASC')
                   ->findAll();
    }

    /**
     * Verificar si una garantía está en uso
     */
    public function isInUse($id)
    {
        $db = \Config\Database::connect();
        
        // Verificar si hay equipos usando esta garantía
        $query = $db->query("SELECT COUNT(*) as count FROM equipos WHERE idGarantias_Equipos = ?", [$id]);
        $result = $query->getRow();
        
        return $result->count > 0;
    }

    /**
     * Obtener estadísticas de garantías
     */
    public function getStats()
    {
        $db = \Config\Database::connect();
        
        $query = $db->query("
            SELECT 
                g.idGarantias,
                g.Descripcion_Garantias,
                COUNT(e.idEquipos) as total_equipos
            FROM garantias g
            LEFT JOIN equipos e ON g.idGarantias = e.idGarantias_Equipos
            GROUP BY g.idGarantias, g.Descripcion_Garantias
            ORDER BY g.Descripcion_Garantias ASC
        ");
        
        return $query->getResultArray();
    }

    /**
     * Obtener garantías más utilizadas
     */
    public function getMostUsed($limit = 10)
    {
        $db = \Config\Database::connect();
        
        $query = $db->query("
            SELECT 
                g.idGarantias,
                g.Descripcion_Garantias,
                COUNT(e.idEquipos) as total_equipos
            FROM garantias g
            LEFT JOIN equipos e ON g.idGarantias = e.idGarantias_Equipos
            GROUP BY g.idGarantias, g.Descripcion_Garantias
            HAVING total_equipos > 0
            ORDER BY total_equipos DESC, g.Descripcion_Garantias ASC
            LIMIT ?
        ", [$limit]);
        
        return $query->getResultArray();
    }

    /**
     * Obtener garantías sin usar
     */
    public function getUnused()
    {
        $db = \Config\Database::connect();
        
        $query = $db->query("
            SELECT 
                g.idGarantias,
                g.Descripcion_Garantias
            FROM garantias g
            LEFT JOIN equipos e ON g.idGarantias = e.idGarantias_Equipos
            WHERE e.idEquipos IS NULL
            ORDER BY g.Descripcion_Garantias ASC
        ");
        
        return $query->getResultArray();
    }
}