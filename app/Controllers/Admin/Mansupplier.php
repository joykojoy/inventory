<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SupplierModel;

class Mansupplier extends BaseController
{
    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'data' => $this->supplierModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Supplier',
            'nama_submenu' => 'Kelola Supplier'
        ];
        return view('admin/mansupplier', $data);
    }
    public function tambah()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $hasil = view('modal/fadd_supplier');
        echo json_encode($hasil);
    }
    public function edit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getVar('id');
        $data = [
            'data' => $this->supplierModel->find($id)
        ];
        $hasil = view('modal/fedit_supplier', $data);
        echo json_encode($hasil);
    }
    public function simpan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'addSupplierRule');
        if (!$validate) {
            $errors = $this->validation->getErrors();
            $output = [
                'status' => FALSE,
                'errors' => $errors
            ];
            echo json_encode($output);
        } else {
            $berhasil = $this->supplierModel->save([
                'kode' => $data['kode'],
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'telp' => $data['telp'],
                'pic' => $data['pic'],
            ]);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data supplier berhasil disimpan');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data supplier gagal disimpan');
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
        $validate = $this->validation->run($data, 'updateSupplierRule');
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
            $berhasil = $this->supplierModel->update($id, $dataEdit);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data supplier berhasil diupdate');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data supplier gagal diupdate');
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
            'data' => $this->supplierModel->find($id),
        ];
        $hasil = view('modal/fhapus_supplier', $data);
        echo json_encode($hasil);
    }
    public function delete()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $berhasil = $this->supplierModel->delete($id);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data supplier berhasil dihapus');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data supplier gagal dihapus');
            echo json_encode(['status' => TRUE]);
        }
    }
}
