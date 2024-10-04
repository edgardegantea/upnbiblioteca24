<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UsuarioModel;

class ProfileController extends BaseController
{
    public function completeProfile()
    {
        $usuarioModel = new UsuarioModel();
        $session = session();
        $usuario = $usuarioModel->find($session->get('user_id'));

        return view('profile/complete', ['usuario' => $usuario]);
    }


    public function updateProfile()
    {
        $usuarioModel = new UsuarioModel();
        $session = session();
        $data = $this->request->getPost();
        
        $usuarioModel->update($session->get('user_id'), $data);

        $usuarioModel->update($session->get('user_id'), ['is_profile_complete' => 1]);

        return redirect()->to('/' . $session->get('role'));
    }
}
