<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisoModel extends Model
{
    protected $table = 'permisos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['grupo_usuario_id', 'permiso'];
}
