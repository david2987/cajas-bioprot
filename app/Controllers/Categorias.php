<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use CodeIgniter\Controller;

class Categorias extends Controller
{
    public function index()
    {
        $model = new CategoriaModel();
        $data['categorias'] = $model->findAll();
        
        return view('categorias/index', $data);
    }

    public function create()
    {
        return view('categorias/create');
    }

    public function store()
    {
        $model = new CategoriaModel();
        $data = [
            'nombre_categoria' => $this->request->getPost('nombre_categoria'),
        ];
        $model->save($data);        
        return redirect()->to('/categorias');
    }

    public function edit($id)
    {
        $model = new CategoriaModel();
        $data['categoria'] = $model->find($id);
        
        return view('categorias/edit', $data);
    }

    public function update($id)
    {
        $model = new CategoriaModel();
        $data = [
            'nombre_categoria' => $this->request->getPost('nombre_categoria'),
        ];
        $model->update($id, $data);
        
        return redirect()->to('/categorias');
    }

    public function delete($id)
    {
        $model = new CategoriaModel();
        $model->delete($id);
        
        return redirect()->to('/categorias');
    }
}
