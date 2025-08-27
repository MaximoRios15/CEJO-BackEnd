<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosRoles extends Seeder
{
    public function run()
    {
        // Usuario Recepcion
        $recepcionista = [
            'usuario' => 'recepcionista',
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'type' => 'recepcion',
        ];
        
        // Usuario Técnico
        $tecnico = [
            'usuario' => 'tecnico',
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'type' => 'tecnico',
        ];
        
        // Verificar si los usuarios ya existen antes de insertarlos
        $existeRecepcionista = $this->db->table('TUsuarios')
                                       ->where('usuario', 'recepcionista')
                                       ->get()
                                       ->getResultArray();
        
        $existeTecnico = $this->db->table('TUsuarios')
                                 ->where('usuario', 'tecnico')
                                 ->get()
                                 ->getResultArray();
        
        // Insertar usuario recepcion si no existe
        if (empty($existeRecepcionista)) {
            $this->db->table('TUsuarios')->insert($recepcionista);
            echo "Usuario recepcion creado exitosamente.\n";
        } else {
            echo "Usuario recepcion ya existe.\n";
        }
        
        // Insertar usuario técnico si no existe
        if (empty($existeTecnico)) {
            $this->db->table('TUsuarios')->insert($tecnico);
            echo "Usuario técnico creado exitosamente.\n";
        } else {
            echo "Usuario técnico ya existe.\n";
        }
        
        // También crear algunos usuarios adicionales de ejemplo
        $usuariosEjemplo = [
            [
                'usuario' => 'recepcion01',
                'password' => password_hash('recepcion123', PASSWORD_DEFAULT),
                'type' => 'recepcion',
            ],
            [
                'usuario' => 'tecnico01',
                'password' => password_hash('tecnico123', PASSWORD_DEFAULT),
                'type' => 'tecnico',
            ],
            [
                'usuario' => 'tecnico02',
                'password' => password_hash('tecnico123', PASSWORD_DEFAULT),
                'type' => 'tecnico',
            ]
        ];
        
        foreach ($usuariosEjemplo as $usuario) {
            $existe = $this->db->table('TUsuarios')
                              ->where('usuario', $usuario['usuario'])
                              ->get()
                              ->getResultArray();
            
            if (empty($existe)) {
                $this->db->table('TUsuarios')->insert($usuario);
                echo "Usuario {$usuario['usuario']} creado exitosamente.\n";
            } else {
                echo "Usuario {$usuario['usuario']} ya existe.\n";
            }
        }
    }
}