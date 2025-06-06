<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\{BarangModel, BarangmasukModel, Temp_barangmasukModel, Detil_brgmasukModel, SupplierModel, Mutasi_stockModel, StockModel};
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Barangmasuk extends BaseController
{
    /** @var \CodeIgniter\Database\ConnectionInterface */
    protected $db;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Initialize database connection
        $this->db = \Config\Database::connect();

        // Initialize models
        $this->barangModel = new BarangModel();
        $this->barangmasukModel = new BarangmasukModel();
        $this->temp_barangmasukModel = new Temp_barangmasukModel();
        $this->detil_brgmasukModel = new Detil_brgmasukModel();
        $this->supplierModel = new SupplierModel();
        $this->mutasiStockModel = new Mutasi_stockModel();
        $this->stockModel = new StockModel();

        // Initialize services
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        // Get search keyword from request
        $keyword = $this->request->getGet('search');
        
        // Build query
        $query = $this->barangmasukModel->getBarangMasuk();
        
        // Add search condition if keyword exists
        if (!empty($keyword)) {
            $query->like('no_faktur', $keyword)
                  ->orLike('tgl_faktur', $keyword)
                  ->orLike('supplier', $keyword);
        }
        
        // Setup pagination
        $result = $this->setupPagination($query);
        
        $data = [
            'data' => $result['data'],
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Stock',
            'nama_submenu' => 'Penerimaan Barang',
            // Add pagination data
            'currentPage' => $result['pager']['currentPage'],
            'perPage' => $result['pager']['perPage'],
            'total' => $result['pager']['total'],
            'totalPages' => $result['pager']['totalPages'],
            // Pass search keyword back to view
            'keyword' => $keyword
        ];
        
        return view('admin/manbrgmasuk', $data);
    }
    public function tambah()
    {
        $data = [
            'data' => $this->temp_barangmasukModel->findAll(),
            'supplier' => $this->supplierModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),  // Fixed: added $this
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Stock',
            'nama_submenu' => 'Penerimaan Barang',
            'no_faktur' => $this->generateNoFaktur()
        ];
        return view('admin/barang_masuk', $data);
    }
    public function datatemp()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $noFaktur = $this->request->getPost('noFaktur');
        $data = [
            'data' => $this->temp_barangmasukModel->getTempBarangMasuk($noFaktur)->getResult()
        ];
        $hasil = view('tabel/temp_brgmasuk', $data);
        echo json_encode($hasil);
    }
    public function detilbarang()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $kodeBarang = $this->request->getPost('kodeBarang');
        $data = [
            'data' => $this->barangModel->getBarang($kodeBarang)->getResult()[0]
        ];
        echo json_encode($data);
    }
    public function simpan_detilbarang()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound();
        }

        $noFaktur = $this->request->getPost('noFaktur');
        $supplier = $this->request->getPost('supplier');
        $kodeBarang = $this->request->getPost('kodeBarangInput');
        $jumlahBarang = $this->request->getPost('jumlahBarangInput');
        $hpp = $this->request->getPost('hpp');
        $subTotal = intval($hpp) * intval($jumlahBarang);

        // Check and update barang price if different
        $barang = $this->barangModel->find($kodeBarang);
        if ($barang && (float)$barang->harga !== (float)$hpp) {
            $this->barangModel->update($kodeBarang, ['harga' => $hpp]);
        }
        $tglreceived = $this->request->getPost('tglreceived'); // <-- AMBIL DARI POST
        // Save to temp table
        $berhasil = $this->temp_barangmasukModel->save([
            'no_faktur' => $noFaktur,
            'tgl_faktur' => $tglreceived, // <-- GUNAKAN INI
            'supplier' => $supplier,
            'kode_brg' => $kodeBarang,
            'qtt' => $jumlahBarang,
            'hpp' => $hpp,
            'subtotal' => $subTotal,
        ]);

        if ($berhasil) {
            $output = [
                'status' => TRUE,
                'psn' => 'Simpan data berhasil'
            ];
        } else {
            $output = [
                'status' => FALSE,
                'psn' => 'Simpan data gagal'
            ];
        }

        echo json_encode($output);
    }
    public function delete_detilbarang()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $berhasil = $this->temp_barangmasukModel->delete($id);
        if ($berhasil) {
            $output = [
                'status' => TRUE,
                'psn' => 'Data berhasil dihapus'
            ];
            echo json_encode($output);
        } else {
            $output = [
                'status' => TRUE,
                'psn' => 'Data gagal dihapus'
            ];
            echo json_encode($output);
        }
    }
    public function cari_item()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = [
            'data' => $this->barangModel->getBarang()->getResult(),
        ];
        $hasil = view('modal/list_barang', $data);
        echo json_encode($hasil);
    }
    public function simpan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            $noFaktur = $this->request->getPost('noFaktur');
            log_message('debug', 'SIMPAN: noFaktur=' . $noFaktur);

            // Check for duplicate faktur
            if ($this->barangmasukModel->where('no_faktur', $noFaktur)->first()) {
                log_message('error', 'SIMPAN: Nomor faktur sudah ada');
                throw new \Exception('Nomor faktur sudah ada dalam database');
            }

            $dataTemp = $this->temp_barangmasukModel->getTempBarangMasuk($noFaktur)->getResult();
            log_message('debug', 'SIMPAN: dataTemp=' . print_r($dataTemp, true));

            if (empty($dataTemp)) {
                log_message('error', 'SIMPAN: Data temp tidak ditemukan');
                throw new \Exception('Data tidak ditemukan');
            }

            foreach ($dataTemp as $d) {
                log_message('debug', 'SIMPAN: Insert detil_brgmasuk: ' . print_r($d, true));
                // Update product price if different
                $barang = $this->barangModel->find($d->kode_brg);
                if ($barang) {
                    if ((float)$barang->harga !== (float)$d->hpp) {
                        $this->barangModel->update($d->kode_brg, ['harga' => $d->hpp]);
                    }
                }

                // Save detail transaction
                $this->detil_brgmasukModel->insert([
                    'no_faktur' => $d->no_faktur,
                    'tgl_faktur' => $d->tgl_faktur,
                    'supplier' => $d->supplier,
                    'kode_brg' => $d->kode_brg,
                    'qtt' => $d->qtt,
                    'hpp' => $d->hpp,
                    'subtotal' => $d->subtotal
                ]);

                // Update stock
                $existingStock = $this->stockModel->where('kode_brg', $d->kode_brg)->first();
                if ($existingStock) {
                    $this->stockModel->update($existingStock->id, [
                        'qtt' => (int)$existingStock->qtt + (int)$d->qtt
                    ]);
                } else {
                    $this->stockModel->insert([
                        'kode_brg' => $d->kode_brg,
                        'qtt' => $d->qtt
                    ]);
                }

                // Record stock mutation
                $this->mutasiStockModel->insert([
                    'tgl' => $d->tgl_faktur,
                    'kode_brg' => $d->kode_brg,
                    'qtt_in' => $d->qtt,
                    'qtt_out' => 0,
                    'harga' => $d->hpp
                ]);
            }

            // Save header transaction
            log_message('debug', 'SIMPAN: Insert barangmasuk: ' . print_r([
                'no_faktur' => $noFaktur,
                'tgl_faktur' => $dataTemp[0]->tgl_faktur,
                'supplier' => $dataTemp[0]->supplier,
                'total' => array_sum(array_column((array)$dataTemp, 'subtotal'))
            ], true));

            $this->barangmasukModel->insert([
                'no_faktur' => $noFaktur,
                'tgl_faktur' => $dataTemp[0]->tgl_faktur,
                'supplier' => $dataTemp[0]->supplier,
                'total' => array_sum(array_column((array)$dataTemp, 'subtotal'))
            ]);

            if ($db->transStatus() === false) {
                $db->transRollback();
                log_message('error', 'SIMPAN: DB transStatus false');
                $output = ['status' => false, 'psn' => 'Gagal simpan'];
            } else {
                $db->transCommit();
                // Clear temp data after successful transaction
                $this->temp_barangmasukModel->where('no_faktur', $noFaktur)->delete();
                log_message('debug', 'SIMPAN: Sukses simpan dan hapus temp');
                $output = ['status' => true, 'psn' => 'Sukses simpan'];
            }

            echo json_encode($output);

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'SIMPAN: Exception: ' . $e->getMessage());
            echo json_encode([
                'status' => false,
                'psn' => 'Gagal simpan: ' . $e->getMessage()
            ]);
        }
    }
    public function detil_faktur()
    {
        $noFaktur = $this->request->getPost('nofaktur');
        $data = [
            'data' => $this->detil_brgmasukModel->getDetilBrgMasuk($noFaktur)->getResult()
        ];
        $hasil = view('modal/perincian_faktur', $data);
        echo json_encode($hasil);
    }
    public function fedit_faktur($nofaktur)
    {
        $data = [
            'data' => $this->detil_brgmasukModel->getDetilBrgMasuk($nofaktur)->getResult(),
            'supplier' => $this->supplierModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Stock',
            'nama_submenu' => 'Penerimaan Barang'
        ];
        return view('admin/fedit_faktur', $data);
    }
    public function cari_item_fedit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = [
            'data' => $this->barangModel->getBarang()->getResult(),
        ];
        $hasil = view('modal/list_barang_fedit', $data);
        echo json_encode($hasil);
    }
    public function databrgmasuk()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $noFaktur = $this->request->getPost('noFaktur');
        $data = [
            'data' => $this->detil_brgmasukModel->getDetilBrgMasuk($noFaktur)->getResult()
        ];
        $hasil = view('tabel/edit_faktur', $data);
        echo json_encode($hasil);
    }
    public function delete_fedit_faktur()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $noFaktur = $this->detil_brgmasukModel->find($id)->no_faktur;
        $this->detil_brgmasukModel->delete($id);
        // menghitung total faktur masuk
        $data = $this->detil_brgmasukModel->getDetilBrgMasuk($noFaktur)->getResult();
        $tglFaktur = $data[0]->tgl_faktur;
        $supplier = $data[0]->supplier;
        $total = 0;
        foreach ($data as $d) {
            $total += $d->subtotal;
        }
        // simpan ke tabel barang masuk
        $id = $this->barangmasukModel->getBarangMasuk($noFaktur)->getResult()[0]->id;
        $dataEdit = [
            'no_faktur' => $noFaktur,
            'tgl_faktur' => $tglFaktur,
            'supplier' => $supplier,
            'total' => $total,
        ];
        $berhasil = $this->barangmasukModel->update($id, $dataEdit);
        if ($berhasil) {
            $output = [
                'status' => TRUE,
                'psn' => 'Data berhasil dihapus'
            ];
            echo json_encode($output);
        } else {
            $output = [
                'status' => TRUE,
                'psn' => 'Data gagal dihapus'
            ];
            echo json_encode($output);
        }
    }
    public function simpan_fedit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        // simpan ke tabel detil brg masuk
        $noFaktur = $this->request->getPost('noFaktur');
        $tgl = $this->request->getPost('tglreceived');
        $supplier = $this->request->getPost('supplier');
        $kodeBarang = $this->request->getPost('kodeBarangInput');
        $jumlahBarang = $this->request->getPost('jumlahBarangInput');
        $hpp = $this->request->getPost('hpp');
        $subTotal = intval($hpp) * intval($jumlahBarang);
        $berhasil = $this->detil_brgmasukModel->save([
            'no_faktur' => $noFaktur,
            'tgl_faktur' => $tgl,
            'supplier' => $supplier,
            'kode_brg' => $kodeBarang,
            'qtt' => $jumlahBarang,
            'hpp' => $hpp,
            'subtotal' => $subTotal,
        ]);
        // menghitung total faktur masuk
        $data = $this->detil_brgmasukModel->getDetilBrgMasuk($noFaktur)->getResult();
        $total = 0;
        foreach ($data as $d) {
            $total += $d->subtotal;
        }
        // simpan ke tabel barang masuk
        $id = $this->barangmasukModel->getBarangMasuk($noFaktur)->getResult()[0]->id;
        $dataEdit = [
            'no_faktur' => $noFaktur,
            'tgl_faktur' => $tgl,
            'supplier' => $supplier,
            'total' => $total,
        ];
        $berhasil = $this->barangmasukModel->update($id, $dataEdit);

        if ($berhasil) {
            $output = [
                'status' => TRUE,
                'psn' => 'Simpan data berhasil'
            ];
            echo json_encode($output);
        } else {
            $output = [
                'status' => TRUE,
                'psn' => 'Simpan data gagal'
            ];
            echo json_encode($output);
        }
    }
    public function return()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        // cek data tabel brg masuk
        $noFaktur = $this->request->getPost('noFaktur');
        $data = $this->barangmasukModel->getBarangMasuk($noFaktur)->getResult();
        $id_brgmasuk = $data[0]->id;
        if (count($data) > 0) {
            $data = $this->detil_brgmasukModel->getDetilBrgMasuk($noFaktur)->getResult();
            foreach ($data as $d) {
                $id = $d->id;
                $this->detil_brgmasukModel->delete($id);
            }
            // hapus isi table brg masuk
            $berhasil = $this->barangmasukModel->delete($id_brgmasuk);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data berhasil diretur');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data gagal diretur');
                echo json_encode(['status' => TRUE]);
            }
        }
    }

    private function generateNoFaktur()
    {
        $prefix = 'FK-';
        $lastFaktur = $this->barangmasukModel->orderBy('no_faktur', 'DESC')->first();
        
        if ($lastFaktur) {
            // Extract number from last faktur
            $lastNumber = (int)substr($lastFaktur->no_faktur, 3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        $noFaktur = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        
        // Ensure unique number by checking if it already exists
        while ($this->barangmasukModel->where('no_faktur', $noFaktur)->first()) {
            $newNumber++;
            $noFaktur = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        }
        
        return $noFaktur;
    }

    // Add this method to your Barangmasuk controller
    public function updateHarga()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid request'
            ]);
        }

        try {
            // Get values using the correct field names from POST data
            $kodeBarang = trim($this->request->getPost('kode_brg'));
            $hargaBaru = (float)$this->request->getPost('harga');

            // Debug log
            log_message('debug', 'Update Harga - Kode: ' . $kodeBarang . ', Harga: ' . $hargaBaru);

            if (empty($kodeBarang)) {
                throw new \Exception('Kode barang tidak boleh kosong');
            }

            // Get specific barang by kode
            $barang = $this->barangModel->where('kode', $kodeBarang)->first();
            
            if (!$barang) {
                throw new \Exception("Barang dengan kode {$kodeBarang} tidak ditemukan");
            }

            // Update the price
            $updated = $this->barangModel->where('kode', $kodeBarang)
                                        ->set(['harga' => $hargaBaru])
                                        ->update();

            if ($updated) {
                return $this->response->setJSON([
                    'status' => true,
                    'message' => "Harga barang {$kodeBarang} berhasil diupdate"
                ]);
            }

            throw new \Exception('Gagal update harga');

        } catch (\Exception $e) {
            log_message('error', 'Update harga error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function scanBarcode()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid request'
            ]);
        }

        try {
            $barcode = $this->request->getPost('barcode');
            
            if (empty($barcode)) {
                throw new \Exception('Barcode tidak boleh kosong');
            }
            
            // Get barang data by barcode (kode)
            $barang = $this->barangModel->getBarang($barcode)->getRow();
            
            if (!$barang) {
                throw new \Exception("Barang dengan barcode {$barcode} tidak ditemukan");
            }

            return $this->response->setJSON([
                'status' => true,
                'data' => $barang
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Scan barcode error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function excel($tglAwal = null, $tglAkhir = null, $typeHistory = 'brg_in')
    {
        $tglAwal = $tglAwal ? date('Y-m-d', strtotime($tglAwal)) : date('Y-m-d');
        $tglAkhir = $tglAkhir ? date('Y-m-d', strtotime($tglAkhir)) : date('Y-m-d');

        // Ambil data barang masuk dari model
        $data = $this->mutasiStockModel->getHisBrgMasuk($tglAwal, $tglAkhir);

        // Kirim ke view Excel
        return view('admin/his_brgmasuk_excel', [
            'data' => $data,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir
        ]);
    }
}
