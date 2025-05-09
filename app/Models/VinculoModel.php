<?php namespace App\Models;
use CodeIgniter\Model;
class VinculoModel extends Model{
    protected $table='vinculo'; protected $primaryKey ='v_id';
    protected $useAutoIncrement=true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['v_a_id', 'v_m_nroRegistro', 'v_estado', 'v_fechaAdopcion', 'v_fechaBaja', 'v_motivoBaja'];
    protected $useTimestamps = false;  // Dates
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $validationRules = [];  // Validation
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}