<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_rol'     => 1,
                'descripcion' => 'admin'
            ],
            [
                'id_rol'     => 2,
                'descripcion' => 'recepcionista'
            ],
            [
                'id_rol'     => 3,
                'descripcion' => 'tecnico'
            ]
        ];

        // Verificar si los roles ya existen antes de insertarlos
        foreach ($data as $rol) {
            $existeRol = $this->db->table('troles')
                                  ->where('descripcion', $rol['descripcion'])
                                  ->get()
                                  ->getRow();
            
            if (!$existeRol) {
                $this->db->table('troles')->insert($rol);
            }
        }
    }
}
