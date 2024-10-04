<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuarioModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserController extends ResourceController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->findAll();
        return view('admin/usuarios/index', $data);
    }

    public function create()
    {
        return view('admin/usuarios/create');
    }

    public function store()
    {
        $usuarioModel = new UsuarioModel();
        $data = $this->request->getPost();
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $usuarioModel->save($data);
        return redirect()->to('/admin/usuarios');
    }

    public function edit($id)
    {
        $usuarioModel = new UsuarioModel();
        $data['usuario'] = $usuarioModel->find($id);
        return view('admin/usuarios/edit', $data);
    }

    public function update($id)
    {
        $usuarioModel = new UsuarioModel();
        $data = $this->request->getPost();
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }
        
        $usuarioModel->update($id, $data);
        return redirect()->to('/admin/usuarios');
    }

    public function delete($id)
    {
        $usuarioModel = new UsuarioModel();
        $usuarioModel->delete($id);
        return redirect()->to('/admin/usuarios');
    }
}
