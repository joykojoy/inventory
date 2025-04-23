<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $uri = $request->uri->getSegments();
        
        // Check if accessing admin area
        if ($uri[0] === 'admin') {
            // Allow dashboard for all logged in users
            if ($uri[1] === 'dashboard') {
                return;
            }
            
            // Allow historystock access for all levels (>= 1)
            if ($uri[1] === 'historystock' && $session->get('level') >= 1) {
                return;
            }
            
            // Restrict other admin pages to level <= 2
            if ($session->get('level') > 2) {
                return redirect()->to(base_url('admin/dashboard'))
                       ->with('pesan', 'Akses ditolak')
                       ->with('color', 'danger');
            }
        }
        
        // Check if accessing pegawai area
        if ($uri[0] === 'pegawai' && $session->get('level') > 3) {
            return redirect()->to(base_url('admin/dashboard'))
                   ->with('pesan', 'Akses ditolak')
                   ->with('color', 'danger');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}