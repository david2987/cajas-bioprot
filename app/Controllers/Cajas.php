<?php

namespace App\Controllers;

use App\Models\CajaModel;
use App\Models\CategoriaModel;
use CodeIgniter\Controller;
use App\Libraries\Ciqrcode;
use App\Models\CajasGalleryModel;
use App\Models\GalleryModel;
use Error;
use Exception;

class Cajas extends Controller
{

    private $ciqrcode;

    public function __construct()
    {
        $this->ciqrcode = new ciqrcode();
    }


    public function index()
    {
        $filters = $this->request->getGet();
        $model = new CajaModel();
        // $data['cajas'] = $model->getCajasWithCategoria();

        if (!empty($filters['descripcion'])) {
            $model->like('nombre_caja', $filters['descripcion']);
        }
        if (!empty($filters['estado'])) {
            $model->where('estado_caja', $filters['estado']);
        }

        $data['cajas'] = $model->getCajasWithCategoria(20);
        $data['pager'] = $model->pager;
        $data['filters'] = $filters;

        return view('cajas/index', $data);
    }

    public function create()
    {
        $modelCategoria = new CategoriaModel();

        $data['categorias'] = $modelCategoria->findAll();
        return view('cajas/create', $data);
    }

    public function store()
    {
        $model = new CajaModel();


        // imagen de caja
        if ($this->request->getFile('imagen')->getName() != '') {
            $file = $this->request->getFile('imagen');
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
        } else {
            $fileName = '';
        }

        // contenido de caja
        if ($this->request->getFile('contenido')->getName() != '') {
            $archivo = $this->request->getFile('contenido');
            $archivoNombre = $archivo->getRandomName();
            $archivo->move('uploads/contenidos', $archivoNombre);
        } else {
            $archivoNombre = '';
        }

        // crea el QR de la caja
        $data = strval(rand(1, 1000000));
        $qr   = $this->generate_qrcode($data);
        $qr_file = $qr['file'];


        $data = [
            'nombre_caja' => $this->request->getPost('nombre_caja'),
            'estado_caja' => $this->request->getPost('estado_caja'),
            'contenido' => $archivoNombre,
            'categoria_id' => $this->request->getPost('categoria_id'),
            'imagen' => $fileName,
            'qr_code' => $qr_file,
        ];

        $model->insert($data);
        return redirect()->to('/cajas');
    }

    public function edit($id)
    {
        $model = new CajaModel();
        $data['caja'] = $model->find($id);

        $modelCategoria = new CategoriaModel();
        $data['categorias'] = $modelCategoria->findAll();

        return view('cajas/edit', $data);
    }

    public function update($id)
    {
        $model = new CajaModel();

        // imagen de caja
        $file = $this->request->getFile('imagen');
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads', $fileName);
        } else {
            $fileName = $this->request->getPost('existing_imagen');
        }

        // contenido de caja
        $archivo = $this->request->getFile('contenido');
        if ($archivo->isValid() && !$archivo->hasMoved()) {
            $archivoNombre = $archivo->getRandomName();
            $file->move('uploads/contenidos', $archivoNombre);
        } else {
            $archivoNombre = $this->request->getPost('existing_imagen');
        }



        $data = [
            'nombre_caja' => $this->request->getPost('nombre_caja'),
            'estado_caja' => $this->request->getPost('estado_caja'),
            'categoria_id' => $this->request->getPost('categoria_id'),
            'contenido' => $archivoNombre,
            'imagen' => $fileName
        ];

        $model->update($id, $data);
        return redirect()->to('/cajas');
    }

    public function view($id)
    {
         $model = new CajaModel();
        $data['caja'] = $model->find($id);

        if (!$data['caja']) {
            return redirect()->to('/cajas')->with('error', 'Caja no encontrada.');
        }

        return view('cajas/view', $data);
    }

    public function delete($id)
    {
        $model = new CajaModel();
        $model->delete($id);
        return redirect()->to('/cajas');
    }

    public function cambioEstadoCaja($id, $nuevoEstado)
    {
        try {
            $model = new CajaModel();    
            $data = [
                "estado_caja" => $nuevoEstado
            ];
            $model->update($id,$data); 
            return true;
        } catch (Error $error) {           
            // throw new Exception($error);
            return false;
        }
                      
    }

    public function obtenerImagenesCaja($idCaja){
        $CajaModel = new CajaModel();
        $imagenesCaja = $CajaModel->where('id',$idCaja);
        
        return $imagenesCaja;
    }

    public function obtenerEstado($idCaja){
        $CajaModel = new CajaModel();
        $caja = $CajaModel->where('id',$idCaja);
        
        return $caja->estado_caja;        
    }

    public function agregarImagenesCaja()
    {
        try {
            /* Agrega todas las imagenes a la tabla de imagenes */

            helper(['form', 'url']);
            // obtiene las imgenes
            $files = $this->request->getFiles();
            //instancia el modelo
            $galleryModel = new GalleryModel();

            foreach($files['images'] as $file){

                if ($file->isValid() && !$file->hasMoved()) {
                    // Mover archivo al directorio de uploads en la carpeta public
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/uploads', $newName);

                    // Guardar en la base de datos la ruta relativa
                    $galleryModel->insert([
                        'image_path' => 'uploads/' . $newName                        
                    ]);

                    $galleryIds[] = $galleryModel->getInsertID();
                }
            }                

            $id_caja = $this->request->getPost('idCaja');
            $CajaModel = new CajaModel();
            
            if (!$caja =  $CajaModel->find($id_caja)) {
                $cajaTemp = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
            }else{
                $caja = $id_caja;
            }
            
            $cajasGallery = new CajasGalleryModel();
            
            foreach( $galleryIds as $id_gallery ){
                if($caja){
                    $data = [
                        "id_cajas" => $caja,
                        "id_gallery" => $id_gallery
                    ];
                }else{
                    $data = [
                        "id_cajas_temp" => $cajaTemp,
                        "id_gallery" => $id_gallery
                    ];
                }
                if (!$cajasGallery->insert($data)) {                
                    throw new Exception("Error al Vincular la Caja con la Imagen.");
                }
            }           

        } catch (Exception $error) {
            throw new Exception($error);
        }
    }

    public function disponibilizar($id){       
        $id = $this->request->getPost('cajaId');         
        if($this->cambioEstadoCaja($id,'DISPONIBLE')){
            $data = [
                "ok" => "success",
                "mensaje" => "Se Disponibilizado Correctamente!"
            ];            
        }else{
            $data = [
                "ok" => "error",
                "mensaje" => "Error al Disponibilizar la caja"
            ];
        }
        return json_encode($data);
    }

    public function generate_qrcode($data)
    {
        /* Data */
        $hex_data   = bin2hex($data);
        $save_name  = $hex_data . '.png';

        /* QR Code File Directory Initialize */
        $dir = QRCODE_URL;

        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = [255, 255, 255];
        $config['white']        = [255, 255, 255];

        $this->ciqrcode->initialize($config);

        /* QR Data  */
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $save_name;

        $this->ciqrcode->generate($params);

        /* Return Data */
        return [
            'content' => $data,
            'file'    => $dir . $save_name,
        ];
    }
}
