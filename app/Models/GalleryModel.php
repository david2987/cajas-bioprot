<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id';
    protected $allowedFields = ['image_path'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';  // Campo para la fecha de creación
    protected $updatedField  = 'updated_at';  // Campo para la fecha de actualización
}
