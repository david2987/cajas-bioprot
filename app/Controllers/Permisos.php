<?php

namespace App\Controllers;

use App\Models\PermisoModel;
use App\Models\GrupoUsuarioModel;
use CodeIgniter\Controller;

class Permisos extends Controller
{
    public function index()
    {
        $model = new PermisoModel();
        $data['permisos'] = $model->findAll();
        
        return view('permisos/index', $data);
    }

    public function create()
    {
        $grupoModel = new GrupoUsuarioModel();
        $data['grupos'] = $grupoModel->findAll();

        return view('permisos/create', $data);
    }

    public function store()
    {
        $model = new PermisoModel();
        
        if ($this->validate([
            'grupo_usuario_id' => 'required',
            'permiso' => 'required'
        ])) {
            $model->save([
                'grupo_usuario_id' => $this->request->getPost('grupo_usuario_id'),
                'permiso' => $this->request->getPost('permiso')
            ]);
            return redirect()->to('/permisos')->with('success', 'Permiso creado con éxito.');
        } else {
            return redirect()->back()->with('error', 'Por favor completa todos los campos.')->withInput();
        }
    }

    public function edit($id)
    {
        $model = new PermisoModel();
        $data['permiso'] = $model->find($id);

        $grupoModel = new GrupoUsuarioModel();
        $data['grupos'] = $grupoModel->findAll();

        return view('permisos/edit', $data);
    }

    public function update($id)
    {
        $model = new PermisoModel();
        
        if ($this->validate([
            'grupo_usuario_id' => 'required',
            'permiso' => 'required'
        ])) {
            $model->update($id, [
                'grupo_usuario_id' => $this->request->getPost('grupo_usuario_id'),
                'permiso' => $this->request->getPost('permiso')
            ]);
            return redirect()->to('/permisos')->with('success', 'Permiso actualizado con éxito.');
        } else {
            return redirect()->back()->with('error', 'Por favor completa todos los campos.')->withInput();
        }
    }

    public function delete($id)
    {
        $model = new PermisoModel();
        $model->delete($id);

        return redirect()->to('/permisos')->with('success', 'Permiso eliminado con éxito.');
    }
}
