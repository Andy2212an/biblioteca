<?php
namespace App\Models;

use CodeIgniter\Model;

class Recurso extends Model
{
    protected $table      = 'recursos';
    protected $primaryKey = 'idrecurso';

    protected $allowedFields = [
        'titulo',
        'tipo',
        'apublicacion',
        'isbn',
        'numpaginas',
        'estado',
        'rutaportada',
        'rutarecurso',
        'idsubcategoria',
        'ideditorial'
    ];
}


