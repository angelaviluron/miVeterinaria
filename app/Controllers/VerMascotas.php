<?php

namespace App\Controllers;
use App\Models\MascotaModel;
use App\Models\Amo;
use App\Models\VinculoModel;

class VerMascotas extends BaseController
{
    public function __construct(){
        helper('form');
    }
    public function index(): string
    {
        $mascotaModel = new MascotaModel();
        $mascotas = $mascotaModel->findAll();
        $data['mascotas']=$mascotas;
        $data['header']= view('header'); 
        $data['footer']= view('footer'); 
        return view('mascotas/ver_mascotas',$data);
    }

    public function adoparMascota(){
        $idMascota = $this->request->getPost('idMascota');
        $idAmo = $this->request->getPost('idAmo');
        $amos = new Amo();
        $amo = $amos->where('a_id', $idAmo)->first();

        if(!$amo){
            return redirect()->back()->with('errors', ['amo' => 'Amo no encontrado']);
        }

        $vinculo = new VinculoModel();
        $existeVinculo = $vinculo
        ->where('v_a_id', $idAmo)
        ->where('v_m_nroRegistro', $idMascota)
        ->where('v_estado', 1)  // activo
        ->first();

        if($existeVinculo){
            return redirect()->to(base_url().'VerMascotas')->with('errors', ['mascotaAdoptada' => 'Esta mascota ya tiene un amo']);
        }

        $fechaActual = date('Y-m-d H:i:s');

        $vinculo->save([
            'v_a_id'=>$idAmo,
            'v_m_nroRegistro'=>$idMascota,
            'v_estado'=>1,
            'v_fechaAdopcion'=>$fechaActual
        ]);

       return redirect()->to(base_url('VerMascotas'));
    }

    public function darBajaMascota(){
        $idMascota = $this->request->getPost('idMascota');
        $vinculo = new VinculoModel();
        $motivo = $this->request->getPost('motivo');
        $fechaActual = date('Y-m-d H:i:s');
        $existeVinculo = $vinculo
                            ->where('v_m_nroRegistro', $idMascota)
                            ->where('v_estado', 1)  // activo
                            ->first();
        if(!$existeVinculo){
            $errores=[
                'vinculoNoExistente' => 'Esta mascota no tiene ningun vinculo'
            ];
            if($motivo==1){
                //se agrega fecha de fallecimiento
                $dato=[
                    'm_fechaBaja'=>$fechaActual
                ];
                $mascota = new MascotaModel(); 
                $mascota->update($idMascota,$dato);
                $errores['fallecimiento'] = 'Se ha cargado el estado de la mascota';
            }
            return redirect()->to(base_url().'VerMascotas')->with('errors', $errores);
        }

        $idVinculo = $existeVinculo['v_id'];
        $data =[
            'v_estado'=>0,
            'v_fechaBaja'=>$fechaActual,
            'v_motivoBaja'=>$motivo
        ];
        $vinculo->update($idVinculo,$data);

        if($motivo==1){
            //se agrega fecha de fallecimiento
            $dato=[
                'm_fechaBaja'=>$fechaActual
            ];
            $mascota = new MascotaModel(); 
            $mascota->update($idMascota,$dato);
        }
        return redirect()->to(base_url('VerMascotas'));
    }

}
