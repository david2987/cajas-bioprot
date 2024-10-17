<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function authenticate()
    {     

        if (!$this->validate(['csrf_token' => 'required'])) {
             redirect()->back()->with('error', 'Token CSRF inválido.');
        }

        $model = new UsuarioModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('contrasena');

        // Asegúrate de que $email y $password sean cadenas de texto
        if (is_array($email) || is_array($password)) {
            return redirect()->back()->with('error', 'usuario / contraseña incorrectos .');
        }

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['contrasena'])) {
            $session = session();
            
            $session->set([
                'user_id' => $user['id'],
                'user_name' => $user['nombre_usuario'],
                'grupo_usuario_id' => $user['grupo_usuario_id']
            ]);           
            return redirect()->to('/cajas');
        } else {
            return redirect()->back()->with('error', 'Credenciales incorrectas.');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth/login');
    }
}
