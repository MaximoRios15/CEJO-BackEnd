<?php

namespace App\Controllers;

use App\Models\CategoriaEquipoModel;
use CodeIgniter\RESTful\ResourceController;

class CategoriaEquipoController extends ResourceController
{
    protected $modelName = 'App\Models\CategoriaEquipoModel';
    protected $format = 'json';

    /**
     * Obtener todas las categorías de equipos activas
     */
    public function index()
    {
        try {
            $categoriaModel = new CategoriaEquipoModel();
            $categorias = $categoriaModel->where('Activo_Categorias', 1)->findAll();
            
            return $this->respond([
                'success' => true,
                'data' => $categorias,
                'message' => 'Categorías obtenidas exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener categorías: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener una categoría específica
     */
    public function show($id = null)
    {
        try {
            $categoriaModel = new CategoriaEquipoModel();
            $categoria = $categoriaModel->find($id);
            
            if (!$categoria) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Categoría no encontrada'
                ], 404);
            }
            
            return $this->respond([
                'success' => true,
                'data' => $categoria,
                'message' => 'Categoría obtenida exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al obtener categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear nueva categoría
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
            
            $categoriaModel = new CategoriaEquipoModel();
            
            // Validar datos
            if (!$categoriaModel->validate($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Datos inválidos',
                    'errors' => $categoriaModel->errors()
                ], 400);
            }
            
            $categoriaId = $categoriaModel->insert($data);
            
            if ($categoriaId) {
                $categoria = $categoriaModel->find($categoriaId);
                return $this->respond([
                    'success' => true,
                    'data' => $categoria,
                    'message' => 'Categoría creada exitosamente'
                ], 201);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al crear categoría'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al crear categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar categoría
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
            
            $categoriaModel = new CategoriaEquipoModel();
            
            // Verificar que la categoría existe
            if (!$categoriaModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Categoría no encontrada'
                ], 404);
            }
            
            // Validar datos
            if (!$categoriaModel->validate($data)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Datos inválidos',
                    'errors' => $categoriaModel->errors()
                ], 400);
            }
            
            if ($categoriaModel->update($id, $data)) {
                $categoria = $categoriaModel->find($id);
                return $this->respond([
                    'success' => true,
                    'data' => $categoria,
                    'message' => 'Categoría actualizada exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al actualizar categoría'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al actualizar categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar categoría (desactivar)
     */
    public function delete($id = null)
    {
        try {
            $categoriaModel = new CategoriaEquipoModel();
            
            // Verificar que la categoría existe
            if (!$categoriaModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Categoría no encontrada'
                ], 404);
            }
            
            // Desactivar en lugar de eliminar
            if ($categoriaModel->update($id, ['Estado_Categoria' => 0])) {
                return $this->respond([
                    'success' => true,
                    'message' => 'Categoría desactivada exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al desactivar categoría'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al desactivar categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Activar categoría
     */
    public function activate($id = null)
    {
        try {
            $categoriaModel = new CategoriaEquipoModel();
            
            // Verificar que la categoría existe
            if (!$categoriaModel->find($id)) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Categoría no encontrada'
                ], 404);
            }
            
            if ($categoriaModel->update($id, ['Estado_Categoria' => 1])) {
                $categoria = $categoriaModel->find($id);
                return $this->respond([
                    'success' => true,
                    'data' => $categoria,
                    'message' => 'Categoría activada exitosamente'
                ]);
            } else {
                return $this->respond([
                    'success' => false,
                    'message' => 'Error al activar categoría'
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->respond([
                'success' => false,
                'message' => 'Error al activar categoría: ' . $e->getMessage()
            ], 500);
        }
    }
}