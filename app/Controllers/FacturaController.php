<?php

namespace App\Controllers;

use App\Models\FacturaModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class FacturaController extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\\Models\\FacturaModel';
    protected $format = 'json';

    /**
     * Obtener todas las facturas
     */
    public function index()
    {
        try {
            $facturaModel = new FacturaModel();
            $facturas = $facturaModel->select('factura.*, equipos.Modelo_Equipos, equipos.Marca_Equipo, clientes.Nombres_Clientes, clientes.Apellidos_Clientes')
                                   ->join('equipos', 'equipos.idEquipos = factura.idEquipo_Factura')
                                   ->join('clientes', 'clientes.idClientes = equipos.idClientes_Equipos')
                                   ->findAll();
            
            return $this->respond([
                'success' => true,
                'data' => $facturas
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener facturas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener una factura específica
     */
    public function show($id = null)
    {
        try {
            $facturaModel = new FacturaModel();
            $factura = $facturaModel->getFacturaWithDetails($id);
            
            if (!$factura) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Factura no encontrada'
                ], 404);
            }
            
            return $this->respond([
                'success' => true,
                'data' => $factura
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener factura: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear nueva factura
     */
    public function create()
    {
        try {
            $data = $this->request->getJSON(true);
            
            if (!$data) {
                $data = $this->request->getPost();
            }
            
            if (!$data) {
                return $this->respond([
                    'success' => false,
                    'message' => 'No se recibieron datos'
                ], 400);
            }
            
            $facturaModel = new FacturaModel();
            
            // Validar datos
            if (!$facturaModel->validate($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Datos inválidos',
                    'errors' => $facturaModel->errors()
                ], 400);
            }
            
            $facturaId = $facturaModel->insert($data);
            
            if ($facturaId) {
                $factura = $facturaModel->getFacturaWithDetails($facturaId);
                return $this->respond([
                    'success' => true,
                    'data' => $factura,
                    'message' => 'Factura registrada exitosamente'
                ], 201);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al registrar factura'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al registrar factura: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar factura
     */
    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON(true);
            
            if (!$data) {
                $data = $this->request->getPost();
            }
            
            if (!$data) {
                return $this->respond([
                    'success' => false,
                    'message' => 'No se recibieron datos'
                ], 400);
            }
            
            $facturaModel = new FacturaModel();
            
            // Verificar que la factura existe
            if (!$facturaModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Factura no encontrada'
                ], 404);
            }
            
            // Validar datos
            if (!$facturaModel->validate($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Datos inválidos',
                    'errors' => $facturaModel->errors()
                ], 400);
            }
            
            if ($facturaModel->update($id, $data)) {
                $factura = $facturaModel->getFacturaWithDetails($id);
                return $this->respond([
                    'success' => true,
                    'data' => $factura,
                    'message' => 'Factura actualizada exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al actualizar factura'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al actualizar factura: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar factura
     */
    public function delete($id = null)
    {
        try {
            $facturaModel = new FacturaModel();
            
            // Verificar que la factura existe
            if (!$facturaModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Factura no encontrada'
                ], 404);
            }
            
            if ($facturaModel->delete($id)) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Factura eliminada exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al eliminar factura'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al eliminar factura: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener facturas por equipo
     */
    public function getByEquipo($equipoId)
    {
        try {
            $facturaModel = new FacturaModel();
            $facturas = $facturaModel->getFacturasByEquipo($equipoId);
            
            return $this->respond([
                'success' => true,
                'data' => $facturas
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener facturas: ' . $e->getMessage()
            ], 500);
        }
    }
}