<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFacturaTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idFactura' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'idEquipo_Factura' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'FechaCompra_Factura' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'NroFactura_Factura' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'Comercio_Factura' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => false,
            ],
            'Localidad_Factura' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => false,
            ],
            'Pagador_Factura' => [
                'type' => 'VARCHAR',
                'constraint' => 75,
                'null' => false,
            ],
            'FechaRegistro_Factura' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'Monto_Factura' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'Fecha_Salida_Factura' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'Fecha_Entrada_Factura' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idFactura', true);
        $this->forge->addForeignKey('idEquipo_Factura', 'equipos', 'idEquipos', 'CASCADE', 'CASCADE');
        $this->forge->createTable('factura');
    }

    public function down(): void
    {
        $this->forge->dropTable('factura');
    }
}