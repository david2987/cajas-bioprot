<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre_usuario', 
        'email', 
        'contrasena', 
        'habilitado', 
        'grupo_usuario_id'
    ];
}
