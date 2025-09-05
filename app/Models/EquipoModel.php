<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipoModel extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'idEquipos';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'idClientes_Equipos',
        'idCategorias_Equipos',
        'Marca_Equipo',
        'Modelo_Equipos',
        'DescripcionProblema_Equipos',
        'idGarantias_Equipos',
        'Accesorios_Equipos',
        'FechaIngreso_Equipos',
        'idEstados_Equipos',
        'NroOrden_Equipo',
        'NroBR_Equipo'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'idClientes_Equipos' => 'required|integer|is_not_unique[clientes.idClientes]',
        'idCategorias_Equipos' => 'required|integer|is_not_unique[categorias_equipos.idCategorias]',
        'Marca_Equipo' => 'permit_empty|max_length[100]',
        'idGarantias_Equipos' => 'permit_empty|integer|is_not_unique[garantias.idGarantias]',
        'Modelo_Equipos' => 'required|max_length[100]',
        'DescripcionProblema_Equipos' => 'required|max_length[255]',
        'Accesorios_Equipos' => 'permit_empty|max_length[100]',
        'FechaIngreso_Equipos' => 'required|valid_date',
        'idEstados_Equipos' => 'required|integer|is_not_unique[estados.idEstados]',
        'NroOrden_Equipo' => 'permit_empty|max_length[45]',
        'NroBR_Equipo' => 'permit_empty|max_length[45]'
    ];

    protected $validationMessages = [
        'idClientes_Equipos' => [
            'required' => 'El cliente es requerido',
            'integer' => 'El ID del cliente debe ser un número entero',
            'is_not_unique' => 'El cliente especificado no existe'
        ],
        'idCategorias_Equipos' => [
            'required' => 'La categoría del equipo es requerida',
            'integer' => 'El ID de la categoría debe ser un número entero',
            'is_not_unique' => 'La categoría especificada no existe'
        ],
        'Marca_Equipo' => [
            'max_length' => 'La marca no puede exceder 100 caracteres'
        ],
        'idGarantias_Equipos' => [
            'integer' => 'El ID de la garantía debe ser un número entero',
            'is_not_unique' => 'La garantía especificada no existe'
        ],
        'Modelo_Equipos' => [
            'required' => 'El modelo del equipo es requerido',
            'max_length' => 'El modelo no puede exceder 100 caracteres'
        ],
        'FechaIngreso_Equipos' => [
            'required' => 'La fecha de ingreso es requerida',
            'valid_date' => 'La fecha de ingreso debe ser una fecha válida'
        ],
        'DescripcionProblema_Equipos' => [
            'required' => 'La descripción del problema es requerida',
            'max_length' => 'La descripción no puede exceder 255 caracteres'
        ],
        'Accesorios_Equipos' => [
            'max_length' => 'Los accesorios no pueden exceder 100 caracteres'
        ],
        'idEstados_Equipos' => [
            'required' => 'El estado del equipo es requerido',
            'integer' => 'El ID del estado debe ser un número entero',
            'is_not_unique' => 'El estado especificado no existe'
        ],
        'NroOrden_Equipo' => [
            'max_length' => 'El número de orden no puede exceder 45 caracteres'
        ],
        'NroBR_Equipo' => [
            'max_length' => 'El número BR no puede exceder 45 caracteres'
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
     * Obtener equipos con detalles de relaciones
     */
    public function getEquiposWithDetails()
    {
        return $this->select('
            equipos.*,
            clientes.Nombres_Clientes,
            clientes.Apellidos_Clientes,
            clientes.DNI_Clientes,
            categorias_equipos.Nombres_Categorias,
            garantias.Descripcion_Garantias,
            estados.Descripcion_Estados
        ')
        ->join('clientes', 'clientes.idClientes = equipos.idClientes_Equipos')
        ->join('categorias_equipos', 'categorias_equipos.idCategorias = equipos.idCategorias_Equipos')
        ->join('garantias', 'garantias.idGarantias = equipos.idGarantias_Equipos', 'left')
        ->join('estados', 'estados.idEstados = equipos.idEstados_Equipos')
        ->orderBy('equipos.FechaIngreso_Equipos', 'DESC')
        ->findAll();
    }

    /**
     * Obtener un equipo específico con detalles
     */
    public function getEquipoWithDetails($id)
    {
        return $this->select('
            equipos.*,
            clientes.Nombres_Clientes,
            clientes.Apellidos_Clientes,
            clientes.DNI_Clientes,
            clientes.Telefono_Clientes,
            clientes.Email_Clientes,
            clientes.Direccion_Clientes,
            categorias_equipos.Nombres_Categorias,
            garantias.Descripcion_Garantias,
            estados.Descripcion_Estados
        ')
        ->join('clientes', 'clientes.idClientes = equipos.idClientes_Equipos')
        ->join('categorias_equipos', 'categorias_equipos.idCategorias = equipos.idCategorias_Equipos')
        ->join('garantias', 'garantias.idGarantias = equipos.idGarantias_Equipos', 'left')
        ->join('estados', 'estados.idEstados = equipos.idEstados_Equipos')
        ->find($id);
    }

    /**
     * Obtener equipos por cliente
     */
    public function getEquiposByCliente($clienteId)
    {
        return $this->select('
            equipos.*,
            categorias_equipos.Nombres_Categorias,
            garantias.Descripcion_Garantias,
            estados.Descripcion_Estados
        ')
        ->join('categorias_equipos', 'categorias_equipos.idCategorias = equipos.idCategorias_Equipos')
        ->join('garantias', 'garantias.idGarantias = equipos.idGarantias_Equipos', 'left')
        ->join('estados', 'estados.idEstados = equipos.idEstados_Equipos')
        ->where('equipos.idClientes_Equipos', $clienteId)
        ->orderBy('equipos.FechaIngreso_Equipos', 'DESC')
        ->findAll();
    }

    /**
     * Buscar equipos
     */
    public function searchEquipos($searchTerm, $searchType = null)
    {
        $builder = $this->select('
            equipos.*,
            clientes.Nombres_Clientes,
            clientes.Apellidos_Clientes,
            clientes.DNI_Clientes,
            categorias_equipos.Nombres_Categorias,
            garantias.Descripcion_Garantias,
            estados.Descripcion_Estados
        ')
        ->join('clientes', 'clientes.idClientes = equipos.idClientes_Equipos')
        ->join('categorias_equipos', 'categorias_equipos.idCategorias = equipos.idCategorias_Equipos')
        ->join('garantias', 'garantias.idGarantias = equipos.idGarantias_Equipos', 'left')
        ->join('estados', 'estados.idEstados = equipos.idEstados_Equipos');

        switch ($searchType) {
            case 'modelo':
                $builder->like('equipos.Modelo_Equipos', $searchTerm);
                break;
            case 'cliente':
                $builder->groupStart()
                    ->like('clientes.Nombres_Clientes', $searchTerm)
                    ->orLike('clientes.Apellidos_Clientes', $searchTerm)
                    ->orLike('clientes.DNI_Clientes', $searchTerm)
                    ->groupEnd();
                break;
            default:
                $builder->groupStart()
                    ->like('equipos.Modelo_Equipos', $searchTerm)
                    ->orLike('clientes.Nombres_Clientes', $searchTerm)
                    ->orLike('clientes.Apellidos_Clientes', $searchTerm)
                    ->orLike('clientes.DNI_Clientes', $searchTerm)
                    ->orLike('categorias_equipos.Nombres_Categorias', $searchTerm)
                    ->groupEnd();
                break;
        }

        return $builder->orderBy('equipos.FechaIngreso_Equipos', 'DESC')->findAll();
    }

    /**
     * Obtener estadísticas de equipos
     */
    public function getStats()
    {
        $db = \Config\Database::connect();
        
        // Total de equipos
        $totalEquipos = $this->countAll();
        
        // Equipos por categoría
        $equiposPorCategoria = $db->query("
            SELECT 
                c.Nombres_Categorias,
                COUNT(e.idEquipos) as total
            FROM categorias_equipos c
            LEFT JOIN equipos e ON c.idCategorias = e.idCategorias_Equipos
            GROUP BY c.idCategorias, c.Nombres_Categorias
            ORDER BY total DESC
        ")->getResultArray();
        
        // Equipos por mes (últimos 12 meses)
        $equiposPorMes = $db->query("
            SELECT 
                DATE_FORMAT(FechaIngreso_Equipos, '%Y-%m') as mes,
                COUNT(*) as total
            FROM equipos
            WHERE FechaIngreso_Equipos >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
            GROUP BY DATE_FORMAT(FechaIngreso_Equipos, '%Y-%m')
            ORDER BY mes DESC
        ")->getResultArray();
        
        // Modelos más comunes
        $modelosMasComunes = $db->query("
            SELECT 
                Modelo_Equipos,
                COUNT(*) as total
            FROM equipos
            GROUP BY Modelo_Equipos
            ORDER BY total DESC
            LIMIT 10
        ")->getResultArray();
        
        return [
            'total_equipos' => $totalEquipos,
            'equipos_por_categoria' => $equiposPorCategoria,
            'equipos_por_mes' => $equiposPorMes,
            'modelos_mas_comunes' => $modelosMasComunes
        ];
    }

    /**
     * Obtener equipos recientes
     */
    public function getRecentEquipos($limit = 10)
    {
        $query = $this->select('
            equipos.*,
            clientes.Nombres_Clientes,
            clientes.Apellidos_Clientes,
            clientes.DNI_Clientes,
            categorias_equipos.Nombres_Categorias,
            garantias.Descripcion_Garantias,
            estados.Descripcion_Estados
        ')
        ->join('clientes', 'clientes.idClientes = equipos.idClientes_Equipos')
        ->join('categorias_equipos', 'categorias_equipos.idCategorias = equipos.idCategorias_Equipos')
        ->join('garantias', 'garantias.idGarantias = equipos.idGarantias_Equipos', 'left')
        ->join('estados', 'estados.idEstados = equipos.idEstados_Equipos')
        ->orderBy('equipos.FechaIngreso_Equipos', 'DESC');
        
        return $query
                   ->limit($limit);
    }

    /**
     * Obtener equipos por rango de fechas
     */
    public function getEquiposByDateRange($fechaInicio, $fechaFin)
    {
        return $this->select('
            equipos.*,
            clientes.Nombres_Clientes,
            clientes.Apellidos_Clientes,
            categorias_equipos.Nombres_Categorias
        ')
        ->join('clientes', 'clientes.idClientes = equipos.idClientes_Equipos')
        ->join('categorias_equipos', 'categorias_equipos.idCategorias = equipos.idCategorias_Equipos')
        ->where('equipos.FechaIngreso_Equipos >=', $fechaInicio)
        ->where('equipos.FechaIngreso_Equipos <=', $fechaFin)
        ->orderBy('equipos.FechaIngreso_Equipos', 'DESC')
        ->findAll();
    }

    /**
     * Obtener marcas/modelos únicos de equipos
     */
    public function getMarcasUnicas()
    {
        return $this->select('DISTINCT Modelo_Equipos as marca')
                   ->where('Modelo_Equipos IS NOT NULL')
                   ->where('Modelo_Equipos !=', '')
                   ->orderBy('Modelo_Equipos', 'ASC')
                   ->findAll();
    }
}