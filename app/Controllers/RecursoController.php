<?php  
namespace App\Controllers;

use App\Models\Recurso;
use App\Models\CategoriaModel;
use App\Models\SubcategoriaModel;
use App\Models\EditorialModel;

class RecursoController extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();

        $builder = $db->table('recursos r')
            ->select('r.*, c.nombre as categoria, s.nombre as subcategoria, e.empresa as editorial, e.nacionalidad')
            ->join('subcategorias s', 'r.idsubcategoria = s.idsubcategoria')
            ->join('categorias c', 's.idcategoria = c.idcategoria')
            ->join('editoriales e', 'r.ideditorial = e.ideditorial')
            ->orderBy('r.idrecurso', 'ASC');

        $datos['recursos'] = $builder->get()->getResultArray();

        $datos['header'] = view('layouts/header');
        $datos['footer'] = view('layouts/footer');

        return view('recursos/index', $datos);
    }

    // Formulario crear
    public function crear(): string
    {
        $categoriaModel    = new CategoriaModel();
        $editorialModel    = new EditorialModel();

        $db = \Config\Database::connect();
        $builder = $db->table('subcategorias s')
                    ->select('s.idsubcategoria, s.nombre, c.nombre as categoria')
                    ->join('categorias c', 's.idcategoria = c.idcategoria');
        $subcategorias = $builder->get()->getResultArray();

        $datos = [
            'header'        => view('layouts/header'),
            'footer'        => view('layouts/footer'),
            'categorias'    => $categoriaModel->findAll(),
            'subcategorias' => $subcategorias,
            'editoriales'   => $editorialModel->findAll()
        ];

        return view('recursos/crear', $datos);
    }


    public function store()
    {
        $recurso = new Recurso();

        $data = [
            'idsubcategoria' => $this->request->getVar('idsubcategoria'),
            'ideditorial'    => $this->request->getVar('ideditorial'),
            'titulo'         => $this->request->getVar('titulo'),
            'tipo'           => $this->request->getVar('tipo'),
            'apublicacion'   => $this->request->getVar('apublicacion'),
            'isbn'           => $this->request->getVar('isbn'),
            'numpaginas'     => $this->request->getVar('numpaginas'),
            'estado'         => $this->request->getVar('estado'),
        ];

        // Subida de portada (imagen)
        if ($file = $this->request->getFile('rutaportada')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/portadas', $newName);
                $data['rutaportada'] = 'uploads/portadas/' . $newName;
            }
        }

        // Subida de recurso (pdf, doc, etc.)
        if ($file = $this->request->getFile('rutarecurso')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/recursos', $newName);
                $data['rutarecurso'] = 'uploads/recursos/' . $newName;
            }
        }

        $recurso->insert($data);

        return redirect()->to(base_url('recursos'));
    }

    public function eliminar($idrecurso)
    {
        $recurso = new \App\Models\Recurso();
        $recurso->delete($idrecurso);

        return redirect()->to(base_url('recursos'))->with('mensaje', 'Recurso eliminado correctamente');
    }


}
