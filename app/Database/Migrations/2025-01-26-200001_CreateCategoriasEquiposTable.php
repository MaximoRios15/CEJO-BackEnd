<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriasEquiposTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idCategorias' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'Nombres_Categorias' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'Activo_Categorias' => [
                'type' => 'TINYINT',
                'constraint' => 4,
                'default' => 1,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idCategorias', true);
        $this->forge->addUniqueKey('Nombres_Categorias');
        $this->forge->createTable('categorias_equipos');

        // Insertar datos iniciales
        $data = [
            ['idCategorias' => 1, 'Nombres_Categorias' => 'Microondas', 'Activo_Categorias' => 1],
            ['idCategorias' => 2, 'Nombres_Categorias' => 'Licuadoras', 'Activo_Categorias' => 1],
            ['idCategorias' => 3, 'Nombres_Categorias' => 'Batidoras', 'Activo_Categorias' => 1],
            ['idCategorias' => 4, 'Nombres_Categorias' => 'Procesadoras de alimentos', 'Activo_Categorias' => 1],
            ['idCategorias' => 5, 'Nombres_Categorias' => 'Cafeteras', 'Activo_Categorias' => 1],
            ['idCategorias' => 6, 'Nombres_Categorias' => 'Tostadoras', 'Activo_Categorias' => 1],
            ['idCategorias' => 7, 'Nombres_Categorias' => 'Sandwicheras', 'Activo_Categorias' => 1],
            ['idCategorias' => 8, 'Nombres_Categorias' => 'Hornitos electricos', 'Activo_Categorias' => 1],
            ['idCategorias' => 9, 'Nombres_Categorias' => 'Pavas electricas', 'Activo_Categorias' => 1],
            ['idCategorias' => 10, 'Nombres_Categorias' => 'Extractores de jugo', 'Activo_Categorias' => 1],
            ['idCategorias' => 11, 'Nombres_Categorias' => 'Calefactores y estufas', 'Activo_Categorias' => 1],
            ['idCategorias' => 12, 'Nombres_Categorias' => 'Televisores', 'Activo_Categorias' => 1],
            ['idCategorias' => 13, 'Nombres_Categorias' => 'Parlantes y barras de sonido', 'Activo_Categorias' => 1],
            ['idCategorias' => 14, 'Nombres_Categorias' => 'Reproductores de video', 'Activo_Categorias' => 1],
            ['idCategorias' => 16, 'Nombres_Categorias' => 'Secadores de pelo', 'Activo_Categorias' => 1],
            ['idCategorias' => 17, 'Nombres_Categorias' => 'Planchitas', 'Activo_Categorias' => 1],
            ['idCategorias' => 18, 'Nombres_Categorias' => 'Rizadores', 'Activo_Categorias' => 1],
            ['idCategorias' => 19, 'Nombres_Categorias' => 'Computadoras de escritorio', 'Activo_Categorias' => 1],
            ['idCategorias' => 20, 'Nombres_Categorias' => 'Notebooks', 'Activo_Categorias' => 1],
            ['idCategorias' => 21, 'Nombres_Categorias' => 'Laptops', 'Activo_Categorias' => 1],
            ['idCategorias' => 22, 'Nombres_Categorias' => 'Tablets', 'Activo_Categorias' => 1],
            ['idCategorias' => 23, 'Nombres_Categorias' => 'Teclados', 'Activo_Categorias' => 1],
            ['idCategorias' => 24, 'Nombres_Categorias' => 'Mouse', 'Activo_Categorias' => 1],
            ['idCategorias' => 25, 'Nombres_Categorias' => 'Scanners', 'Activo_Categorias' => 1],
            ['idCategorias' => 26, 'Nombres_Categorias' => 'Microfonos', 'Activo_Categorias' => 1],
            ['idCategorias' => 27, 'Nombres_Categorias' => 'Camaras web', 'Activo_Categorias' => 1],
            ['idCategorias' => 28, 'Nombres_Categorias' => 'Monitores', 'Activo_Categorias' => 1],
            ['idCategorias' => 29, 'Nombres_Categorias' => 'Impresoras', 'Activo_Categorias' => 1],
            ['idCategorias' => 30, 'Nombres_Categorias' => 'Auriculares', 'Activo_Categorias' => 1],
            ['idCategorias' => 31, 'Nombres_Categorias' => 'Estabilizadores y UPS', 'Activo_Categorias' => 1],
            ['idCategorias' => 32, 'Nombres_Categorias' => 'Joysticks y mandos', 'Activo_Categorias' => 1],
        ];

        $this->db->table('categorias_equipos')->insertBatch($data);
    }

    public function down(): void
    {
        $this->forge->dropTable('categorias_equipos');
    }
}