<?php

namespace App\Controllers;

use App\Models\EquipoModel;
use CodeIgniter\RESTful\ResourceController;

class EquipoController extends ResourceController
{
    protected $modelName = 'App\Models\EquipoModel';
    protected $format = 'json';

    /**
     * Obtener todos los equipos
     */
    public function index()
    {
        try {
            $equipoModel = new EquipoModel();
            $equipos = $equipoModel->getEquiposWithDetails();
            
            return $this->respond([
                'success' => true,
                'data' => $equipos,
                'message' => 'Equipos obtenidos exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener equipos: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener un equipo específico
     */
    public function show($id = null)
    {
        try {
            $equipoModel = new EquipoModel();
            $equipo = $equipoModel->getEquipoWithDetails($id);
            
            if (!$equipo) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Equipo no encontrado'
                ], 404);
            }
            
            return $this->respond([
                'success' => true,
                'data' => $equipo,
                'message' => 'Equipo obtenido exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener equipo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear nuevo equipo
     */
    public function create()
    {
        try {
            // Verificar el Content-Type para decidir cómo obtener los datos
            $contentType = $this->request->getHeaderLine('Content-Type');
            
            if (strpos($contentType, 'application/json') !== false) {
                // Contenido JSON
                try {
                    $data = $this->request->getJSON(true);
                } catch (\Exception $e) {
                    $data = null;
                }
            } else {
                // Datos de formulario
                $data = $this->request->getPost();
            }
            
            // Si no se obtuvieron datos de ninguna manera, intentar el cuerpo raw
            if (empty($data)) {
                $rawData = $this->request->getBody();
                if (!empty($rawData)) {
                    $data = json_decode($rawData, true);
                }
            }
            
            if (empty($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'No se recibieron datos'
                ], 400);
            }
            
            $equipoModel = new EquipoModel();
            
            // Validar datos
            if (!$equipoModel->validate($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Datos inválidos',
                    'errors' => $equipoModel->errors()
                ], 400);
            }
            
            $equipoId = $equipoModel->insert($data);
            
            if ($equipoId) {
                $equipo = $equipoModel->getEquipoWithDetails($equipoId);
                return $this->respond([
                    'success' => true,
                    'data' => $equipo,
                    'message' => 'Equipo registrado exitosamente'
                ], 201);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al registrar equipo'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al registrar equipo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar equipo
     */
    public function update($id = null)
    {
        try {
            $data = $this->request->getBody();
            
            if (!$data) {
                return $this->respond([
                    'success' => false,
                    'message' => 'No se recibieron datos'
                ], 400);
            }
            
            $equipoModel = new EquipoModel();
            
            // Verificar que el equipo existe
            if (!$equipoModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Equipo no encontrado'
                ], 404);
            }
            
            // Validar datos
            if (!$equipoModel->validate($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Datos inválidos',
                    'errors' => $equipoModel->errors()
                ], 400);
            }
            
            if ($equipoModel->update($id, $data)) {
                $equipo = $equipoModel->getEquipoWithDetails($id);
                return $this->respond([
                    'success' => true,
                    'data' => $equipo,
                    'message' => 'Equipo actualizado exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al actualizar equipo'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al actualizar equipo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar equipo
     */
    public function delete($id = null)
    {
        try {
            $equipoModel = new EquipoModel();
            
            // Verificar que el equipo existe
            if (!$equipoModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Equipo no encontrado'
                ], 404);
            }
            
            if ($equipoModel->delete($id)) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Equipo eliminado exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al eliminar equipo'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al eliminar equipo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Buscar equipos
     */
    public function search()
    {
        try {
            $searchTerm = $this->request->getVar('q');
            $searchType = $this->request->getVar('type'); // 'marca', 'modelo', 'cliente'
            
            if (!$searchTerm) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Término de búsqueda requerido'
                ], 400);
            }
            
            $equipoModel = new EquipoModel();
            $equipos = $equipoModel->searchEquipos($searchTerm, $searchType);
            
            return $this->respond([
                'success' => true,
                'data' => $equipos,
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
     * Obtener equipos por cliente
     */
    public function byClient($clienteId = null)
    {
        try {
            if (!$clienteId) {
                return $this->respond([
                    'success' => false,
                    'message' => 'ID de cliente requerido'
                ], 400);
            }
            
            $equipoModel = new EquipoModel();
            $equipos = $equipoModel->getEquiposByCliente($clienteId);
            
            return $this->respond([
                'success' => true,
                'data' => $equipos,
                'message' => 'Equipos del cliente obtenidos exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener equipos del cliente: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas de equipos
     */
    public function stats()
    {
        try {
            $equipoModel = new EquipoModel();
            $stats = $equipoModel->getStats();
            
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

    /**
     * Obtener marcas/modelos únicos de equipos
     */
    public function marcas()
    {
        try {
            $db = \Config\Database::connect();
            $query = $db->query("SELECT DISTINCT Modelo_Equipos as marca FROM equipos WHERE Modelo_Equipos IS NOT NULL AND Modelo_Equipos != '' ORDER BY Modelo_Equipos ASC");
            $marcas = $query->getResultArray();
            
            return $this->respond([
                'success' => true,
                'data' => $marcas,
                'message' => 'Marcas obtenidas exitosamente',
                'count' => count($marcas)
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener marcas: ' . $e->getMessage()
            ], 500);
        }
    }
}