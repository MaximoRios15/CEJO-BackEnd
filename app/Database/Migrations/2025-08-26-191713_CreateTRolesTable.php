<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rol' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'descripcion' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
        ]);
        
        $this->forge->addKey('id_rol', true);
        $this->forge->createTable('troles');
    }

    public function down()
    {
        $this->forge->dropTable('troles');
    }
}
