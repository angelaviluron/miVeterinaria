<?php

namespace App\Controllers;
use App\Models\MascotaModel;
use App\Models\VinculoModel;

class VerMascotas extends BaseController
{
    public function __construct(){
        helper('form');
    }
    public function index(): string
{
    $mascotaModel = new MascotaModel();

    $orden = $this->request->getGet('orden');
    switch ($orden) {
        case 'nombre_asc':
            $mascotaModel->orderBy('m_nombre', 'ASC');
            break;
        case 'nombre_desc':
            $mascotaModel->orderBy('m_nombre', 'DESC');
            break;
        case 'nac_asc':
            $mascotaModel->orderBy('m_nac', 'ASC');
            break;
        case 'nac_desc':
            $mascotaModel->orderBy('m_nac', 'DESC');
            break;
        default:
            $mascotaModel->orderBy('m_nroRegistro', 'ASC'); 
            break;
    }

    $mascotas = $mascotaModel->findAll();

    $data['mascotas'] = $mascotas;
    $data['header'] = view('header'); 
    $data['footer'] = view('footer'); 
        return view('mascotas/ver_mascotas',$data);
    }






    public function adoparMascota(){
        $idMascota = $this->request->getPost('idMascota');
        $idAmo = $this->request->getPost('idAmo');

        $vinculo = new VinculoModel();
        $existeVinculo = $vinculo
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

    public function mascota_de_amo($id = null)
{
    $vinculoModel = new VinculoModel();
    $mascotaModel = new MascotaModel();

    $vinculos = $vinculoModel->where('v_a_id', $id)->findAll();

    $datos['mascotas'] = [];

    if (!empty($vinculos)) {
        $nrosRegistro = array_column($vinculos, 'v_m_nroRegistro');

        $mascotas = $mascotaModel
            ->whereIn('m_nroRegistro', $nrosRegistro)
            ->findAll();

        
        $estadosVinculo = [];
        foreach ($vinculos as $vinculo) {
            $estadosVinculo[$vinculo['v_m_nroRegistro']] = $vinculo['v_estado'];
        }

        $especies = [
            0 => 'Perro',
            1 => 'Gato',
            2 => 'Ave',
            3 => 'Roedor',
            4 => 'Pez'
        ];

        
        foreach ($mascotas as &$mascota) {
            $codigoEspecie = (int)$mascota['m_especie'];
            $mascota['m_especie'] = $especies[$codigoEspecie] ?? 'Desconocido';

            $mascota['v_estado'] = $estadosVinculo[$mascota['m_nroRegistro']] ?? 'activo';
        }

        $datos['mascotas'] = $mascotas;
    }

    $datos['header'] = view('header'); 
    $datos['footer'] = view('footer'); 

    return view("amos/mascota_de_amo", $datos);
}
}
