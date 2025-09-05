<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRepuestoTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id_Repuesto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'Descripcion_Repuesto' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'Cantidad_Repuesto' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'Prioridad_Repuesto' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'Repuesto_Solicitado_' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
                'null' => true,
            ],
            'categorias_equipos_idCategorias' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'usuarios_idUsuarios' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'usuarios_idRoles_Usuarios' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'Factura_idFactura' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'estados_idEstados' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'Fecha_Solicitud_Respuesto' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_Repuesto', true);
        $this->forge->addForeignKey('categorias_equipos_idCategorias', 'categorias_equipos', 'idCategorias', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usuarios_idUsuarios', 'usuarios', 'idUsuarios', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('usuarios_idRoles_Usuarios', 'roles', 'idRoles', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('Factura_idFactura', 'factura', 'idFactura', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('estados_idEstados', 'estados', 'idEstados', 'CASCADE', 'CASCADE');
        $this->forge->createTable('repuesto');
    }

    public function down(): void
    {
        $this->forge->dropTable('repuesto');
    }
}