<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'idClientes';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'Nombres_Clientes',
        'Apellidos_Clientes', 
        'DNI_Clientes',
        'Telefono_Clientes',
        'Email_Clientes',
        'Direccion_Clientes',
        'CodigoPostal_Clientes',
        'Ciudad_Clientes',
        'Provincia_Clientes',
        'Activo_Clientes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'FechaRegistro_Clientes';
    protected $updatedField = '';
    protected $deletedField = '';

    // Validation
    protected $validationRules = [
        'Nombres_Clientes' => 'required|max_length[100]',
        'Apellidos_Clientes' => 'required|max_length[100]',
        'DNI_Clientes' => 'required|max_length[10]|is_unique[clientes.DNI_Clientes,idClientes,{idClientes}]',
        'Telefono_Clientes' => 'required|max_length[13]',
        'Email_Clientes' => 'permit_empty|valid_email|max_length[100]|is_unique[clientes.Email_Clientes,idClientes,{idClientes}]',
        'Direccion_Clientes' => 'required|max_length[255]',
        'CodigoPostal_Clientes' => 'permit_empty|max_length[10]',
        'Ciudad_Clientes' => 'required|max_length[75]',
        'Provincia_Clientes' => 'required|max_length[75]'
    ];

    protected $validationMessages = [
        'Nombres_Clientes' => [
            'required' => 'El nombre es obligatorio',
            'max_length' => 'El nombre no puede exceder 100 caracteres'
        ],
        'Apellidos_Clientes' => [
            'required' => 'El apellido es obligatorio',
            'max_length' => 'El apellido no puede exceder 100 caracteres'
        ],
        'DNI_Clientes' => [
            'required' => 'El DNI es obligatorio',
            'max_length' => 'El DNI no puede exceder 10 caracteres',
            'is_unique' => 'Este DNI ya está registrado'
        ],
        'Telefono_Clientes' => [
            'required' => 'El teléfono es obligatorio',
            'max_length' => 'El teléfono no puede exceder 13 caracteres'
        ],
        'Email_Clientes' => [
            'valid_email' => 'Debe ingresar un email válido',
            'max_length' => 'El email no puede exceder 100 caracteres',
            'is_unique' => 'Este email ya está registrado'
        ],
        'Direccion_Clientes' => [
            'required' => 'La dirección es obligatoria',
            'max_length' => 'La dirección no puede exceder 255 caracteres'
        ],
        'Ciudad_Clientes' => [
            'required' => 'La ciudad es obligatoria',
            'max_length' => 'La ciudad no puede exceder 75 caracteres'
        ],
        'Provincia_Clientes' => [
            'required' => 'La provincia es obligatoria',
            'max_length' => 'La provincia no puede exceder 75 caracteres'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['setActiveStatus'];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Establece el estado activo por defecto antes de insertar
     */
    protected function setActiveStatus(array $data)
    {
        if (!isset($data['data']['Activo_Clientes'])) {
            $data['data']['Activo_Clientes'] = 1;
        }
        return $data;
    }

    /**
     * Buscar cliente por DNI
     */
    public function buscarPorDNI($dni)
    {
        return $this->where('DNI_Clientes', $dni)
                    ->where('Activo_Clientes', 1)
                    ->first();
    }

    /**
     * Buscar clientes por nombre o apellido
     */
    public function buscarPorNombre($termino)
    {
        return $this->groupStart()
                    ->like('Nombres_Clientes', $termino)
                    ->orLike('Apellidos_Clientes', $termino)
                    ->groupEnd()
                    ->where('Activo_Clientes', 1)
                    ->findAll();
    }

    /**
     * Obtener todos los clientes activos
     */
    public function obtenerClientesActivos()
    {
        return $this->where('Activo_Clientes', 1)
                    ->orderBy('FechaRegistro_Clientes', 'DESC')
                    ->findAll();
    }

    /**
     * Desactivar cliente (soft delete)
     */
    public function desactivarCliente($id)
    {
        return $this->update($id, ['Activo_Clientes' => 0]);
    }

    /**
     * Activar cliente
     */
    public function activarCliente($id)
    {
        return $this->update($id, ['Activo_Clientes' => 1]);
    }
}