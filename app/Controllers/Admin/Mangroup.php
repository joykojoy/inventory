<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\GroupModel;

class Mangroup extends BaseController
{
    public function __construct()
    {
        $this->groupModel = new GroupModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'data' => $this->groupModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Group Barang'
        ];
        return view('admin/mangroup', $data);
    }
    public function tambah()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $hasil = view('modal/fadd_group');
        echo json_encode($hasil);
    }
    public function edit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getVar('id');
        $data = [
            'data' => $this->groupModel->find($id)
        ];
        $hasil = view('modal/fedit_group', $data);
        echo json_encode($hasil);
    }
    public function simpan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = $this->request->getVar();
        $validate = $this->validation->run($data, 'addGroupRule');
        if (!$validate) {
            $errors = $this->validation->getErrors();
            $output = [
                'status' => FALSE,
                'errors' => $errors
            ];
            echo json_encode($output);
        } else {
            $berhasil = $this->groupModel->save([
                'kode' => $data['kode'],
                'nama' => $data['nama'],
                'status' => 1
            ]);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data group berhasil disimpan');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data group gagal disimpan');
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
        $validate = $this->validation->run($data, 'updateGroupRule');
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
                'status' => 1
            ];
            $berhasil = $this->groupModel->update($id, $dataEdit);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data group berhasil diupdate');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data group gagal diupdate');
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
            'data' => $this->groupModel->find($id),
        ];
        $hasil = view('modal/fhapus_group', $data);
        echo json_encode($hasil);
    }
    public function delete()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $berhasil = $this->groupModel->delete($id);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data group berhasil dihapus');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data group gagal dihapus');
            echo json_encode(['status' => TRUE]);
        }
    }
}
