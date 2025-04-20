<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;

class Mancustomer extends BaseController
{
    public function __construct()
    {
        $this->customerModel = new CustomerModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        // Build query using Query Builder
        $query = $this->customerModel->select('*')
                                    ->orderBy('nama', 'ASC');
        
        // Setup pagination
        $result = $this->setupPagination($query);
        
        $data = [
            'data' => $result['data'],
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Customer',
            'nama_submenu' => 'Kelola Customer',
            // Add pagination data
            'currentPage' => $result['pager']['currentPage'],
            'perPage' => $result['pager']['perPage'],
            'total' => $result['pager']['total'],
            'totalPages' => $result['pager']['totalPages']
        ];
        return view('admin/mancustomer', $data);
    }
    public function tambah()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $hasil = view('modal/fadd_customer');
        echo json_encode($hasil);
    }
    public function edit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getVar('id');
        $data = [
            'data' => $this->customerModel->find($id)
        ];
        $hasil = view('modal/fedit_customer', $data);
        echo json_encode($hasil);
    }
    public function simpan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = $this->request->getVar();
        $validate = $this->validation->run($data, 'addCustomerRule');
        if (!$validate) {
            $errors = $this->validation->getErrors();
            $output = [
                'status' => FALSE,
                'errors' => $errors
            ];
            echo json_encode($output);
        } else {
            $berhasil = $this->customerModel->save([
                'kode' => $data['kode'],
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'telp' => $data['telp'],
                'pic' => $data['pic'],
            ]);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data customer berhasil disimpan');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data customer gagal disimpan');
                echo json_encode(['status' => TRUE]);
            }
        }
    }
    public function update()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = $this->request->getPost();
        $id = $data['id'];
        $validate = $this->validation->run($data, 'updateCustomerRule');
        if (!$validate) {
            $errors = $this->validation->getErrors();
            $output = [
                'status' => FALSE,
                'errors' => $errors
            ];
            echo json_encode($output);
        } else {
            $dataEdit = [
                'kode' => $data['kode'],
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'telp' => $data['telp'],
                'pic' => $data['pic'],
            ];
            $berhasil = $this->customerModel->update($id, $dataEdit);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data customer berhasil diupdate');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data customer gagal diupdate');
                echo json_encode(['status' => TRUE]);
            }
        }
    }
    public function fhapus()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getVar('id');
        $data = [
            'data' => $this->customerModel->find($id),
        ];
        $hasil = view('modal/fhapus_customer', $data);
        echo json_encode($hasil);
    }
    public function delete()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $berhasil = $this->customerModel->delete($id);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data customer berhasil dihapus');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data customer gagal dihapus');
            echo json_encode(['status' => TRUE]);
        }
    }
}
