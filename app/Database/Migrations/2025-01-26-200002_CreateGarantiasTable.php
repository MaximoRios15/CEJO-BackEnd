<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGarantiasTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idGarantias' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'Descripcion_Garantias' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idGarantias', true);
        $this->forge->createTable('garantias');

        // Insertar datos iniciales
        $data = [
            ['idGarantias' => 1, 'Descripcion_Garantias' => 'T1: Reparacion normal'],
            ['idGarantias' => 2, 'Descripcion_Garantias' => 'T2: Garantia de fabrica'],
            ['idGarantias' => 3, 'Descripcion_Garantias' => 'T3: Garantia de comercio'],
            ['idGarantias' => 4, 'Descripcion_Garantias' => 'T4: Garantia interna (3 meses post-reparacion)'],
            ['idGarantias' => 5, 'Descripcion_Garantias' => 'T5: Seguro de hogar/garantia extendida'],
            ['idGarantias' => 6, 'Descripcion_Garantias' => 'T6: Reclamo de garantia (reparacion fallida)'],
            ['idGarantias' => 7, 'Descripcion_Garantias' => 'T7: Producto dañado por terceros'],
        ];

        $this->db->table('garantias')->insertBatch($data);
    }

    public function down(): void
    {
        $this->forge->dropTable('garantias');
    }
}