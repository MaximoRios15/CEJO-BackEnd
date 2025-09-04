<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaEquipoModel extends Model
{
    protected $table = 'categorias_equipos';
    protected $primaryKey = 'idCategorias';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'Nombres_Categorias',
        'Activo_Categorias'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'Nombres_Categorias' => 'required|max_length[45]|is_unique[categorias_equipos.Nombres_Categorias,idCategorias,{idCategorias}]',
        'Activo_Categorias' => 'permit_empty|in_list[0,1]'
    ];

    protected $validationMessages = [
        'Nombres_Categorias' => [
            'required' => 'El nombre de la categoría es requerido',
            'max_length' => 'El nombre de la categoría no puede exceder 45 caracteres',
            'is_unique' => 'Ya existe una categoría con este nombre'
        ],
        'Activo_Categorias' => [
            'in_list' => 'El estado debe ser 0 (inactivo) o 1 (activo)'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['setDefaultValues'];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Establecer valores por defecto antes de insertar
     */
    protected function setDefaultValues(array $data)
    {
        if (!isset($data['data']['Estado_Categoria'])) {
            $data['data']['Estado_Categoria'] = 1; // Activo por defecto
        }
        
        return $data;
    }

    /**
     * Obtener categorías activas
     */
    public function getActiveCategorias()
    {
        return $this->where('Estado_Categoria', 1)
                   ->orderBy('Nombres_Categorias', 'ASC')
                   ->findAll();
    }

    /**
     * Buscar categorías por nombre
     */
    public function searchByName($name)
    {
        return $this->like('Nombres_Categorias', $name)
                   ->where('Estado_Categoria', 1)
                   ->orderBy('Nombres_Categorias', 'ASC')
                   ->findAll();
    }

    /**
     * Activar categoría
     */
    public function activateCategoria($id)
    {
        return $this->update($id, ['Estado_Categoria' => 1]);
    }

    /**
     * Desactivar categoría
     */
    public function deactivateCategoria($id)
    {
        return $this->update($id, ['Estado_Categoria' => 0]);
    }

    /**
     * Verificar si una categoría está en uso
     */
    public function isInUse($id)
    {
        $db = \Config\Database::connect();
        
        // Verificar si hay equipos usando esta categoría
        $query = $db->query("SELECT COUNT(*) as count FROM equipos WHERE idCategorias = ?", [$id]);
        $result = $query->getRow();
        
        return $result->count > 0;
    }

    /**
     * Obtener estadísticas de categorías
     */
    public function getStats()
    {
        $db = \Config\Database::connect();
        
        $query = $db->query("
            SELECT 
                c.idCategorias,
                c.Nombres_Categorias,
                c.Estado_Categoria,
                COUNT(e.idEquipos) as total_equipos
            FROM categorias_equipos c
            LEFT JOIN equipos e ON c.idCategorias = e.idCategorias
            GROUP BY c.idCategorias, c.Nombres_Categorias, c.Estado_Categoria
            ORDER BY c.Nombres_Categorias ASC
        ");
        
        return $query->getResultArray();
    }
}