<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoauthFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario ya ha iniciado sesión
        if (session()->has('user')) {
            $user = session()->get('user');

            // Redirigir al dashboard correspondiente según el rol
            if ($user['rol'] === 'admin') {
                return redirect()->to('/admin');
            }

            if ($user['rol'] === 'usuario') {
                return redirect()->to('/usuario');
            }

            // Redirige a un destino por defecto si el rol no coincide
            return redirect()->to('/usuario');
        }

        // Si no está autenticado, no hacer nada
        return null; // Retornar explícitamente null para evitar el error
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
