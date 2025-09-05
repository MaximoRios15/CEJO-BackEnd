<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProveedorTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'idProveedor' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => false,
                'auto_increment' => true,
            ],
            'Nombre_Proveedor' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idProveedor', true);
        $this->forge->createTable('proveedor');

        // Insertar datos iniciales
        $data = [
            ['idProveedor' => 1, 'Nombre_Proveedor' => '8BitDo'],
            ['idProveedor' => 2, 'Nombre_Proveedor' => 'AOC'],
            ['idProveedor' => 3, 'Nombre_Proveedor' => 'APC (Schneider Electric)'],
            ['idProveedor' => 4, 'Nombre_Proveedor' => 'Apple'],
            ['idProveedor' => 5, 'Nombre_Proveedor' => 'Asus'],
            ['idProveedor' => 6, 'Nombre_Proveedor' => 'Atma'],
            ['idProveedor' => 7, 'Nombre_Proveedor' => 'Audio-Technica'],
            ['idProveedor' => 8, 'Nombre_Proveedor' => 'Babyliss'],
            ['idProveedor' => 9, 'Nombre_Proveedor' => 'Bangho'],
            ['idProveedor' => 10, 'Nombre_Proveedor' => 'Behringer'],
            ['idProveedor' => 11, 'Nombre_Proveedor' => 'BenQ'],
            ['idProveedor' => 12, 'Nombre_Proveedor' => 'BGH'],
            ['idProveedor' => 13, 'Nombre_Proveedor' => 'Black+Decker'],
            ['idProveedor' => 14, 'Nombre_Proveedor' => 'Blue (Yeti)'],
            ['idProveedor' => 15, 'Nombre_Proveedor' => 'Bose'],
            ['idProveedor' => 16, 'Nombre_Proveedor' => 'Braun'],
            ['idProveedor' => 17, 'Nombre_Proveedor' => 'Brother'],
            ['idProveedor' => 18, 'Nombre_Proveedor' => 'Canon'],
            ['idProveedor' => 19, 'Nombre_Proveedor' => 'Carrier'],
            ['idProveedor' => 20, 'Nombre_Proveedor' => 'Conair'],
            ['idProveedor' => 21, 'Nombre_Proveedor' => 'Corsair'],
            ['idProveedor' => 22, 'Nombre_Proveedor' => 'Creative'],
            ['idProveedor' => 23, 'Nombre_Proveedor' => 'CyberPower'],
            ['idProveedor' => 24, 'Nombre_Proveedor' => 'Daewoo'],
            ['idProveedor' => 25, 'Nombre_Proveedor' => 'Daikin'],
            ['idProveedor' => 26, 'Nombre_Proveedor' => 'Dell'],
            ['idProveedor' => 27, 'Nombre_Proveedor' => 'Eaton'],
            ['idProveedor' => 28, 'Nombre_Proveedor' => 'Electrolux'],
            ['idProveedor' => 29, 'Nombre_Proveedor' => 'Epson'],
            ['idProveedor' => 30, 'Nombre_Proveedor' => 'Eskabe'],
            ['idProveedor' => 31, 'Nombre_Proveedor' => 'EXO'],
            ['idProveedor' => 32, 'Nombre_Proveedor' => 'Forza'],
            ['idProveedor' => 33, 'Nombre_Proveedor' => 'Fujitsu'],
            ['idProveedor' => 34, 'Nombre_Proveedor' => 'Gama Italy'],
            ['idProveedor' => 35, 'Nombre_Proveedor' => 'General Electric (GE)'],
            ['idProveedor' => 36, 'Nombre_Proveedor' => 'Genius'],
            ['idProveedor' => 37, 'Nombre_Proveedor' => 'Haier'],
            ['idProveedor' => 38, 'Nombre_Proveedor' => 'Hamilton Beach'],
            ['idProveedor' => 39, 'Nombre_Proveedor' => 'Harman Kardon'],
            ['idProveedor' => 40, 'Nombre_Proveedor' => 'Hisense'],
            ['idProveedor' => 41, 'Nombre_Proveedor' => 'Hitachi'],
            ['idProveedor' => 42, 'Nombre_Proveedor' => 'HP (Hewlett-Packard)'],
            ['idProveedor' => 43, 'Nombre_Proveedor' => 'Huawei'],
            ['idProveedor' => 44, 'Nombre_Proveedor' => 'HyperX'],
            ['idProveedor' => 45, 'Nombre_Proveedor' => 'Imusa'],
            ['idProveedor' => 46, 'Nombre_Proveedor' => 'Insignia'],
            ['idProveedor' => 47, 'Nombre_Proveedor' => 'James'],
            ['idProveedor' => 48, 'Nombre_Proveedor' => 'JBL'],
            ['idProveedor' => 49, 'Nombre_Proveedor' => 'JVC'],
            ['idProveedor' => 50, 'Nombre_Proveedor' => 'Kanji'],
            ['idProveedor' => 51, 'Nombre_Proveedor' => 'KitchenAid'],
            ['idProveedor' => 52, 'Nombre_Proveedor' => 'Klipsch'],
            ['idProveedor' => 53, 'Nombre_Proveedor' => 'Konka'],
            ['idProveedor' => 54, 'Nombre_Proveedor' => 'Lenovo'],
            ['idProveedor' => 55, 'Nombre_Proveedor' => 'Lexmark'],
            ['idProveedor' => 56, 'Nombre_Proveedor' => 'LG'],
            ['idProveedor' => 57, 'Nombre_Proveedor' => 'Liebert (Vertiv)'],
            ['idProveedor' => 58, 'Nombre_Proveedor' => 'Liliana'],
            ['idProveedor' => 59, 'Nombre_Proveedor' => 'Logitech'],
            ['idProveedor' => 60, 'Nombre_Proveedor' => 'Longvie'],
            ['idProveedor' => 61, 'Nombre_Proveedor' => 'Marshall'],
            ['idProveedor' => 62, 'Nombre_Proveedor' => 'Microsoft'],
            ['idProveedor' => 63, 'Nombre_Proveedor' => 'Midea'],
            ['idProveedor' => 64, 'Nombre_Proveedor' => 'MSI'],
            ['idProveedor' => 65, 'Nombre_Proveedor' => 'Moulinex'],
            ['idProveedor' => 66, 'Nombre_Proveedor' => 'Nintendo'],
            ['idProveedor' => 67, 'Nombre_Proveedor' => 'Noblex'],
            ['idProveedor' => 68, 'Nombre_Proveedor' => 'Nokia (historico en algunos perifericos/tablets)'],
            ['idProveedor' => 69, 'Nombre_Proveedor' => 'Oculus/Meta (VR, controles)'],
            ['idProveedor' => 70, 'Nombre_Proveedor' => 'Orbis'],
            ['idProveedor' => 71, 'Nombre_Proveedor' => 'Oster'],
            ['idProveedor' => 72, 'Nombre_Proveedor' => 'Panasonic'],
            ['idProveedor' => 73, 'Nombre_Proveedor' => 'Peabody'],
            ['idProveedor' => 74, 'Nombre_Proveedor' => 'Philips'],
            ['idProveedor' => 75, 'Nombre_Proveedor' => 'Philco'],
            ['idProveedor' => 76, 'Nombre_Proveedor' => 'Pioneer'],
            ['idProveedor' => 77, 'Nombre_Proveedor' => 'PlayStation (Sony)'],
            ['idProveedor' => 78, 'Nombre_Proveedor' => 'Razer'],
            ['idProveedor' => 79, 'Nombre_Proveedor' => 'RCA'],
            ['idProveedor' => 80, 'Nombre_Proveedor' => 'Redragon'],
            ['idProveedor' => 81, 'Nombre_Proveedor' => 'Remington'],
            ['idProveedor' => 82, 'Nombre_Proveedor' => 'Revlon'],
            ['idProveedor' => 83, 'Nombre_Proveedor' => 'Ricoh'],
            ['idProveedor' => 84, 'Nombre_Proveedor' => 'Rode'],
            ['idProveedor' => 85, 'Nombre_Proveedor' => 'Rowenta'],
            ['idProveedor' => 86, 'Nombre_Proveedor' => 'Russell Hobbs'],
            ['idProveedor' => 87, 'Nombre_Proveedor' => 'Samsung'],
            ['idProveedor' => 88, 'Nombre_Proveedor' => 'Sanyo (historico en TV/audio)'],
            ['idProveedor' => 89, 'Nombre_Proveedor' => 'Sennheiser'],
            ['idProveedor' => 90, 'Nombre_Proveedor' => 'Sharp'],
            ['idProveedor' => 91, 'Nombre_Proveedor' => 'Shure'],
            ['idProveedor' => 92, 'Nombre_Proveedor' => 'Siemens'],
            ['idProveedor' => 93, 'Nombre_Proveedor' => 'Singer'],
            ['idProveedor' => 94, 'Nombre_Proveedor' => 'Smeg'],
            ['idProveedor' => 95, 'Nombre_Proveedor' => 'Snaige (refrigeracion europeo)'],
            ['idProveedor' => 96, 'Nombre_Proveedor' => 'Somela'],
            ['idProveedor' => 97, 'Nombre_Proveedor' => 'Sony'],
            ['idProveedor' => 98, 'Nombre_Proveedor' => 'Sordini (local, climatizacion)'],
            ['idProveedor' => 99, 'Nombre_Proveedor' => 'Steam (Valve/Steam Deck)'],
            ['idProveedor' => 100, 'Nombre_Proveedor' => 'SteelSeries'],
            ['idProveedor' => 101, 'Nombre_Proveedor' => 'Sthor (accesorios electricos)'],
            ['idProveedor' => 102, 'Nombre_Proveedor' => 'Surrey'],
            ['idProveedor' => 103, 'Nombre_Proveedor' => 'TCL'],
            ['idProveedor' => 104, 'Nombre_Proveedor' => 'Tefal'],
            ['idProveedor' => 105, 'Nombre_Proveedor' => 'Toshiba'],
            ['idProveedor' => 106, 'Nombre_Proveedor' => 'Tripp Lite'],
            ['idProveedor' => 107, 'Nombre_Proveedor' => 'Trust'],
            ['idProveedor' => 108, 'Nombre_Proveedor' => 'ViewSonic'],
            ['idProveedor' => 109, 'Nombre_Proveedor' => 'Visuar'],
            ['idProveedor' => 110, 'Nombre_Proveedor' => 'Vizio'],
            ['idProveedor' => 111, 'Nombre_Proveedor' => 'Volcan'],
            ['idProveedor' => 112, 'Nombre_Proveedor' => 'Wahl'],
            ['idProveedor' => 113, 'Nombre_Proveedor' => 'Whirlpool'],
            ['idProveedor' => 114, 'Nombre_Proveedor' => 'Xiaomi'],
        ];

        $this->db->table('proveedor')->insertBatch($data);
    }

    public function down(): void
    {
        $this->forge->dropTable('proveedor');
    }
}