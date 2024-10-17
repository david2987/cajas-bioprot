<?php

namespace App\Models;

use CodeIgniter\Model;

class MovimientoModel extends Model
{
    protected $table = 'movimientos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'caja_id', 
        'fecha_salida', 
        'fecha_entrada', 
        'paciente', 
        'medico', 
        'servicio', 
        'tipo_entrada', 
        'momento_retiro', 
        'created_at', 
        'updated_at', 
        'usuario_despacho'
    ];
}
