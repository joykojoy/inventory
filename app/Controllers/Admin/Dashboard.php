<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuModel;
use App\Models\SubmenuModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use App\Models\SupplierModel;
use App\Models\BarangmasukModel;
use App\Models\BarangkeluarModel;
use App\Models\StockModel; // Add this line
use CodeIgniter\Database\Exceptions\DatabaseException;

class Dashboard extends BaseController
{
    protected $menuModel;
    protected $submenuModel;
    protected $barangModel;
    protected $userModel;
    protected $supplierModel;
    protected $barangMasukModel;
    protected $barangKeluarModel;
    protected $stockModel; // Add this line
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Initialize session
        $this->session = \Config\Services::session();
        
        // Initialize models
        $this->menuModel = new MenuModel();
        $this->submenuModel = new SubmenuModel();
        $this->barangModel = new BarangModel();
        $this->userModel = new UserModel();
        $this->supplierModel = new SupplierModel();
        $this->barangMasukModel = new BarangmasukModel();
        $this->barangKeluarModel = new BarangkeluarModel();
        $this->stockModel = new StockModel(); // Add this line
    }

    public function index()
    {
        $user_level = $this->session->get('level');
        
        $dtmenu = $this->tampil_menu($user_level);
        $dtsubmenu = $this->tampil_submenu($user_level);

        // Modified query to properly handle min stock and quantity
        $readyStock = $this->barangModel->select('
                barang.kode as kode_brg,
                barang.nama as nama_brg,
                barang.satuan,
                barang.status,
                barang.min as min_stok,
                COALESCE(stock.qtt, 0) as qtt,
                satuan.nama as nama_satuan,
                group.nama as nama_group
            ')
            ->join('stock', 'stock.kode_brg = barang.kode', 'left')  // Left join to get all items even without stock
            ->join('satuan', 'satuan.id = barang.satuan')
            ->join('group', 'group.kode = barang.induk')
            ->where('barang.status', 1)  // Only active items
            ->orderBy('group.kode', 'ASC')
            ->findAll();

        // Transform the data to match the expected format
        foreach ($readyStock as &$item) {
            // Cast min_stok to integer
            $item->min_stok = (int)$item->min_stok;
            // Cast quantity to integer
            $item->qtt = (int)$item->qtt;
        }

        $data = [
            'title' => 'Dashboard',
            'nama_menu' => 'Dashboard',
            'nama_submenu' => 'Dashboard',
            'dtmenu' => $dtmenu,
            'dtsubmenu' => $dtsubmenu,
            'dtstock' => $readyStock,
            'total_barang' => $this->barangModel->where('status', 1)->countAllResults(),
            'total_barang_masuk' => $this->barangMasukModel->join('detil_brgmasuk', 'barangmasuk.no_faktur = detil_brgmasuk.no_faktur')
                                                          ->selectSum('detil_brgmasuk.qtt')
                                                          ->get()
                                                          ->getRow()
                                                          ->qtt ?? 0,
            'total_barang_keluar' => $this->barangKeluarModel->join('detil_brgkeluar', 'barangkeluar.no_do = detil_brgkeluar.no_do')
                                                           ->selectSum('detil_brgkeluar.qtt')
                                                           ->get()
                                                           ->getRow()
                                                           ->qtt ?? 0,
            'transaksi_masuk' => $this->barangMasukModel->countAllResults(),
            'transaksi_keluar' => $this->barangKeluarModel->countAllResults(),
            'total_user' => $this->userModel->where('status', 1)->countAllResults(),
            'total_supplier' => $this->supplierModel->countAllResults(),
            'user_detail' => [
                'nama' => $this->session->get('nama'),
                'username' => $this->session->get('username'),
                'level' => $user_level
            ]
        ];

        return view('admin/dashboard', $data);
    }
}
