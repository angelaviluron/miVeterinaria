<?php


namespace App\Controllers;

class Principal extends BaseController
{
    public function index()
    {
        $data['header']= view('header'); 
        $data['footer']= view('footer'); 
        return view('principal',$data);
    }
}

