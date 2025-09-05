<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEquiposTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idEquipos' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'idClientes_Equipos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'idCategorias_Equipos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'Modelo_Equipos' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'DescripcionProblema_Equipos' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'idGarantias_Equipos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'Accesorios_Equipos' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'FechaIngreso_Equipos' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'idEstados_Equipos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'NroOrden_Equipo' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'NroBR_Equipo' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idEquipos', true);
        $this->forge->addForeignKey('idClientes_Equipos', 'clientes', 'idClientes', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idCategorias_Equipos', 'categorias_equipos', 'idCategorias', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idGarantias_Equipos', 'garantias', 'idGarantias', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idEstados_Equipos', 'estados', 'idEstados', 'CASCADE', 'CASCADE');
        $this->forge->createTable('equipos');
    }

    public function down(): void
    {
        $this->forge->dropTable('equipos');
    }
}