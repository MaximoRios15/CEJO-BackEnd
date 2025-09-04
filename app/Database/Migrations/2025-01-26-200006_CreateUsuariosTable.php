<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuariosTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idUsuarios' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'Nombres_Usuarios' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'Apellidos_Usuarios' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'DNI_Usuarios' => [
                'type' => 'INT',
                'constraint' => 25,
                'null' => false,
            ],
            'Password_Usuarios' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'FechaCreacion_Usuarios' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'UltimoAcceso_Usuarios' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'idRoles_Usuarios' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'Activo_Usuarios' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idUsuarios', true);
        $this->forge->addForeignKey('idRoles_Usuarios', 'roles', 'idRoles', 'CASCADE', 'CASCADE');
        $this->forge->createTable('usuarios');

        // Insertar datos iniciales
        $data = [
            [
                'idUsuarios' => 1,
                'Nombres_Usuarios' => 'Maximo Jesus',
                'Apellidos_Usuarios' => 'Rios',
                'DNI_Usuarios' => 45026308,
                'Password_Usuarios' => '$2y$10$Yt/FbOhW6GpPDd113TlJu.QfH3pZuJUjhrxpaadaWgiHXV3bt7ml2',
                'FechaCreacion_Usuarios' => '2025-09-03 19:21:14',
                'UltimoAcceso_Usuarios' => '2025-09-03 19:21:14',
                'idRoles_Usuarios' => 2,
                'Activo_Usuarios' => 1
            ],
            [
                'idUsuarios' => 2,
                'Nombres_Usuarios' => 'Bruno Gaston',
                'Apellidos_Usuarios' => 'Rios',
                'DNI_Usuarios' => 45390354,
                'Password_Usuarios' => 'Ramos2025',
                'FechaCreacion_Usuarios' => '2025-09-03 19:21:14',
                'UltimoAcceso_Usuarios' => '2025-09-03 19:21:14',
                'idRoles_Usuarios' => 3,
                'Activo_Usuarios' => 1
            ],
        ];

        $this->db->table('usuarios')->insertBatch($data);
    }

    public function down(): void
    {
        $this->forge->dropTable('usuarios');
    }
}