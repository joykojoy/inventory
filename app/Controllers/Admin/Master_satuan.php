<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SatuanModel;

class Master_satuan extends BaseController
{
    public function __construct()
    {
        $this->satuanModel = new SatuanModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'data' => $this->satuanModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Master satuan'
        ];
        return view('admin/massatuan', $data);
    }
    public function tambah()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $hasil = view('modal/fadd_satuan');
        echo json_encode($hasil);
    }
    public function edit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $data = [
            'data' => $this->satuanModel->find($id)
        ];
        $hasil = view('modal/fedit_satuan', $data);
        echo json_encode($hasil);
    }
    public function simpan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = $this->request->getVar();
        $validate = $this->validation->run($data, 'addSatuanRule');
        if (!$validate) {
            $errors = $this->validation->getErrors();
            $output = [
                'status' => FALSE,
                'errors' => $errors
            ];
            echo json_encode($output);
        } else {
            $berhasil = $this->satuanModel->save([
                'nama' => $data['nama'],
                'status' => 1
            ]);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data satuan berhasil disimpan');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data satuan gagal disimpan');
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
        $validate = $this->validation->run($data, 'addSatuanRule');
        if (!$validate) {
            $errors = $this->validation->getErrors();
            $output = [
                'status' => FALSE,
                'errors' => $errors
            ];
            echo json_encode($output);
        } else {
            $dataEdit = [
                'nama' => $data['nama'],
                'status' => 1
            ];
            $berhasil = $this->satuanModel->update($id, $dataEdit);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data satuan berhasil diupdate');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data satuan gagal diupdate');
                echo json_encode(['status' => TRUE]);
            }
        }
    }
    public function aktifkan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getVar('id');
        $dataEdit = $this->satuanModel->find($id);
        unset($dataEdit->status);
        if (!isset($dataEdit->status)) {
            $dataEdit->status = 1;
        };
        $berhasil = $this->satuanModel->update($dataEdit->id, $dataEdit);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data satuan berhasil diaktifkan');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data satuan gagal diaktifkan');
            echo json_encode(['status' => TRUE]);
        }
    }
    public function nonaktifkan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getVar('id');
        $dataEdit = $this->satuanModel->find($id);
        unset($dataEdit->status);
        if (!isset($dataEdit->status)) {
            $dataEdit->status = 0;
        };
        $berhasil = $this->satuanModel->update($dataEdit->id, $dataEdit);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data satuan berhasil dinonaktifkan');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data satuan gagal dinonaktifkan');
            echo json_encode(['status' => TRUE]);
        }
    }
    public function fhapus()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getVar('id');
        $data = [
            'data' => $this->satuanModel->find($id),
        ];
        $hasil = view('modal/fhapus_satuan', $data);
        echo json_encode($hasil);
    }
    public function delete()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $berhasil = $this->satuanModel->delete($id);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data satuan berhasil dihapus');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data satuan gagal dihapus');
            echo json_encode(['status' => TRUE]);
        }
    }
}
