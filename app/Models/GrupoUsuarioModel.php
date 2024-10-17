<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupoUsuarioModel extends Model
{
    protected $table = 'grupos_usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['descripcion'];
}
