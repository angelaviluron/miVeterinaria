<?php 
namespace App\Models;

use CodeIgniter\Model;

class Veterinario extends Model {
    protected $table      = 'veterinario';
    protected $primaryKey = 'v_id';
    protected $allowedFields = [
        'v_id',
        'v_nombre',
        'v_apellido',
        'v_especialidad',
        'v_tel',
        'v_fechaIngreso',
        'v_fechaEgreso'
    ];
}
