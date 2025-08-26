<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyTUsuariosAddRoleFK extends Migration
{
    public function up()
    {
        // Eliminar el campo 'type' existente
        $this->forge->dropColumn('tusuarios', 'type');
        
        // Agregar el campo id_rol como clave foránea
        $this->forge->addColumn('tusuarios', [
            'id_rol' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'after'      => 'password',
            ],
        ]);
        
        // Agregar la clave foránea
        $this->forge->addForeignKey('id_rol', 'troles', 'id_rol', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Eliminar la clave foránea
        $this->forge->dropForeignKey('tusuarios', 'tusuarios_id_rol_foreign');
        
        // Eliminar el campo id_rol
        $this->forge->dropColumn('tusuarios', 'id_rol');
        
        // Restaurar el campo 'type'
        $this->forge->addColumn('tusuarios', [
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
                'default'    => 'admin',
                'after'      => 'password',
            ],
        ]);
    }
}
