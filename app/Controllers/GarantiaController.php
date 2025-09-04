<?php

namespace App\Controllers;

use App\Models\GarantiaModel;
use CodeIgniter\RESTful\ResourceController;

class GarantiaController extends ResourceController
{
    protected $modelName = 'App\Models\GarantiaModel';
    protected $format = 'json';

    /**
     * Obtener todas las garantías
     */
    public function index()
    {
        try {
            $garantiaModel = new GarantiaModel();
            $garantias = $garantiaModel->orderBy('Descripcion_Garantias', 'ASC')->findAll();
            
            return $this->respond([
                'success' => true,
                'data' => $garantias,
                'message' => 'Garantías obtenidas exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener garantías: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener una garantía específica
     */
    public function show($id = null)
    {
        try {
            $garantiaModel = new GarantiaModel();
            $garantia = $garantiaModel->find($id);
            
            if (!$garantia) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Garantía no encontrada'
                ], 404);
            }
            
            return $this->respond([
                'success' => true,
                'data' => $garantia,
                'message' => 'Garantía obtenida exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener garantía: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear nueva garantía
     */
    public function create()
    {
        try {
            $data = json_decode($this->request->getBody(), true);
            
            if (!$data) {
                return $this->respond([
                    'success' => false,
                    'message' => 'No se recibieron datos'
                ], 400);
            }
            
            $garantiaModel = new GarantiaModel();
            
            // Validar datos
            if (!$garantiaModel->validate($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Datos inválidos',
                    'errors' => $garantiaModel->errors()
                ], 400);
            }
            
            $garantiaId = $garantiaModel->insert($data);
            
            if ($garantiaId) {
                $garantia = $garantiaModel->find($garantiaId);
                return $this->respond([
                    'success' => true,
                    'data' => $garantia,
                    'message' => 'Garantía creada exitosamente'
                ], 201);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al crear garantía'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al crear garantía: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar garantía
     */
    public function update($id = null)
    {
        try {
            $data = json_decode($this->request->getBody(), true);
            
            if (!$data) {
                return $this->respond([
                    'success' => false,
                    'message' => 'No se recibieron datos'
                ], 400);
            }
            
            $garantiaModel = new GarantiaModel();
            
            // Verificar que la garantía existe
            if (!$garantiaModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Garantía no encontrada'
                ], 404);
            }
            
            // Validar datos
            if (!$garantiaModel->validate($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Datos inválidos',
                    'errors' => $garantiaModel->errors()
                ], 400);
            }
            
            if ($garantiaModel->update($id, $data)) {
                $garantia = $garantiaModel->find($id);
                return $this->respond([
                    'success' => true,
                    'data' => $garantia,
                    'message' => 'Garantía actualizada exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al actualizar garantía'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al actualizar garantía: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar garantía
     */
    public function delete($id = null)
    {
        try {
            $garantiaModel = new GarantiaModel();
            
            // Verificar que la garantía existe
            if (!$garantiaModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Garantía no encontrada'
                ], 404);
            }
            
            // Verificar si la garantía está en uso
            if ($garantiaModel->isInUse($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'No se puede eliminar la garantía porque está siendo utilizada por equipos'
                ], 400);
            }
            
            if ($garantiaModel->delete($id)) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Garantía eliminada exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al eliminar garantía'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al eliminar garantía: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar garantías por descripción
     */
    public function search()
    {
        try {
            // Método alternativo para obtener parámetros GET
            $searchTerm = $this->request->getVar('q');
            
            if (!$searchTerm) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Término de búsqueda requerido'
                ], 400);
            }
            
            $garantiaModel = new GarantiaModel();
            $garantias = $garantiaModel->searchByDescription($searchTerm);
            
            return $this->respond([
                'success' => true,
                'data' => $garantias,
                'message' => 'Búsqueda completada exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error en la búsqueda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas de garantías
     */
    public function stats()
    {
        try {
            $garantiaModel = new GarantiaModel();
            $stats = $garantiaModel->getStats();
            
            return $this->respond([
                'success' => true,
                'data' => $stats,
                'message' => 'Estadísticas obtenidas exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener estadísticas: ' . $e->getMessage()
            ], 500);
        }
    }
}