<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePresupuestoTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idPresupuesto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'N_orden' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'presu_Precio' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idPresupuesto', true);
        $this->forge->createTable('presupuesto');
    }

    public function down(): void
    {
        $this->forge->dropTable('presupuesto');
    }
}