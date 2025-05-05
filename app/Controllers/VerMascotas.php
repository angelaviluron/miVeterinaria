<?php

namespace App\Controllers;
use App\Models\MascotaModel;

class VerMascotas extends BaseController
{
    public function index(): string
    {
        $mascotaModel = new MascotaModel();
        $mascotas = $mascotaModel->findAll();
        $data['mascotas']=$mascotas;
        $data['header']= view('header'); 
        $data['footer']= view('footer'); 
        return view('mascotas/ver_mascotas',$data);
    }

}
