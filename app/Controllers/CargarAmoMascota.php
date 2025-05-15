<?php

namespace App\Controllers;
use App\Models\MascotaModel;
use App\Models\Amo;

class CargarAmoMascota extends BaseController
{

    public function __construct(){
       helper("form");
    }

    public function index(): string
    {
       // helper('form');
        $data = array();
        $data['header']= view('header'); 
        $data['footer']= view('footer'); 
        return view('cargar_amo_mascota',$data);
    }

  public function guardar(){
    $validation = service('validation');

    $validation->setRules([
        // Amo
        'a_nombre' => 'required|min_length[2]|max_length[30]|alpha_space',
        'a_apellido' => 'required|min_length[2]|max_length[30]|alpha_space',
        'a_dir' => 'required|min_length[5]|max_length[100]',
        'a_tel' => 'required|regex_match[/^[0-9\s\-\+\(\)]{7,20}$/]',

        // Mascota
        'nombre' => 'required|min_length[1]|max_length[25]|alpha_numeric_space',
        'raza' => 'required|min_length[1]|max_length[25]|alpha_numeric_space',
        'especie' => 'required|in_list[1,2,3,4]',
        'fechaN' => 'required|valid_date'
    ], [
        // Mensajes personalizados para Amo
        'a_nombre' => [
            'required' => 'El nombre del amo es obligatorio.',
            'min_length' => 'El nombre del amo debe tener al menos 2 caracteres.',
            'max_length' => 'El nombre del amo no debe superar los 30 caracteres.',
            'alpha_space' => 'El nombre del amo solo puede contener letras y espacios.'
        ],
        'a_apellido' => [
            'required' => 'El apellido del amo es obligatorio.',
            'min_length' => 'El apellido debe tener al menos 2 caracteres.',
            'max_length' => 'El apellido no debe superar los 30 caracteres.',
            'alpha_space' => 'El apellido solo puede contener letras y espacios.'
        ],
        'a_dir' => [
            'required' => 'La dirección del amo es obligatoria.',
            'min_length' => 'La dirección debe tener al menos 5 caracteres.',
            'max_length' => 'La dirección no debe superar los 100 caracteres.'
        ],
        'a_tel' => [
            'required' => 'El teléfono del amo es obligatorio.',
            'regex_match' => 'El formato del teléfono no es válido.'
        ],

        'nombre' => [
            'required' => 'El nombre de la mascota es obligatorio.',
            'min_length' => 'El nombre de la mascota debe tener al menos 1 caracter.',
            'max_length' => 'El nombre de la mascota no debe superar los 25 caracteres.',
            'alpha_numeric_space' => 'El nombre de la mascota solo puede contener letras, números y espacios.'
        ],
        'raza' => [
            'required' => 'La raza es obligatoria.',
            'min_length' => 'La raza debe tener al menos 1 caracter.',
            'max_length' => 'La raza no debe superar los 25 caracteres.',
            'alpha_numeric_space' => 'La raza solo puede contener letras, números y espacios.'
        ],
        'especie' => [
            'required' => 'La especie es obligatoria.',
            'in_list' => 'La especie seleccionada no es válida.'
        ],
        'fechaN' => [
            'required' => 'La fecha de nacimiento es obligatoria.',
            'valid_date' => 'La fecha de nacimiento debe ser una fecha válida.'
        ]
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->to(base_url().'CargarAmoMascota')->with('errors', $validation->getErrors());
    }
    $mascotaModel = new MascotaModel();
    $mascotaModel->save([
        'm_nombre'=>$this->request->getPost('nombre'),
        'm_raza'=>$this->request->getPost('raza'),
        'm_especie'=>$this->request->getPost('especie'),
        'm_nacimiento'=>$this->request->getPost('fechaN')
    ]);

    $amoModel = new Amo();
    $amoModel->save([
        'a_nombre'     => $this->request->getPost('a_nombre'),
        'a_apellido'   => $this->request->getPost('a_apellido'),
        'a_dir'        => $this->request->getPost('a_dir'),
        'a_tel'        => $this->request->getPost('a_tel')
    ]);
    return redirect()->to(base_url("Principal"));

  }
}