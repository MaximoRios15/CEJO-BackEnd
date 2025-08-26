<?php

namespace App\Controllers;

class TecnicoController extends BaseController
{
    public function index()
    {
        // Verificar que el usuario sea técnico
        if (session('type') !== 'tecnico') {
            return redirect()->to(base_url('/'));
        }
        
        return view('tecnico/panel');
    }
    
    public function verPacientes()
    {
        // Verificar que el usuario sea técnico
        if (session('type') !== 'tecnico') {
            return redirect()->to(base_url('/'));
        }
        
        // Aquí se implementaría la lógica para ver pacientes asignados
        return view('tecnico/ver_pacientes');
    }
    
    public function registrarTratamiento()
    {
        // Verificar que el usuario sea técnico
        if (session('type') !== 'tecnico') {
            return redirect()->to(base_url('/'));
        }
        
        // Aquí se implementaría la lógica para registrar tratamientos
        return view('tecnico/registrar_tratamiento');
    }
    
    public function historialPaciente($id = null)
    {
        // Verificar que el usuario sea técnico
        if (session('type') !== 'tecnico') {
            return redirect()->to(base_url('/'));
        }
        
        if (!$id) {
            return redirect()->to(base_url('/tecnico/ver_pacientes'));
        }
        
        // Aquí se implementaría la lógica para ver el historial del paciente
        return view('tecnico/historial_paciente', ['paciente_id' => $id]);
    }
    
    public function equipos()
    {
        // Verificar que el usuario sea técnico
        if (session('type') !== 'tecnico') {
            return redirect()->to(base_url('/'));
        }
        
        // Aquí se implementaría la lógica para gestionar equipos
        return view('tecnico/equipos');
    }
}