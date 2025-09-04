<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFotosEquiposTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idFotos' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'idEquipos_Fotos' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'RutaArchivo_Fotos' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'NombreOriginal_Fotos' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'FechaSubida_Fotos' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        $this->forge->addKey('idFotos', true);
        $this->forge->addForeignKey('idEquipos_Fotos', 'equipos', 'idEquipos', 'CASCADE', 'CASCADE');
        $this->forge->createTable('fotos_equipos');
    }

    public function down(): void
    {
        $this->forge->dropTable('fotos_equipos');
    }
}