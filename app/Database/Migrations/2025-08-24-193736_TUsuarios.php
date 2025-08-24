<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'usuario' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255, // mejor 255 para contraseñas encriptadas
                'null'       => false,
            ],
            'type' => [ // cambiado de "type"
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            
        ]);
        $this->forge->addKey('id_usuario', true);
        $this->forge->createTable('TUsuarios'); // minúsculas recomendado
    }

    public function down()
    {
        $this->forge->dropTable('TUsuarios');
    }
}
