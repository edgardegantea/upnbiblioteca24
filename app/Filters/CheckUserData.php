<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Services;

class CheckUserData implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario ha iniciado sesión
        if (!session()->has('user')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
        }

        // Obtener datos del usuario desde la sesión
        $user = session()->get('user');

        // Verificar si el perfil está incompleto
        if (!$user['is_profile_complete']) {
            // Si la ruta actual es 'profile/update', no redirigir en bucle
            $currentUrl = current_url();
            if (strpos($currentUrl, 'profile/update') === false) {
                return redirect()->to('/profile/update')->with('info', 'Por favor, completa tu perfil antes de continuar.');
            }
        }

        // Si el perfil está completo o ya está en la página de actualización, permitir el acceso
        return null;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
