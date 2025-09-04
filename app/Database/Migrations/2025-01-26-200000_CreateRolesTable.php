<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idRoles' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'Descripcion_Roles' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idRoles', true);
        $this->forge->createTable('roles');

        // Insertar datos iniciales
        $data = [
            ['idRoles' => 1, 'Descripcion_Roles' => 'Administrador'],
            ['idRoles' => 2, 'Descripcion_Roles' => 'Recepcionista'],
            ['idRoles' => 3, 'Descripcion_Roles' => 'Tecnico'],
        ];

        $this->db->table('roles')->insertBatch($data);
    }

    public function down(): void
    {
        $this->forge->dropTable('roles');
    }
}