<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LevelModel;

class Manuser extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->levelModel = new LevelModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'data' => $this->userModel->getUser()->getResult(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Akun User',
            'nama_submenu' => 'Kelola Akun User'
        ];
        return view('admin/manuser', $data);
    }
    public function tambah()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = [
            'dt_level' => $this->levelModel->findAll()
        ];
        $hasil = view('modal/fadd_user', $data);
        echo json_encode($hasil);
    }
    public function edit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $username = $this->request->getVar('username');
        $data = [
            'dt_user' => $this->userModel->getUser($username)->getResult()[0],
            'dt_level' => $this->levelModel->findAll(),
        ];
        $hasil = view('modal/fedit_user', $data);
        echo json_encode($hasil);
    }
    public function simpan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'level' => $this->request->getPost('level'),
            'status' => 1
        ];

        $validate = $this->validation->run($data, 'addUserRule');
        
        if (!$validate) {
            $output = [
                'status' => FALSE,
                'errors' => $this->validation->getErrors()
            ];
            echo json_encode($output);
        } else {
            $berhasil = $this->userModel->insertUser($data);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'User berhasil ditambahkan dengan password default: 12345678');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'User gagal ditambahkan');
                echo json_encode(['status' => FALSE]);
            }
        }
    }
    public function update()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = $this->request->getVar();
        $id = $data['id'];
        $dataAwal = $this->userModel->getUser($data['username'])->getResult()[0];
        $validate = $this->validation->run($data, 'updateUserRule');
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
                'username' => $data['username'],
                'level' => $data['level'],
                'status' => 1,
                'password' => $dataAwal->password
            ];
            $berhasil = $this->userModel->update($id, $dataEdit);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data user berhasil diupdate');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data user gagal diupdate');
                echo json_encode(['status' => TRUE]);
            }
        }
    }
    public function aktifkan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $username = $this->request->getVar('username');
        $dataEdit = $this->userModel->getUser($username)->getResult()[0];
        unset($dataEdit->status);
        if (!isset($dataEdit->status)) {
            $dataEdit->status = 1;
        };
        $berhasil = $this->userModel->update($dataEdit->id, $dataEdit);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data user berhasil diaktifkan');
            echo json_encode(['status' => TRUE]);
        }
    }
    public function nonaktifkan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $username = $this->request->getVar('username');
        $dataEdit = $this->userModel->getUser($username)->getResult()[0];
        unset($dataEdit->status);
        if (!isset($dataEdit->status)) {
            $dataEdit->status = 0;
        };
        $berhasil = $this->userModel->update($dataEdit->id, $dataEdit);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data user berhasil dinonaktifkan');
            echo json_encode(['status' => TRUE]);
        }
    }
    public function fhapus()
    {
        $username = $this->request->getVar('username');
        $data = [
            'dt_user' => $this->userModel->getUser($username)->getResult()[0],
        ];
        $hasil = view('modal/fhapus_user', $data);
        echo json_encode($hasil);
    }
    public function delete()
    {
        $id = $this->request->getVar('id');
        $berhasil = $this->userModel->delete($id);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data user berhasil dihapus');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data user gagal dihapus');
            echo json_encode(['status' => TRUE]);
        }
    }
}
