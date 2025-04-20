<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Allow access to login page
        if ($request->uri->getPath() === 'user/login') {
            return;
        }

        // Check if user is logged in
        if (!$session->get('logged_in')) {
            if ($request->isAJAX()) {
                $response = [
                    'status' => false,
                    'message' => 'Session expired. Please login again.'
                ];
                return $this->response->setJSON($response);
            }
            
            return redirect()->to('user/login')
                ->with('pesan', 'Silahkan login terlebih dahulu')
                ->with('color', 'warning');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}