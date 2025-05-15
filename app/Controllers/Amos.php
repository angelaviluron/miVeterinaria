<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Amo;
use App\Models\VinculoModel;


class Amos extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function index()
{
    $amo = new Amo();

    $orden = $this->request->getGet('orden') ?? 'a_id_asc';

    
    switch ($orden) {
        case 'apellido_asc':
            $campo = 'a_apellido';
            $direccion = 'ASC';
            break;
        case 'apellido_desc':
            $campo = 'a_apellido';
            $direccion = 'DESC';
            break;
        case 'fecha_asc':
            $campo = 'a_fechaAlta'; 
            $direccion = 'ASC';
            break;
        case 'fecha_desc':
            $campo = 'a_fechaAlta';
            $direccion = 'DESC';
            break;
        default:
            $campo = 'a_id';
            $direccion = 'ASC';
            break;
    }

    $datos['amos'] = $amo->orderBy($campo, $direccion)->findAll();
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

    $validacion = $this->validate([
        'a_nombre' => [
            'label' => 'Nombre',
            'rules' => 'required|min_length[3]|regex_match[/^[a-zA-Z\s]+$/]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'min_length' => 'El {field} debe tener al menos 3 caracteres.',
                'regex_match' => 'El {field} solo puede contener letras y espacios.'
            ]
        ],
        'a_apellido' => [
            'label' => 'Apellido',
            'rules' => 'required|min_length[3]|regex_match[/^[a-zA-Z\s]+$/]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'min_length' => 'El {field} debe tener al menos 3 caracteres.',
                'regex_match' => 'El {field} solo puede contener letras y espacios.'
            ]
        ],
        'a_tel' => [
            'label' => 'Teléfono',
            'rules' => 'required|numeric|max_length[15]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'numeric' => 'El {field} solo debe contener números.',
                'max_length' => 'El {field} no debe superar los 15 dígitos.'
            ]
        ]
    ]);

    if (!$validacion) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $datos = [
        'a_nombre'   => $this->request->getPost('a_nombre'),
        'a_apellido' => $this->request->getPost('a_apellido'),
        'a_dir'      => $this->request->getPost('a_dir'),
        'a_tel'      => $this->request->getPost('a_tel'),
    ];

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


    public function amo_de_mascota($id = null)
{
    $vinculoModel = new VinculoModel();
    $amoModel = new Amo();

    $vinculos = $vinculoModel->where('v_m_nroRegistro', $id)->findAll();

    $datos['amos'] = [];

    if (!empty($vinculos)) {
        foreach ($vinculos as $vinculo) {
            $amo = $amoModel->find($vinculo['v_a_id']);
            if ($amo) {
                // Agregamos el estado del vínculo a cada amo
                $amo['v_estado'] = $vinculo['v_estado'];
                $datos['amos'][] = $amo;
            }
        }
    }

    $datos['header'] = view('header'); 
    $datos['footer'] = view('footer'); 

    return view("mascotas/amo_de_mascota", $datos);
}


    }
    
    


?>


