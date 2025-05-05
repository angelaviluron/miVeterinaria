<?php

namespace App\Controllers;
use App\Models\MascotaModel;

class CargarMascota extends BaseController
{
    public function __construct(){
        helper('form');
    }
    public function index(): string
    {
        $data = array();
        $data['header']= view('header'); 
        $data['footer']= view('footer'); 
        return view('mascotas/cargar_mascota',$data);
    }

    public function cargarMascota(){
        $validation = service('validation');

        $validation->setRules([
            'nombre'=>'required|min_length[1]|max_length[25]|alpha_numeric_space',
            'raza'=>'required|min_length[1]|max_length[25]|alpha_numeric_space',
            'fechaN'=>'required'
        ],
        [
            'nombre'=>[
                'required'=>'El campo nombre es obligatorio',
                'min_length'=>'La longitud minima del nombre es de 1 caracter',
                'max_length'=>'La longitud maxima del nombre es de 25 caracteres',
                'alpha_numeric_space'=>'Solo se pueden usar caracteres alfanumericos y el espacio'
            ],
            'raza'=>[
                'required'=>'El campo Raza es obligatorio',
                'min_length'=>'La longitud minima de la raza es de 1 caracter',
                'max_length'=>'La longitud maxima de la raza es de 25 caracteres',
                'alpha_numeric_space'=>'Solo se pueden usar caracteres alfanumericos y el espacio'
            ],
            'fechaN'=>[
                'required'=>'La fecha de nacimiento es obligatoria'
            ]
        ]);
        if(!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
        $mascotaModel = new MascotaModel();
        $mascotaModel->save([
            'm_nombre'=>$this->request->getPost('nombre'),
            'm_raza'=>$this->request->getPost('raza'),
            'm_especie'=>$this->request->getPost('especie'),
            'm_nacimiento'=>$this->request->getPost('fechaN')
        ]);
        return redirect()->to(base_url()."index.php/CargarMascota");
    }
}
