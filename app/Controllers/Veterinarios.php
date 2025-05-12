<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Veterinario;

class Veterinarios extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function index()
    {
        $veterinario = new Veterinario();

        $orden = $this->request->getGet('orden') ?? 'v_id_asc';

        switch ($orden) {
            case 'apellido_asc':
                $campo = 'v_apellido';
                $direccion = 'ASC';
                break;
            case 'apellido_desc':
                $campo = 'v_apellido';
                $direccion = 'DESC';
                break;
            case 'fecha_asc':
                $campo = 'v_fechaIngreso';
                $direccion = 'ASC';
                break;
            case 'fecha_desc':
                $campo = 'v_fechaIngreso';
                $direccion = 'DESC';
                break;
            default:
                $campo = 'v_id';
                $direccion = 'ASC';
                break;
        }

        $datos['veterinarios'] = $veterinario->orderBy($campo, $direccion)->findAll();
        $datos['header'] = view('header');
        $datos['footer'] = view('footer');

        return view("veterinarios/mostrar_veterinario", $datos);
    }

    public function cargar()
    {
        $datos['header'] = view('header');
        $datos['footer'] = view('footer');

        return view('veterinarios/cargar_veterinario', $datos);
    }

    public function guardar()
{
    $veterinario = new Veterinario();

    $validacion = $this->validate([
        'v_nombre' => [
            'label' => 'Nombre',
            'rules' => 'required|min_length[3]|regex_match[/^[a-zA-Z\s]+$/]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'min_length' => 'El {field} debe tener al menos 3 caracteres.',
                'regex_match' => 'El {field} solo puede contener letras y espacios.'
            ]
        ],
        'v_apellido' => [
            'label' => 'Apellido',
            'rules' => 'required|min_length[3]|regex_match[/^[a-zA-Z\s]+$/]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'min_length' => 'El {field} debe tener al menos 3 caracteres.',
                'regex_match' => 'El {field} solo puede contener letras y espacios.'
            ]
        ],
        'v_especialidad' => [
            'label' => 'Especialidad',
            'rules' => 'required|in_list[1,2,3]',
            'errors' => [
                'required' => 'La {field} es obligatoria.',
                'in_list' => 'Seleccione una {field} válida.'
            ]
        ],
        'v_tel' => [
            'label' => 'Teléfono',
            'rules' => 'required|numeric|max_length[15]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'numeric' => 'El {field} solo debe contener números.',
                'max_length' => 'El {field} no debe superar los 15 dígitos.'
            ]
        ],
        'v_fechaIngreso' => 'required|valid_date[Y-m-d]',
    ]);

    if (!$validacion) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $datos = [
        'v_id'           => $this->request->getPost('v_id'),
        'v_nombre'       => $this->request->getPost('v_nombre'),
        'v_apellido'     => $this->request->getPost('v_apellido'),
        'v_especialidad' => $this->request->getPost('v_especialidad'), // numérico: 1, 2 o 3
        'v_tel'          => $this->request->getPost('v_tel'),
        'v_fechaIngreso' => $this->request->getPost('v_fechaIngreso'),
    ];

    $veterinario->insert($datos);

    return $this->response->redirect(base_url('/mostrar_veterinario'));
}


    public function borrar($id = null)
    {
        $veterinario = new Veterinario();
        $veterinario->where('v_id', $id)->delete($id);

        return $this->response->redirect(base_url('/mostrar_veterinario'));
    }

    public function editar($id = null)
    {
        $veterinario = new Veterinario();

        $datos['veterinario'] = $veterinario->where('v_id', $id)->first();
        $datos['header'] = view('header');
        $datos['footer'] = view('footer');

        return view('veterinarios/editar_veterinario', $datos);
    }

    public function actualizar()
    {
        $veterinario = new Veterinario();

        $datos = [
            'v_nombre'       => $this->request->getPost('v_nombre'),
            'v_apellido'     => $this->request->getPost('v_apellido'),
            'v_especialidad' => $this->request->getPost('v_especialidad'),
            'v_tel'          => $this->request->getPost('v_tel'),
            'v_fechaIngreso' => $this->request->getPost('v_fechaIngreso'),
            'v_fechaEgreso'  => $this->request->getPost('v_fechaEgreso'),
        ];

        $id = $this->request->getPost('v_id');
        $veterinario->update($id, $datos);

        return $this->response->redirect(base_url('/mostrar_veterinario'));
    }
}
