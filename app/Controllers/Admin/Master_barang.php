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
        // Get search keyword from request
        $keyword = $this->request->getGet('search');
        
        // We need to modify the BarangModel to handle search
        // First let's check if we have a search term
        if (!empty($keyword)) {
            // Create a custom model instance and build the query with search
            $builder = $this->barangModel->table('barang')
                ->select('barang.*, satuan.nama as nama_satuan, group.nama as nama_group, barang.nama as nama_barang')
                ->join('satuan', 'satuan.id = barang.satuan')
                ->join('group', 'group.kode = barang.induk')
                ->like('barang.kode', $keyword)
                ->orLike('barang.nama', $keyword)
                ->orLike('group.nama', $keyword)
                ->orLike('satuan.nama', $keyword)
                ->orLike('barang.kode_lokasi', $keyword);
                
            // Use the builder for pagination
            $result = $this->setupPagination($builder);
        } else {
            // No search term, use the standard getBarang method
            $result = $this->setupPagination($this->barangModel->getBarang());
        }
        
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
            'totalPages' => $result['pager']['totalPages'],
            // Pass search keyword back to view
            'keyword' => $keyword
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
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        try {
            $data = [
                'induk' => $this->request->getPost('induk'),
                'kode' => $this->request->getPost('kode'),
                'nama' => $this->request->getPost('nama'),
                'satuan' => (int)$this->request->getPost('satuan'),
                'status' => 1,
                'min' => (int)($this->request->getPost('min') ?? 0),
                'harga' => (float)($this->request->getPost('harga') ?? 0),
                'kode_lokasi' => $this->request->getPost('kode_lokasi'),
            ];

            // Validate data
            if (!$this->validation->run($data, 'addBarangRule')) {
                return $this->response->setJSON([
                    'status' => false,
                    'errors' => $this->validation->getErrors()
                ]);
            }

            $saved = $this->barangModel->insert($data);

            if ($saved) {
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Data barang berhasil disimpan'
                ]);
            } else {
                throw new \Exception('Gagal menyimpan data barang');
            }

        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->response->setJSON([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    
    public function update()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        try {
            $id = $this->request->getPost('id');
            
            $data = [
                'induk' => $this->request->getPost('induk'),
                'kode' => $this->request->getPost('kode'),
                'nama' => $this->request->getPost('nama'),
                'satuan' => (int)$this->request->getPost('satuan'),
                'min' => (int)($this->request->getPost('min') ?? 0),
                'harga' => (float)($this->request->getPost('harga') ?? 0),
                'kode_lokasi' => $this->request->getPost('kode_lokasi'),
            ];

            // Validate data
            if (!$this->validation->run($data, 'updateBarangRule')) {
                return $this->response->setJSON([
                    'status' => false,
                    'errors' => $this->validation->getErrors()
                ]);
            }

            $updated = $this->barangModel->update($id, $data);

            if ($updated) {
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Data barang berhasil diupdate'
                ]);
            } else {
                throw new \Exception('Gagal mengupdate data barang');
            }

        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->response->setJSON([
                'status' => false,
                'message' => $e->getMessage()
            ]);
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
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        try {
            $id = $this->request->getVar('id');
            
            // Get complete barang data with joins
            $barang = $this->barangModel->select('
                    barang.*,
                    satuan.nama as nama_satuan,
                    group.nama as nama_group
                ')
                ->join('satuan', 'satuan.id = barang.satuan')
                ->join('group', 'group.kode = barang.induk')
                ->where('barang.id', $id)
                ->first();

            if (!$barang) {
                throw new \Exception('Data barang tidak ditemukan');
            }

            $view = view('modal/fhapus_barang', ['data' => (object)$barang]);
            
            return $this->response->setJSON([
                'status' => true,
                'content' => $view
            ]);

        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->response->setJSON([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        try {
            $id = $this->request->getPost('id');
            
            // Check if data exists
            $barang = $this->barangModel->find($id);
            if (!$barang) {
                throw new \Exception('Data barang tidak ditemukan');
            }

            // Delete the data
            if (!$this->barangModel->delete($id)) {
                throw new \Exception('Gagal menghapus data barang');
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Data barang berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            log_message('error', '[ERROR] {exception}', ['exception' => $e]);
            return $this->response->setJSON([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}