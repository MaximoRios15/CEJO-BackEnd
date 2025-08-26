<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Usuario extends Seeder
{
    public function run()
    {
        $usuario = "admin";
        $password = password_hash('123', PASSWORD_DEFAULT);
        $id_rol = 1; // 1 = admin según RolesSeeder

        $data = [
            'usuario' => $usuario,
            'password' => $password,
            'id_rol' => $id_rol,
        ];

        // Verificar si el usuario ya existe antes de insertarlo
        $existeUsuario = $this->db->table('tusuarios')
                                  ->where('usuario', $usuario)
                                  ->get()
                                  ->getRow();
        
        if (!$existeUsuario) {
            // Using Query Builder
            $this->db->table('tusuarios')->insert($data);
        }
    }
}
