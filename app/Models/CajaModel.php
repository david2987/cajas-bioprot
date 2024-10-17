<?php

namespace App\Models;

use CodeIgniter\Model;

class CajaModel extends Model
{
    protected $table = 'cajas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre_caja', 'estado_caja', 'contenido', 'imagen','qr_code','categoria_id', 'created_at', 'updated_at'];
    
    public function getCajasWithCategoria($limit = 10)
    {
        return $this->select('cajas.*, categorias.nombre_categoria')
                    ->join('categorias', 'categorias.id = cajas.categoria_id', 'left')
                    ->paginate($limit);
    }

    public function cambioEstado($id,$nuevoEstado){
        $data = [
            'estado' => $nuevoEstado
        ];
    
        $this->update($id, $data);
    }
}
