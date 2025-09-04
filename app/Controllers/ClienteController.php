<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ClienteController extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\ClienteModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->model = new ClienteModel();
    }

    /**
     * Obtener todos los clientes activos
     * GET /clientes
     */
    public function index()
    {
        try {
            $clientes = $this->model->obtenerClientesActivos();
            
            return $this->respond([
                'success' => true,
                'message' => 'Clientes obtenidos exitosamente',
                'data' => $clientes
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al obtener clientes: ' . $e->getMessage());
        }
    }

    /**
     * Obtener un cliente específico
     * GET /clientes/{id}
     */
    public function show($id = null)
    {
        try {
            if ($id === null) {
                return $this->fail('ID de cliente requerido', 400);
            }

            $cliente = $this->model->find($id);
            
            if (!$cliente) {
                return $this->failNotFound('Cliente no encontrado');
            }

            return $this->respond([
                'success' => true,
                'message' => 'Cliente obtenido exitosamente',
                'data' => $cliente
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al obtener cliente: ' . $e->getMessage());
        }
    }

    /**
     * Crear un nuevo cliente
     * POST /clientes
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
                return $this->fail('No se recibieron datos', 400);
            }

            // Validar datos
            if (!$this->model->validate($data)) {
                return $this->failValidationErrors($this->model->errors());
            }

            // Insertar cliente
            $clienteId = $this->model->insert($data);
            
            if (!$clienteId) {
                return $this->failServerError('Error al crear cliente');
            }

            // Obtener el cliente creado
            $cliente = $this->model->find($clienteId);

            return $this->respondCreated([
                'success' => true,
                'message' => 'Cliente creado exitosamente',
                'data' => $cliente
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al crear cliente: ' . $e->getMessage());
        }
    }

    /**
     * Actualizar un cliente existente
     * PUT /clientes/{id}
     */
    public function update($id = null)
    {
        try {
            if ($id === null) {
                return $this->fail('ID de cliente requerido', 400);
            }

            $cliente = $this->model->find($id);
            if (!$cliente) {
                return $this->failNotFound('Cliente no encontrado');
            }

            $data = json_decode($this->request->getBody(), true);
            if (empty($data)) {
                $data = $this->request->getVar(null);
                $data = json_decode($data, true);
            }

            if (empty($data)) {
                return $this->fail('No se recibieron datos para actualizar', 400);
            }

            // Validar datos
            if (!$this->model->validate($data)) {
                return $this->failValidationErrors($this->model->errors());
            }

            // Actualizar cliente
            $updated = $this->model->update($id, $data);
            
            if (!$updated) {
                return $this->failServerError('Error al actualizar cliente');
            }

            // Obtener el cliente actualizado
            $clienteActualizado = $this->model->find($id);

            return $this->respond([
                'success' => true,
                'message' => 'Cliente actualizado exitosamente',
                'data' => $clienteActualizado
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al actualizar cliente: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar (desactivar) un cliente
     * DELETE /clientes/{id}
     */
    public function delete($id = null)
    {
        try {
            if ($id === null) {
                return $this->fail('ID de cliente requerido', 400);
            }

            $cliente = $this->model->find($id);
            if (!$cliente) {
                return $this->failNotFound('Cliente no encontrado');
            }

            // Desactivar cliente en lugar de eliminarlo
            $desactivado = $this->model->desactivarCliente($id);
            
            if (!$desactivado) {
                return $this->failServerError('Error al desactivar cliente');
            }

            return $this->respondDeleted([
                'success' => true,
                'message' => 'Cliente desactivado exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al desactivar cliente: ' . $e->getMessage());
        }
    }

    /**
     * Buscar cliente por DNI
     * GET /clientes/buscar-dni/{dni}
     */
    public function buscarPorDNI($dni = null)
    {
        try {
            if ($dni === null) {
                return $this->fail('DNI requerido', 400);
            }

            $cliente = $this->model->buscarPorDNI($dni);
            
            if (!$cliente) {
                return $this->respond([
                    'success' => false,
                    'message' => 'Cliente no encontrado',
                    'data' => null
                ]);
            }

            return $this->respond([
                'success' => true,
                'message' => 'Cliente encontrado',
                'data' => $cliente
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al buscar cliente: ' . $e->getMessage());
        }
    }

    /**
     * Buscar clientes por nombre
     * GET /clientes/buscar-nombre/{termino}
     */
    public function buscarPorNombre($termino = null)
    {
        try {
            if ($termino === null) {
                return $this->fail('Término de búsqueda requerido', 400);
            }

            $clientes = $this->model->buscarPorNombre($termino);
            
            return $this->respond([
                'success' => true,
                'message' => 'Búsqueda completada',
                'data' => $clientes,
                'count' => count($clientes)
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al buscar clientes: ' . $e->getMessage());
        }
    }

    /**
     * Activar un cliente
     * PUT /clientes/{id}/activar
     */
    public function activar($id = null)
    {
        try {
            if ($id === null) {
                return $this->fail('ID de cliente requerido', 400);
            }

            $cliente = $this->model->find($id);
            if (!$cliente) {
                return $this->failNotFound('Cliente no encontrado');
            }

            $activado = $this->model->activarCliente($id);
            
            if (!$activado) {
                return $this->failServerError('Error al activar cliente');
            }

            return $this->respond([
                'success' => true,
                'message' => 'Cliente activado exitosamente'
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al activar cliente: ' . $e->getMessage());
        }
    }
}