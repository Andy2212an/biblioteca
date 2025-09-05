<?php

namespace App\Models;
use CodeIgniter\Model;

class Persona extends Model
{
    protected $table      = 'personas';
    protected $primaryKey = 'idpersona';
    protected $allowedFields = ['dni','nombres', 'apellidos', 'telefono', 'iddistrito','direccion'];

    public function getPersonasConUbigeo()
    {
        $builder = $this->db->table($this->table . ' p');
        $builder->select('p.idpersona, p.dni, p.nombres, p.apellidos, p.telefono, p.direccion, d.departamento, pr.provincia, di.distrito');
        $builder->join('distritos di', 'p.iddistrito = di.iddistrito');
        $builder->join('provincias pr', 'di.idprovincia = pr.idprovincia');
        $builder->join('departamentos d', 'pr.iddepartamento = d.iddepartamento');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
