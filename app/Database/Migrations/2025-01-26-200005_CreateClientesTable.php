<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientesTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idClientes' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'Nombres_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'Apellidos_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'DNI_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
            'Telefono_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 13,
                'null' => false,
            ],
            'Email_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'Direccion_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'CodigoPostal_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => true,
            ],
            'Ciudad_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => false,
            ],
            'Provincia_Clientes' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => false,
            ],
            'FechaRegistro_Clientes' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'Activo_Clientes' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'null' => true,
                'default' => 1,
            ],
        ]);

        $this->forge->addKey('idClientes', true);
        $this->forge->createTable('clientes');
    }

    public function down(): void
    {
        $this->forge->dropTable('clientes');
    }
}