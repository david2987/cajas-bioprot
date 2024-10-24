<?php

namespace App\Controllers;

use App\Models\MovimientoModel;
use App\Models\CajaModel;
use CodeIgniter\Controller;
use App\Controllers\Cajas;

class Movimientos extends Controller
{
    public function index()
    {
        $filters = $this->request->getGet();
        $model = new MovimientoModel();
        
        if (!empty($filters['fecha_salida'])) {
            $model->where('fecha_salida', $filters['fecha_salida']);
        }
        if (!empty($filters['fecha_entrada'])) {
            $model->where('fecha_entrada', $filters['fecha_entrada']);
        }
        if (!empty($filters['paciente'])) {
            $model->like('paciente', $filters['paciente']);
        }
        if (!empty($filters['medico'])) {
            $model->like('medico', $filters['medico']);
        }
        if (!empty($filters['servicio'])) {
            $model->like('servicio', $filters['servicio']);
        }
        if (!empty($filters['tipo_entrada'])) {
            $model->where('tipo_entrada', $filters['tipo_entrada']);
        }
        if (!empty($filters['momento_retiro'])) {
            $model->like('momento_retiro', $filters['momento_retiro']);
        }
        if (!empty($filters['usuario_despacho'])) {
            $model->like('usuario_despacho', $filters['usuario_despacho']);
        }
        
        $data['movimientos'] = $model->paginate(10);
        $data['pager'] = $model->pager;
        $data['filters'] = $filters;
    
        return view('movimientos/index', $data);
    }

    public function show($cajaId){
        $model = new MovimientoModel();
        if(!empty($cajaId)){
            $data['movimientos'] = $model->where('caja_id',$cajaId)->paginate(10);
            $data['pager'] = $model->pager;
            return view('movimientos/show', $data);
        }        
        else{
            echo "ERROR: Error al traer movimientos de la caja ";
        }
    }
    

    public function create($cajaId,$tipoEntrada = 0)
    {
        $cajaModel = new CajaModel();
        $data['caja'] = $cajaModel->find($cajaId);
        $data['tipoEntrada'] = $tipoEntrada;        
             
        return view('movimientos/create', $data);
    }

    
    public function store()
    {
        $model = new MovimientoModel();
        $CajasContoller = new Cajas();        
        
        // VALIDA QUE LA FECHA DE SALIDA EXISTA        
        if($this->request->getPost('tipo_entrada') == 'S' &&  !$this->request->getPost('fecha_salida')){
            return redirect()->back()->with('error', 'No se cargó una Fecha de Salida Válida.')->withInput();
        }
        // VALIDA QUE LA FECHA DE ENTRADA EXISTA        
        if($this->request->getPost('tipo_entrada') == 'E' &&  !$this->request->getPost('fecha_entrada')){
            return redirect()->back()->with('error', 'No se cargó una Fecha de Entrada Válida.')->withInput();
        }
        /*
        'fecha_salida' => 'required|valid_date',
            'fecha_entrada' => 'required|valid_date',
        */

        if ($validation = $this->validate([
            'caja_id' => 'required|integer',            
            'paciente' => 'required',
            'medico' => 'required',
            'servicio' => 'required',
            'tipo_entrada' => 'required',
            'momento_retiro' => 'required|valid_date',
            'usuario_despacho' => 'required'
        ])) {
            $model->save([
                'caja_id' => $this->request->getPost('caja_id'),
                'fecha_salida' => $this->request->getPost('fecha_salida'),
                'fecha_entrada' => $this->request->getPost('fecha_entrada'),
                'paciente' => $this->request->getPost('paciente'),
                'medico' => $this->request->getPost('medico'),
                'servicio' => $this->request->getPost('servicio'),
                'tipo_entrada' => $this->request->getPost('tipo_entrada'),
                'momento_retiro' => $this->request->getPost('momento_retiro'),
                'usuario_despacho' => $this->request->getPost('usuario_despacho')
            ]);

            if($this->request->getPost('tipo_entrada') == 'S'){
                $CajasContoller->cambioEstadoCaja($this->request->getPost('caja_id'),'PENDIENTE');
            }else{                
                $CajasContoller->cambioEstadoCaja($this->request->getPost('caja_id'),'PARA CONSUMO');
            }

            return redirect()->to('/cajas')->with('success', 'Movimiento creado con éxito.');
        } else {          
            return redirect()->back()->with('error', 'Por favor completa todos los campos.')->withInput();
        }
    }

    public function edit($id,$tipoEntrada)
    {
        $model = new MovimientoModel();
        $data['movimiento'] = $model->find($id);

        $cajaModel = new CajaModel();
        $data['cajas'] = $cajaModel->findAll();
        $data['tipo_entrada'] = $tipoEntrada;

        return view('movimientos/edit', $data);
    }

    public function update($id)
    {
        $model = new MovimientoModel();

        $data = [
            'caja_id' => $this->request->getPost('caja_id'),
            'fecha_salida' => $this->request->getPost('fecha_salida'),
            'fecha_entrada' => $this->request->getPost('fecha_entrada'),
            'paciente' => $this->request->getPost('paciente'),
            'medico' => $this->request->getPost('medico'),
            'servicio' => $this->request->getPost('servicio'),
            'tipo_entrada' => $this->request->getPost('tipo_entrada'),
            'momento_retiro' => $this->request->getPost('momento_retiro'),
            'usuario_despacho' => $this->request->getPost('usuario_despacho')
        ];

        if (!$model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/movimientos');
    }

    public function delete($id)
    {
        $model = new MovimientoModel();
        $model->delete($id);
        return redirect()->to('/movimientos');
    }
}
