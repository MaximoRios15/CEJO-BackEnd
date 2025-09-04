<?php

namespace App\Controllers;

use App\Models\EstadoModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class EstadoController extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\EstadoModel';
    protected $format = 'json';

    public function __construct()
    {
        $this->model = new EstadoModel();
    }

    /**
     * Obtener todos los estados
     * GET /estados
     */
    public function index()
    {
        try {
            $estados = $this->model->findAll();
            
            return $this->respond([
                'success' => true,
                'message' => 'Estados obtenidos exitosamente',
                'data' => $estados
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al obtener estados: ' . $e->getMessage());
        }
    }

    /**
     * Crear estados por defecto si no existen
     * POST /estados/crear-defecto
     */
    public function crearDefecto()
    {
        try {
            $estadosDefecto = [
                ['Descripcion_Estados' => 'Recibido'],
                ['Descripcion_Estados' => 'En Diagnóstico'],
                ['Descripcion_Estados' => 'En Reparación'],
                ['Descripcion_Estados' => 'En Pruebas'],
                ['Descripcion_Estados' => 'Completado'],
                ['Descripcion_Estados' => 'Entregado'],
                ['Descripcion_Estados' => 'Cancelado']
            ];

            $insertados = 0;
            foreach ($estadosDefecto as $estado) {
                // Verificar si ya existe
                $existente = $this->model->where('Descripcion_Estados', $estado['Descripcion_Estados'])->first();
                if (!$existente) {
                    $this->model->insert($estado);
                    $insertados++;
                }
            }

            return $this->respond([
                'success' => true,
                'message' => "Estados creados exitosamente. Insertados: $insertados",
                'data' => $this->model->findAll()
            ]);
        } catch (\Exception $e) {
            return $this->failServerError('Error al crear estados: ' . $e->getMessage());
        }
    }
}