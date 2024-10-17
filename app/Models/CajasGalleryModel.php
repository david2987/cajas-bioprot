<?php

namespace App\Models;

use CodeIgniter\Model;

class CajasGalleryModel extends Model
{
    protected $table = 'cajas_gallery';
    protected $primaryKey = 'id';    
    protected $allowedFields = ['id_caja','id_gallery'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // Campo para la fecha de creación
    protected $updatedField  = 'updated_at';  // Campo para la fecha de actualización
}
