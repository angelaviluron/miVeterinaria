<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Amo;
use CodeIgniter\Images\Image;

class Amos extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function index()
    {
        $amo = new Amo();
        $datos['amos'] = $amo->orderBy('a_id', 'ASC')->findAll();
        $datos['header'] = view('header');
        $datos['footer'] = view('footer');

        return view("amos/mostrar_amo", $datos);
    }

    public function cargar()
    {
        $datos['header'] = view('header');
        $datos['footer'] = view('footer');

        return view('amos/cargar_amo', $datos);
    }

    public function guardar()
    {
        $amo = new Amo();

        // Obtener los datos del formulario con los NOMBRES correctos
        $datos = [
            'a_nombre'   => $this->request->getPost('a_nombre'),
            'a_apellido' => $this->request->getPost('a_apellido'),
            'a_dir'      => $this->request->getPost('a_dir'),
            'a_tel'      => $this->request->getPost('a_tel'),
        ];

        // Subida de imagen (opcional)
        if ($imagen = $this->request->getFile('imagen')) {
            if ($imagen->isValid() && !$imagen->hasMoved()) {
                $nuevoNombre = $imagen->getRandomName();
                $imagen->move('../public/imagenes/', $nuevoNombre);
                $datos['imagen'] = $nuevoNombre;
            }
        }

        $amo->insert($datos);

        return $this->response->redirect(base_url('/mostrar_amo'));
    }

    public function borrar($id=null){

        $amo=new Amo();
        $datosAmo=$amo->where('a_id',$id)->first();
        
        $amo->where('a_id',$id)->delete($id);
        return $this->response->redirect(base_url('/mostrar_amo'));
    }

    public function editar($id=null){
        

        $amo=new Amo();

        $datos['amo']=$amo->where('a_id',$id)->first();

        $datos['header'] = view('header');
        $datos['footer'] = view('footer');



        return view('amos/editar_amo',$datos);
    }
    public function actualizar(){
        $amo=new Amo();

        $datos = [
            'a_nombre'   => $this->request->getPost('a_nombre'),
            'a_apellido' => $this->request->getPost('a_apellido'),
            'a_dir'      => $this->request->getPost('a_dir'),
            'a_tel'      => $this->request->getPost('a_tel'),
        ];

        $id=$this->request->getPost('a_id');
        $amo->update($id,$datos);

        $this->response->redirect(base_url('/mostrar_amo'));
    }
    
    
}
/*para imagenes
<img class="img-thumbnail" alt=" src='<?=base_url()?> /uploads/ <?=$amo['imagen'];?> ' >
*/
?>


