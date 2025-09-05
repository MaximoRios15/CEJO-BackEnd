<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEstadosTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idEstados' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'Descripcion_Estados' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idEstados', true);
        $this->forge->createTable('estados');

        // Insertar datos iniciales básicos
        $data = [
            ['idEstados' => 1, 'Descripcion_Estados' => 'Recibido'],
            ['idEstados' => 2, 'Descripcion_Estados' => 'En diagnóstico'],
            ['idEstados' => 3, 'Descripcion_Estados' => 'En reparación'],
            ['idEstados' => 4, 'Descripcion_Estados' => 'Esperando repuestos'],
            ['idEstados' => 5, 'Descripcion_Estados' => 'Reparado'],
            ['idEstados' => 6, 'Descripcion_Estados' => 'Entregado'],
            ['idEstados' => 7, 'Descripcion_Estados' => 'Sin reparación'],
        ];

        $this->db->table('estados')->insertBatch($data);
    }

    public function down(): void
    {
        $this->forge->dropTable('estados');
    }
}