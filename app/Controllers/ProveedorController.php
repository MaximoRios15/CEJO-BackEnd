<?php

namespace App\Controllers;

use App\Models\ProveedorModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ProveedorController extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\\Models\\ProveedorModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->model = new ProveedorModel();
    }

    /**
     * Obtener todos los proveedores
     * GET /proveedores
     */
    public function index()
    {
        try {
            $proveedores = $this->model->getProveedoresActivos();
            
            return $this->respond([
                'success' => true,
                'data' => $proveedores
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al obtener proveedores: ' . $e->getMessage());
        }
    }

    /**
     * Obtener un proveedor específico
     * GET /proveedores/{id}
     */
    public function show($id = null)
    {
        try {
            $proveedor = $this->model->find($id);
            
            if (!$proveedor) {
                return $this->failNotFound('Proveedor no encontrado');
            }
            
            return $this->respond([
                'success' => true,
                'data' => $proveedor
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al obtener proveedor: ' . $e->getMessage());
        }
    }

    /**
     * Crear un nuevo proveedor
     * POST /proveedores
     */
    public function create()
    {
        try {
            // Determinar el tipo de contenido y obtener los datos
            $contentType = $this->request->getHeaderLine('Content-Type');
            
            if (strpos($contentType, 'application/json') !== false) {
                // Datos JSON
                $data = $this->request->getJSON(true);
            } else {
                // Datos de formulario
                $data = $this->request->getPost();
            }
            
            // Fallback si no se obtuvieron datos
            if (empty($data)) {
                $data = json_decode($this->request->getBody(), true);
            }
            
            if (empty($data)) {
                return $this->fail('No se recibieron datos válidos');
            }
            
            // Validar datos
            if (!$this->model->validate($data)) {
                return $this->failValidationErrors($this->model->errors());
            }
            
            // Verificar si ya existe un proveedor con ese nombre
            if ($this->model->existeProveedor($data['Nombre_Proveedor'])) {
                return $this->fail('Ya existe un proveedor con ese nombre');
            }
            
            // Insertar proveedor
            $proveedorId = $this->model->insert($data);
            
            if (!$proveedorId) {
                return $this->failServerError('Error al crear el proveedor');
            }
            
            // Obtener el proveedor creado
            $proveedor = $this->model->find($proveedorId);
            
            return $this->respondCreated([
                'success' => true,
                'message' => 'Proveedor creado exitosamente',
                'data' => $proveedor
            ]);
            
        } catch (\Exception $e) {
            return $this->failServerError('Error al crear proveedor: ' . $e->getMessage());
        }
    }

    /**
     * Actualizar un proveedor
     * PUT /proveedores/{id}
     */
    public function update($id = null)
    {
        try {
            // Verificar que el proveedor existe
            $proveedor = $this->model->find($id);
            if (!$proveedor) {
                return $this->failNotFound('Proveedor no encontrado');
            }
            
            // Determinar el tipo de contenido y obtener los datos
            $contentType = $this->request->getHeaderLine('Content-Type');
            
            if (strpos($contentType, 'application/json') !== false) {
                $data = $this->request->getJSON(true);
            } else {
                $data = $this->request->getRawInput();
            }
            
            if (empty($data)) {
                return $this->fail('No se recibieron datos válidos');
            }
            
            // Validar datos
            if (!$this->model->validate($data)) {
                return $this->failValidationErrors($this->model->errors());
            }
            
            // Verificar si ya existe otro proveedor con ese nombre
            if ($this->model->existeProveedor($data['Nombre_Proveedor'], $id)) {
                return $this->fail('Ya existe otro proveedor con ese nombre');
            }
            
            // Actualizar proveedor
            if (!$this->model->update($id, $data)) {
                return $this->failServerError('Error al actualizar el proveedor');
            }
            
            // Obtener el proveedor actualizado
            $proveedorActualizado = $this->model->find($id);
            
            return $this->respond([
                'success' => true,
                'message' => 'Proveedor actualizado exitosamente',
                'data' => $proveedorActualizado
            ]);
            
        } catch (\Exception $e) {
            return $this->failServerError('Error al actualizar proveedor: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar un proveedor
     * DELETE /proveedores/{id}
     */
    public function delete($id = null)
    {
        try {
            $proveedor = $this->model->find($id);
            
            if (!$proveedor) {
                return $this->failNotFound('Proveedor no encontrado');
            }
            
            if (!$this->model->delete($id)) {
                return $this->failServerError('Error al eliminar el proveedor');
            }
            
            return $this->respondDeleted([
                'success' => true,
                'message' => 'Proveedor eliminado exitosamente'
            ]);
            
        } catch (\Exception $e) {
            return $this->failServerError('Error al eliminar proveedor: ' . $e->getMessage());
        }
    }

    /**
     * Buscar proveedores por nombre
     * GET /proveedores/buscar/{nombre}
     */
    public function buscar($nombre = null)
    {
        try {
            if (!$nombre) {
                return $this->fail('Debe proporcionar un nombre para buscar');
            }
            
            $proveedores = $this->model->buscarPorNombre($nombre);
            
            return $this->respond([
                'success' => true,
                'data' => $proveedores
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al buscar proveedores: ' . $e->getMessage());
        }
    }
}