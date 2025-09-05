<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MigrationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'version' => '2025-01-26-200000',
                'class' => 'App\\Database\\Migrations\\CreateRolesTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200001',
                'class' => 'App\\Database\\Migrations\\CreateCategoriasEquiposTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200002',
                'class' => 'App\\Database\\Migrations\\CreateGarantiasTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200003',
                'class' => 'App\\Database\\Migrations\\CreateProveedorTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200004',
                'class' => 'App\\Database\\Migrations\\CreateEstadosTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200005',
                'class' => 'App\\Database\\Migrations\\CreateClientesTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200006',
                'class' => 'App\\Database\\Migrations\\CreateUsuariosTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200007',
                'class' => 'App\\Database\\Migrations\\CreateEquiposTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200008',
                'class' => 'App\\Database\\Migrations\\CreateEquiposHasProveedorTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200009',
                'class' => 'App\\Database\\Migrations\\CreateFacturaTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200010',
                'class' => 'App\\Database\\Migrations\\CreateFotosEquiposTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200011',
                'class' => 'App\\Database\\Migrations\\CreatePresupuestoTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ],
            [
                'version' => '2025-01-26-200012',
                'class' => 'App\\Database\\Migrations\\CreateRepuestoTable',
                'group' => 'default',
                'namespace' => 'App',
                'time' => '20:25:00',
                'batch' => 1
            ]
        ];

        $this->db->table('migrations')->insertBatch($data);
    }
}
