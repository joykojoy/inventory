<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangmasukModel;
use App\Models\BarangkeluarModel;
use App\Models\Temp_barangmasukModel;
use App\Models\Detil_brgmasukModel;
use App\Models\SupplierModel;
use App\Models\Mutasi_stockModel;
use App\Models\StockModel;

class Historystock extends BaseController
{
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->barangmasukModel = new BarangmasukModel();
        $this->barangkeluarModel = new BarangkeluarModel();
        $this->temp_barangmasukModel = new Temp_barangmasukModel();
        $this->detil_brgmasukModel = new Detil_brgmasukModel();
        $this->supplierModel = new SupplierModel();
        $this->mutasiStockModel = new Mutasi_stockModel();
        $this->stockModel = new StockModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'data' => $this->barangmasukModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Laporan Stock',
            'nama_submenu' => 'Histori Barang All'
        ];
        return view('admin/history_brg', $data);
    }
    public function his_brg()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setStatusCode(404);
    }

    try {
        $tglAwal = $this->request->getPost('tglAwal');
        $tglAkhir = $this->request->getPost('tglAkhir');
        $opsi = $this->request->getPost('opsi');

        // Debug log
        log_message('debug', "his_brg called with dates: {$tglAwal} to {$tglAkhir}, opsi: {$opsi}");

        // Validate dates
        if (empty($tglAwal) || empty($tglAkhir)) {
            throw new \Exception('Tanggal awal dan akhir harus diisi');
        }

        // Get data based on opsi
        switch($opsi) {
            case 'brg_in':
                $resultData = $this->mutasiStockModel->getHisBrgMasuk($tglAwal, $tglAkhir);
                $view = 'tabel/his_brgmasuk';
                $excelRoute = 'barangmasuk/excel';
                break;
            case 'brg_out':
                $resultData = $this->mutasiStockModel->getHisBrgKeluar($tglAwal, $tglAkhir);
                $view = 'tabel/his_brgkeluar';
                $excelRoute = 'barangkeluar/excel';
                break;
            default:
                $resultData = $this->mutasiStockModel->getHisBrg($tglAwal, $tglAkhir);
                $view = 'tabel/his_brg';
                $excelRoute = 'historystock/excel';
        }

        $data = [
            'data' => $resultData,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'excelRoute' => $excelRoute
        ];

        $viewContent = view($view, $data);

        return $this->response->setJSON([
            'status' => true,
            'data' => $viewContent
        ]);

    } catch (\Exception $e) {
        log_message('error', '[History] Error: ' . $e->getMessage());
        return $this->response->setJSON([
            'status' => false,
            'message' => $e->getMessage()
        ])->setStatusCode(500);
    }
}
    public function his_brgmasuk()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        try {
            $tglAwal = $this->request->getPost('tglAwal');
            $tglAkhir = $this->request->getPost('tglAkhir');
            
            // Get data for barang masuk
            $result = $this->mutasiStockModel->getHisBrgMasuk($tglAwal, $tglAkhir)->getResult();
            
            // Prepare data for view
            $data = [
                'data' => $result,
                'tglAwal' => $tglAwal,
                'tglAkhir' => $tglAkhir
            ];
            
            // Render view
            $viewResult = view('tabel/his_brgmasuk', $data);
            
            return $this->response->setJSON([
                'status' => true,
                'data' => $viewResult
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
    public function his_brg_pdf($tglAwal, $tglAkhir, $typeHistory) 
    {
        try {
            // Get data based on history type
            switch($typeHistory) {
                case 'all':
                    $resultData = $this->mutasiStockModel->getHisBrg($tglAwal, $tglAkhir);
                    $view = 'admin/his_brg_pdf';
                    break;
                case 'brg_in':
                    $resultData = $this->mutasiStockModel->getHisBrgMasuk($tglAwal, $tglAkhir);
                    $view = 'admin/his_brgmasuk_pdf';
                    break;
                case 'brg_out':
                    $resultData = $this->mutasiStockModel->getHisBrgKeluar($tglAwal, $tglAkhir);
                    $view = 'admin/his_brgkeluar_pdf';
                    break;
                default:
                    throw new \Exception('Invalid history type');
            }

            $data = [
                'data' => $resultData, // Now resultData is already the result object
                'tglAwal' => $tglAwal,
                'tglAkhir' => $tglAkhir
            ];

            return view($view, $data);

        } catch (\Exception $e) {
            log_message('error', '[PDF Generation] Error: ' . $e->getMessage());
            return 'Error generating PDF: ' . $e->getMessage();
        }
    }
    public function barangmasuk()
    {
        $data = [
            'data' => $this->mutasiStockModel->getHisBrgMasuk(null, null), // Remove ->getResult() since method already returns results
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Laporan Stock',
            'nama_submenu' => 'Histori Barang Masuk'
        ];
        return view('admin/history_brgmasuk', $data);
    }
    public function barangkeluar()
    {
        $data = [
            'data' => $this->barangkeluarModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Laporan Stock',
            'nama_submenu' => 'Histori Barang Keluar'
        ];
        return view('admin/history_brgkeluar', $data);
    }
    public function ready()
{
    // Build query
    $query = $this->stockModel->getReadyStock();
    
    // Setup pagination
    $result = $this->setupPagination($query);
    
    $data = [
        'dtstock' => $result['data'],
        'level_akses' => $this->session->nama_level,
        'dtmenu' => $this->tampil_menu($this->session->level),
        'dtsubmenu' => $this->tampil_submenu($this->session->level),
        'nama_menu' => 'Laporan Stock', 
        'nama_submenu' => 'Stock Barang',
        // Add pagination data
        'currentPage' => $result['pager']['currentPage'],
        'perPage' => $result['pager']['perPage'],
        'total' => $result['pager']['total'],
        'totalPages' => $result['pager']['totalPages']
    ];
    
    return view('admin/readystock', $data);
}
    public function listpdf()
    {
        $data = [
            'data' => $this->stockModel->getReadyStock()->getResult() // Changed to use getReadyStock
        ];
        return view('admin/preadystock', $data);
    }
    public function history()
    {
        $tglAwal = $this->request->getGet('tglAwal');
        $tglAkhir = $this->request->getGet('tglAkhir');
        
        $data = [
            'data' => $this->stockModel->getHistory($tglAwal, $tglAkhir)->getResult(),
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir
        ];
        
        // Format dates and calculate totals
        foreach ($data['data'] as $item) {
            $item->tgl = date('d-m-Y', strtotime($item->tgl));
            $item->harga = (float)$item->harga;
        }
        
        return view('admin/history', $data);
    }
    public function excel($tglAwal = null, $tglAkhir = null)
{
    $tglAwal = $tglAwal ? date('Y-m-d', strtotime($tglAwal)) : date('Y-m-d');
    $tglAkhir = $tglAkhir ? date('Y-m-d', strtotime($tglAkhir)) : date('Y-m-d');

    // Ganti dengan method yang benar
    $data = $this->mutasiStockModel->getHisBrg($tglAwal, $tglAkhir);

    return view('admin/his_brg_excel', [
        'data'    => $data,
        'tglAwal' => $tglAwal,
        'tglAkhir'=> $tglAkhir
    ]);
}
}
