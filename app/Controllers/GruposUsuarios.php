<?php

namespace App\Controllers;

use App\Models\GrupoUsuarioModel;
use CodeIgniter\Controller;

class GruposUsuarios extends Controller
{
    public function index()
    {
        $model = new GrupoUsuarioModel();
        $data['grupos'] = $model->findAll();
        return view('grupos_usuarios/index', $data);
    }

    public function create()
    {
        return view('grupos_usuarios/create');
    }

    public function store()
    {
        $model = new GrupoUsuarioModel();
        $data = ['descripcion' => $this->request->getPost('descripcion')];

        if (!$model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/grupos-usuarios');
    }

    public function edit($id)
    {
        $model = new GrupoUsuarioModel();
        $data['grupo'] = $model->find($id);

        return view('grupos_usuarios/edit', $data);
    }

    public function update($id)
    {
        $model = new GrupoUsuarioModel();
        $data = ['descripcion' => $this->request->getPost('descripcion')];

        if (!$model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/grupos-usuarios');
    }

    public function delete($id)
    {
        $model = new GrupoUsuarioModel();
        $model->delete($id);
        return redirect()->to('/grupos-usuarios');
    }
}
