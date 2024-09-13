<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClasificacionModel;
use App\Models\ArchivoModel;

class ArchivoController extends Controller
{

    public function __construct()
    {
        helper('form');
    }


    public function index()
    {
        $archivoModel = new ArchivoModel();
        $data['archivos'] = $archivoModel->select('archivos.*, clasificaciones.nombre AS clasificacion_nombre')
            ->join('clasificaciones', 'clasificaciones.id = archivos.clasificacion_id')
            ->orderBy('archivos.id', 'desc')
            ->findAll();

        return view('admin/archivos/index', $data);
    }

    public function create()
    {
        $clasificacionModel = new ClasificacionModel();
        $data['clasificaciones'] = $clasificacionModel->findAll();

        return view('admin/archivos/create', $data);
    }

    public function store()
    {
        $validationRule = [
            'archivos' => [
                'label' => 'Archivos',
                'rules' => 'uploaded[archivos]|ext_in[archivos,pdf]|max_size[archivos,50000]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
            return view('admin/archivos/create', $data);
        } else {
            $files = $this->request->getFileMultiple('archivos');
            $archivoModel = new ArchivoModel();
            // $uploadPath = WRITEPATH . 'uploads/recursosDigitales/';
            $uploadPath = ROOTPATH . 'public/uploads/recursosDigitales/';

            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $originalName = pathinfo($file->getClientName(), PATHINFO_FILENAME);
                    $extension = $file->getClientExtension();
                    $contador = 1;
                    $newName = $originalName . "." . $extension;

                    /*
                    do {
                        $newName = $originalName . "_" . $contador++ . '.' . $extension;
                    } while (file_exists($uploadPath . $newName));
                    */

                    if (file_exists($uploadPath . $newName)) {
                        $newName = $originalName . "_" . $contador++ . '.' . $extension;
                    }


                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }

                    $file->move($uploadPath, $newName);

                    $data = [
                        'nombre' => $newName,
                        'ruta' => 'uploads/recursosDigitales/' . $newName,
                        'clasificacion_id' => $this->request->getPost('clasificacion_id'),
                        'peso' => $file->getSize(),
                        'tipo' => $file->getClientMimeType(),
                    ];

                    $archivoModel->insert($data);
                } else {
                    log_message('error', 'Error al subir el archivo: ' . $file->getErrorString());
                }
            }

            session()->setFlashdata('success', 'Archivos subidos con éxito');
            return redirect()->to('/admin/archivos');
        }
    }




    public function edit($id)
    {
        $archivoModel = new ArchivoModel();
        $clasificacionModel = new ClasificacionModel();

        $data['archivo'] = $archivoModel->find($id);
        $data['clasificaciones'] = $clasificacionModel->findAll();

        if (!$data['archivo']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Archivo no encontrado');
        }

        return view('admin/archivos/edit', $data);
    }

    public function update($id)
    {
        $archivoModel = new ArchivoModel();

        $data = [
            'clasificacion_id' => $this->request->getPost('clasificacion_id'),
        ];

        if ($archivoModel->update($id, $data)) {
            session()->setFlashdata('success', 'Archivo actualizado con éxito');
        } else {
            session()->setFlashdata('error', 'Error al actualizar el archivo');
        }

        return redirect()->to('/admin/archivos');
    }

    public function delete($id)
    {
        $archivoModel = new ArchivoModel();

        if ($archivoModel->delete($id)) {
            session()->setFlashdata('success', 'Archivo eliminado con éxito');
        } else {
            session()->setFlashdata('error', 'Error al eliminar el archivo');
        }

        return redirect()->to('/admin/archivos');
    }





    public function descargar($id)
    {
        $archivoModel = new ArchivoModel();
        $archivo = $archivoModel->find($id);

        if (!$archivo || $archivo['deleted_at'] !== null) { // Verificar si el archivo existe y no está "eliminado"
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Archivo no encontrado o eliminado');
        }


        $rutaArchivo = WRITEPATH . 'uploads/' . $archivo['ruta'];

        if (!file_exists($rutaArchivo)) {
            throw new \CodeIgniter\Files\Exceptions\FileNotFoundException('El archivo no se encuentra en el servidor');
        }

        $this->response->setHeader('Content-Type', $archivo['tipo']);
        $this->response->setHeader('Content-Disposition', 'inline; filename="' . $archivo['nombre'] . '"');
        $this->response->setHeader('X-Frame-Options', 'SAMEORIGIN');
        $this->response->setHeader('Content-Security-Policy', "default-src 'self';");

        return $this->response->download($rutaArchivo, null);
    }




    public function visualizar($id)
    {
        $archivoModel = new ArchivoModel();
        $archivo = $archivoModel->find($id);

        if (!$archivo || $archivo['deleted_at'] !== null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Archivo no encontrado o eliminado');
        }

        if ($archivo['tipo'] !== 'application/pdf') {
            return redirect()->back()->with('error', 'Este archivo no es un PDF y no se puede visualizar.');
        }

        $rutaArchivo = $archivo['ruta'];

        if (!file_exists($rutaArchivo)) {
            throw new \CodeIgniter\Files\Exceptions\FileNotFoundException('El archivo no se encuentra en el servidor');
        }

        $data['archivo'] = $archivo;

        return view('admin/archivos/visualizar', $data);
    }

    public function visualizar2($id)
    {
        $archivoModel = new ArchivoModel();
        $archivo = $archivoModel->find($id);

        if (!$archivo || $archivo['deleted_at'] !== null) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Archivo no encontrado o eliminado');
        }

        if ($archivo['tipo'] !== 'application/pdf') {
            return redirect()->back()->with('error', 'Este archivo no es un PDF y no se puede visualizar.');
        }

        $rutaArchivo = $archivo['ruta'];

        if (!file_exists($rutaArchivo)) {
            throw new \CodeIgniter\Files\Exceptions\FileNotFoundException('El archivo no se encuentra en el servidor');
        }

        $data['archivo'] = $archivo;

        return view('frontend/visualizar', $data);
    }


    public function mostrarResultados()
    {
        $buscar = $this->request->getGet('buscar');

        $model = new ArchivoModel();
        $resultados = $model->buscar($buscar);

        return view('frontend/resultados_busqueda', ['resultados' => $resultados]);
    }
}
