<?php

namespace App\Models;

use CodeIgniter\Model;

class FacturaModel extends Model
{
    protected $table = 'factura';
    protected $primaryKey = 'idFactura';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'idEquipo_Factura',
        'FechaCompra_Factura',
        'NroFactura_Factura',
        'Comercio_Factura',
        'Localidad_Factura',
        'Pagador_Factura',
        'FechaRegistro_Factura',
        'Monto_Factura',
        'Fecha_Salida_Factura',
        'Fecha_Entrada_Factura'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'FechaRegistro_Factura';
    protected $updatedField = '';
    protected $deletedField = '';

    // Validation
    protected $validationRules = [
        'idEquipo_Factura' => 'required|integer|is_not_unique[equipos.idEquipos]',
        'FechaCompra_Factura' => 'permit_empty|valid_date',
        'NroFactura_Factura' => 'required|integer',
        'Comercio_Factura' => 'required|max_length[75]',
        'Localidad_Factura' => 'required|max_length[75]',
        'Pagador_Factura' => 'required|max_length[75]',
        'Monto_Factura' => 'permit_empty|decimal',
        'Fecha_Salida_Factura' => 'permit_empty|valid_date',
        'Fecha_Entrada_Factura' => 'permit_empty|valid_date'
    ];

    protected $validationMessages = [
        'idEquipo_Factura' => [
            'required' => 'El equipo es requerido',
            'integer' => 'El ID del equipo debe ser un número entero',
            'is_not_unique' => 'El equipo especificado no existe'
        ],
        'FechaCompra_Factura' => [
            'valid_date' => 'La fecha de compra debe ser una fecha válida'
        ],
        'NroFactura_Factura' => [
            'required' => 'El número de factura es requerido',
            'integer' => 'El número de factura debe ser un número entero'
        ],
        'Comercio_Factura' => [
            'required' => 'El comercio es requerido',
            'max_length' => 'El comercio no puede exceder 75 caracteres'
        ],
        'Localidad_Factura' => [
            'required' => 'La localidad es requerida',
            'max_length' => 'La localidad no puede exceder 75 caracteres'
        ],
        'Pagador_Factura' => [
            'required' => 'El pagador es requerido',
            'max_length' => 'El pagador no puede exceder 75 caracteres'
        ],
        'Monto_Factura' => [
            'decimal' => 'El monto debe ser un número decimal válido'
        ],
        'Fecha_Salida_Factura' => [
            'valid_date' => 'La fecha de salida debe ser una fecha válida'
        ],
        'Fecha_Entrada_Factura' => [
            'valid_date' => 'La fecha de entrada debe ser una fecha válida'
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
     * Obtener factura con detalles del equipo
     */
    public function getFacturaWithDetails($id)
    {
        return $this->select('factura.*, equipos.Modelo_Equipos, equipos.Marca_Equipo, clientes.Nombres_Clientes, clientes.Apellidos_Clientes')
                    ->join('equipos', 'equipos.idEquipos = factura.idEquipo_Factura')
                    ->join('clientes', 'clientes.idClientes = equipos.idClientes_Equipos')
                    ->where('factura.idFactura', $id)
                    ->first();
    }

    /**
     * Obtener facturas por equipo
     */
    public function getFacturasByEquipo($equipoId)
    {
        return $this->where('idEquipo_Factura', $equipoId)->findAll();
    }
}