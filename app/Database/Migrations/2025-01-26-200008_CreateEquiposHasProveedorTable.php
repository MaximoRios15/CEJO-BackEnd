<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEquiposHasProveedorTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'equipos_idEquipos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'Proveedor_idProveedor' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
        ]);

        $this->forge->addKey(['equipos_idEquipos', 'Proveedor_idProveedor'], true);
        $this->forge->addForeignKey('equipos_idEquipos', 'equipos', 'idEquipos', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('Proveedor_idProveedor', 'proveedor', 'idProveedor', 'CASCADE', 'CASCADE');
        $this->forge->createTable('equipos_has_proveedor');
    }

    public function down(): void
    {
        $this->forge->dropTable('equipos_has_proveedor');
    }
}