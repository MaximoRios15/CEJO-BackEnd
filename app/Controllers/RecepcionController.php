<?php

namespace App\Controllers;

class RecepcionController extends BaseController
{
    public function index()
    {
        // Verificar que el usuario sea recepcionista
        if (session('rol') !== 'recepcionista') {
            return redirect()->to(base_url('/'));
        }
        
        return view('recepcion/inicio');
    }
    
    public function registrarPaciente()
    {
        // Verificar que el usuario sea recepcionista
        if (session('rol') !== 'recepcionista') {
            return redirect()->to(base_url('/'));
        }
        
        // Aquí se implementaría la lógica para registrar pacientes
        return view('recepcion/registrar_paciente');
    }
    
    public function agendarCita()
    {
        // Verificar que el usuario sea recepcionista
        if (session('rol') !== 'recepcionista') {
            return redirect()->to(base_url('/'));
        }
        
        // Aquí se implementaría la lógica para agendar citas
        return view('recepcion/agendar_cita');
    }
    
    public function verCitas()
    {
        // Verificar que el usuario sea recepcionista
        if (session('rol') !== 'recepcionista') {
            return redirect()->to(base_url('/'));
        }
        
        // Aquí se implementaría la lógica para ver las citas del día
        return view('recepcion/ver_citas');
    }
}