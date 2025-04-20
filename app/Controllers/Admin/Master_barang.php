<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\SatuanModel;
use App\Models\GroupModel;

class Master_barang extends BaseController
{
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->satuanModel = new SatuanModel();
        $this->groupModel = new GroupModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        // Build query
        $query = $this->barangModel->getBarang();
        
        // Setup pagination
        $result = $this->setupPagination($query);
        
        $data = [
            'data' => $result['data'],
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Master Barang',
            // Add pagination data
            'currentPage' => $result['pager']['currentPage'],
            'perPage' => $result['pager']['perPage'],
            'total' => $result['pager']['total'],
            'totalPages' => $result['pager']['totalPages']
        ];
        return view('admin/masbarang', $data);
    }
    public function tambah()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = [
            'satuan' => $this->satuanModel->findAll(),
            'group' => $this->groupModel->findAll(),
        ];
        $hasil = view('modal/fadd_barang', $data);
        echo json_encode($hasil);
    }
    public function edit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $kode_barang = $this->request->getVar('kode_barang');
        $data = [
            'data' => $this->barangModel->getBarang($kode_barang)->getResult()[0],
            'satuan' => $this->satuanModel->getSatuan()->getResult(),
            'group' => $this->groupModel->findAll(),
        ];
        $hasil = view('modal/fedit_barang', $data);
        echo json_encode($hasil);
    }
    public function simpan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = $this->request->getVar();
        $validate = $this->validation->run($data, 'addBarangRule');
        if (!$validate) {
            $errors = $this->validation->getErrors();
            $output = [
                'status' => FALSE,
                'errors' => $errors
            ];
            echo json_encode($output);
        } else {
            $berhasil = $this->barangModel->save([
                'induk' => $this->request->getPost('induk'),
                'kode' => $this->request->getPost('kode'),
                'nama' => $this->request->getPost('nama'),
                'satuan' => $this->request->getPost('satuan'),
                'status' => 1,
                'min' => (int)$this->request->getPost('min'), // Explicitly cast to integer
                'harga' => (float)$this->request->getPost('harga') // Add this line
            ]);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data barang berhasil disimpan');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data barang gagal disimpan');
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
        $validate = $this->validation->run($data, 'updateBarangRule');
        if (!$validate) {
            $errors = $this->validation->getErrors();
            $output = [
                'status' => FALSE,
                'errors' => $errors
            ];
            echo json_encode($output);
        } else {
            $dataEdit = [
                'induk' => $this->request->getPost('induk'),
                'kode' => $this->request->getPost('kode'),
                'nama' => $this->request->getPost('nama'),
                'satuan' => $this->request->getPost('satuan'),
                'min' => (int)$this->request->getPost('min'), // Explicitly cast to integer
                'harga' => (float)$this->request->getPost('harga') // Add this line
            ];
            $berhasil = $this->barangModel->update($id, $dataEdit);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data barang berhasil diupdate');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data barang gagal diupdate');
                echo json_encode(['status' => TRUE]);
            }
        }
    }
    public function aktifkan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $barang = $this->request->getVar('barang');
        $dataEdit = $this->barangModel->getBarang($barang)->getResult()[0];
        unset($dataEdit->status);
        if (!isset($dataEdit->status)) {
            $dataEdit->status = 1;
        };
        $berhasil = $this->barangModel->update($dataEdit->id, $dataEdit);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data barang berhasil diaktifkan');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data barang gagal diaktifkan');
            echo json_encode(['status' => TRUE]);
        }
    }
    public function nonaktifkan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $barang = $this->request->getVar('barang');
        $dataEdit = $this->barangModel->getBarang($barang)->getResult()[0];
        unset($dataEdit->status);
        if (!isset($dataEdit->status)) {
            $dataEdit->status = 0;
        };
        $berhasil = $this->barangModel->update($dataEdit->id, $dataEdit);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data barang berhasil dinonaktifkan');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data barang gagal dinonaktifkan');
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
            'data' => $this->barangModel->find($id),
        ];
        $hasil = view('modal/fhapus_barang', $data);
        echo json_encode($hasil);
    }
    public function delete()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $berhasil = $this->barangModel->delete($id);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'Data barang berhasil dihapus');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'Data barang gagal dihapus');
            echo json_encode(['status' => TRUE]);
        }
    }
}
