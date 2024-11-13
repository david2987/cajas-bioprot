<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use CodeIgniter\Controller;

class Gallery extends Controller
{
    public function index()
    {
        $model = new GalleryModel();
        $data['images'] = $model->findAll();

        return view('galeria/gallery_view', $data);
    }

    public function upload()
    {
        helper(['form', 'url']);

        if($this->request->getMethod() == 'POST') {

            $files = $this->request->getFiles();

            if($files){
                $model = new GalleryModel();

                foreach($files['images'] as $file){

                    if ($file->isValid() && !$file->hasMoved()) {
                        // Mover archivo al directorio de uploads en la carpeta public
                        $newName = $file->getRandomName();
                        $file->move(ROOTPATH . 'public/uploads', $newName);

                        // Guardar en la base de datos la ruta relativa
                        $model->insert([
                            'image_path' => 'uploads/' . $newName                        
                        ]);
                    }
                }                
                return redirect()->to('/gallery');
            }

        }

        return view('galeria/upload_view');
    }

    function getImagesCaja($idCaja){
        $db      = \Config\Database::connect();
        $query = $db->query('SELECT image_path FROM cajas_gallery INNER JOIN gallery ON gallery.id = cajas_gallery.id_gallery WHERE id_cajas = '.$idCaja);
        $results = $query->getResultArray();

        return json_encode($results);        
    }

}
