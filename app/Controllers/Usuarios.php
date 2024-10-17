<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\GrupoUsuarioModel;
use CodeIgniter\Controller;

class Usuarios extends Controller
{
    public function index()
    {
        $filters = $this->request->getGet();
        $model = new UsuarioModel();
    
        
        if (!empty($filters['nombre'])) {
            $model->like('nombre_usuario', $filters['nombre']);
        }
        if (!empty($filters['email'])) {
            $model->like('email', $filters['email']);
        }
        if (isset($filters['habilitado']) && $filters['habilitado'] !== '') {
            $model->where('habilitado', $filters['habilitado']);
        }
        
        $data['usuarios'] = $model->paginate(10);
        $data['pager'] = $model->pager;
        $data['filters'] = $filters;
    
        return view('usuarios/index', $data);
    }
    

    public function create()
    {
        $grupoModel = new GrupoUsuarioModel();
        $data['grupos'] = $grupoModel->findAll();
        return view('usuarios/create', $data);
    }

    public function store()
    {
        $model = new UsuarioModel();
        $data = [
            'nombre_usuario' => $this->request->getPost('nombre_usuario'),
            'email' => $this->request->getPost('email'),
            'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'habilitado' => $this->request->getPost('habilitado'),
            'grupo_usuario_id' => $this->request->getPost('grupo_usuario_id')
        ];

        if (!$model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/usuarios');
    }

    public function edit($id)
    {
        $model = new UsuarioModel();
        $data['usuario'] = $model->find($id);

        $grupoModel = new GrupoUsuarioModel();
        $data['grupos'] = $grupoModel->findAll();

        return view('usuarios/edit', $data);
    }

    public function update($id)
    {
        $model = new UsuarioModel();
        $data = [
            'nombre_usuario' => $this->request->getPost('nombre_usuario'),
            'email' => $this->request->getPost('email'),
            'habilitado' => $this->request->getPost('habilitado'),
            'grupo_usuario_id' => $this->request->getPost('grupo_usuario_id')
        ];

        if ($this->request->getPost('contrasena')) {
            $data['contrasena'] = password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT);
        }

        if (!$model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/usuarios');
    }

    public function delete($id)
    {
        $model = new UsuarioModel();
        $model->delete($id);
        return redirect()->to('/usuarios');
    }
}
