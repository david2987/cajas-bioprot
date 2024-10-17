<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\PermisoModel;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $grupoUsuarioId = $session->get('grupo_usuario_id');
        $permisoRequerido = $arguments[0]; // Aquí se obtiene el permiso requerido

        // Asegurarse de que $permisoRequerido sea una cadena de texto antes de usar trim()
        if (is_string($permisoRequerido)) {
            $permisoRequerido = trim($permisoRequerido);
        }

        $permisoModel = new PermisoModel();
        $permiso = $permisoModel->where([
            'grupo_usuario_id' => $grupoUsuarioId,
            'permiso' => $permisoRequerido
        ])->first();

        if (!$permiso) {
            return redirect()->to('/auth/login')->with('error', 'No tienes permiso para acceder a esta página.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No es necesario hacer nada aquí
    }
}
