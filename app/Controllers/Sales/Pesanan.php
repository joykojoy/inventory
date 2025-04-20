<?php

namespace App\Controllers\Sales;

use App\Controllers\BaseController;
use App\Models\StockModel;
use App\Models\BarangModel;
use App\Models\CustomerModel;
use App\Models\BarangkeluarModel;
use App\Models\Detil_brgkeluarModel;
use App\Models\Temp_barangkeluarModel;

class Pesanan extends BaseController
{
    protected $stockModel;

    public function __construct()
    {
        $this->stockModel = new StockModel();
        $this->barangModel = new BarangModel();
        $this->barangkeluarModel = new BarangkeluarModel();
        $this->temp_barangkeluarModel = new Temp_barangkeluarModel();
        $this->detil_brgkeluarModel = new Detil_brgkeluarModel();
        $this->customerModel = new CustomerModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // Build query
        $query = $this->stockModel->getReadyStock();
        
        // Setup pagination
        $result = $this->setupPagination($query);
        
        // Format the price for each item
        foreach ($result['data'] as $item) {
            $item->harga = (float)$item->harga;
        }
        
        $data = [
            'data' => $result['data'],
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Sales', 
            'nama_submenu' => 'Pesanan',
            // Add pagination data
            'currentPage' => $result['pager']['currentPage'],
            'perPage' => $result['pager']['perPage'],
            'total' => $result['pager']['total'],
            'totalPages' => $result['pager']['totalPages']
        ];
        
        return view('sales/index', $data);
    }
}
