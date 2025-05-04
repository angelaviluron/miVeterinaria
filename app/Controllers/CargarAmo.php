<?php

namespace App\Controllers;
//use App/Models/TareaModel

class CargarAmo extends BaseController
{

    public function __construct(){
       // helper("form");
    }

    public function index(): string
    {
       // helper('form');
        return view('amos/cargar_amo');
    }

  public function cargarAmo(){
    $nombre=$this->request->getPost('nombre');
  }


  //$usuarioModel= new UsuarioModel();


}
