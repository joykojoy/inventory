<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangkeluarModel;
use App\Models\Temp_barangkeluarModel;
use App\Models\Detil_brgkeluarModel;
use App\Models\CustomerModel;
use App\Models\Mutasi_stockModel;
use App\Models\StockModel;

class Barangkeluar extends BaseController
{
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->barangkeluarModel = new BarangkeluarModel();
        $this->temp_barangkeluarModel = new Temp_barangkeluarModel();
        $this->detil_brgkeluarModel = new Detil_brgkeluarModel();
        $this->customerModel = new CustomerModel();
        $this->mutasiStockModel = new Mutasi_stockModel();
        $this->stockModel = new StockModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $search = $this->request->getGet('search');
        $query = $this->barangkeluarModel->getBarangKeluar();

        // Filter search jika ada keyword
        if ($search) {
            $query = $query->groupStart()
                ->like('detil_brgkeluar.no_do', $search)
                ->orLike('detil_brgkeluar.customer', $search)
                ->orLike('barang.nama', $search)
                ->orLike('detil_brgkeluar.keterangan', $search)
                ->groupEnd();
        }

        // Setup pagination
        $result = $this->setupPagination($query);

        $data = [
            'data' => $result['data'],
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Stock',
            'nama_submenu' => 'Pegeluaran Barang',
            // Add pagination data
            'currentPage' => $result['pager']['currentPage'],
            'perPage' => $result['pager']['perPage'],
            'total' => $result['pager']['total'],
            'totalPages' => $result['pager']['totalPages'],
            'search' => $search // <-- kirim ke view
        ];
        return view('admin/manbrgkeluar', $data);
    }
    public function tambah()
    {
        $numberDO = count($this->barangkeluarModel->findAll()) + 1;
        $numberDO = 'DO-000' . $numberDO;
        $data = [
            'data' => $this->temp_barangkeluarModel->findAll(),
            'no_do' => $numberDO,
            'customer' => $this->customerModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Stock',
            'nama_submenu' => 'Pengeluaran Barang'
        ];
        return view('admin/barang_keluar', $data);
    }
    public function datatemp()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $noDO = $this->request->getPost('noDO');
        $data = [
            'data' => $this->temp_barangkeluarModel->getTempBarangKeluar($noDO)->getResult()
        ];
        $customer = (count($data['data']) == 0) ? '' : $data['data'][0]->customer;
        $output = [
            'hasil' => view('tabel/temp_brgkeluar', $data),
            'customer' => $customer
        ];
        echo json_encode($output);
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

        $noDO = $this->request->getPost('noDO');
        $customer = $this->request->getPost('customer');
        $kodeBarang = $this->request->getPost('kodeBarangKeluar');
        $jumlahBarang = (int)$this->request->getPost('jumlahBarangKeluar');
        $tglkeluar = $this->request->getPost('tglkeluar');
        $keterangan = $this->request->getPost('keterangan'); // <-- ambil keterangan dari POST

        // Check stock availability
        $currentStock = $this->stockModel->where('kode_brg', $kodeBarang)->first();
        
        if (!$currentStock || $currentStock->qtt < $jumlahBarang) {
            $available = $currentStock ? $currentStock->qtt : 0;
            return $this->response->setJSON([
                'status' => false,
                'psn' => "Stock tidak mencukupi. Stock tersedia: {$available}"
            ]);
        }
        
        $berhasil = $this->temp_barangkeluarModel->save([
            'no_do' => $noDO,
            'tgl_do' => $tglkeluar, // <-- gunakan tanggal input user
            'customer' => $customer,
            'kode_brg' => $kodeBarang,
            'qtt' => $jumlahBarang,
            'keterangan' => $keterangan // <-- simpan keterangan
        ]);

        if ($berhasil) {
            return $this->response->setJSON([
                'status' => true,
                'psn' => 'Item barang berhasil ditambahkan'
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'psn' => 'Item barang gagal ditambahkan'
        ]);
    }
    public function delete_detilbarang()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $id = $this->request->getPost('id');
        $berhasil = $this->temp_barangkeluarModel->delete($id);
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
        $hasil = view('modal/list_barang_keluar', $data);
        echo json_encode($hasil);
    }
    public function simpan()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $noDO = $this->request->getPost('noDO');
        $dataTemp = $this->temp_barangkeluarModel->getTempBarangKeluar($noDO)->getResult();
        if (count($dataTemp) == 0) {
            $output = [
                'status' => 'nofound',
                'psn' => 'Data tidak ditemukan'
            ];
            echo json_encode($output);
        } else {
            // simpan barang ke detil brg keluar
            $k = 1;
            $kodeBarangKeluar = [];
            $qttKeluar = [];
            foreach ($dataTemp as $d) {

                $this->detil_brgkeluarModel->save([
                    'no_do' => $d->no_do,
                    'tgl_do' => $d->tgl_do,
                    'customer' => $d->customer,
                    'kode_brg' => $d->kode_brg,
                    'qtt' => $d->qtt,
                    'keterangan' => $d->keterangan // <-- simpan keterangan
                ]);
                $kodeBarangKeluar[$k] = $d->kode_brg;
                $qttKeluar[$k] = $d->qtt;
                $k++;

                // simpan ke tabel stock 
                $data = $this->stockModel->getStock($d->kode_brg)->getResult();
                if (count($data) > 0) {
                    $data = $data[0];
                    $qtt = $data->qtt - $d->qtt;
                    $dataEdit = [
                        'kode_brg' => $d->kode_brg,
                        'qtt' => $qtt,
                        'hpp' => $data->hpp
                    ];
                    $this->stockModel->update($data->id, $dataEdit);
                }
            }
            // simpan ke tabel barang keluar
            $berhasil = $this->barangkeluarModel->save([
                'no_do' => $noDO,
                'tgl_do' => $dataTemp[0]->tgl_do,
                'customer' => $dataTemp[0]->customer,
            ]);
            // simpan ke tabel mutasi stock dan table stock 
            $k = 1;
            foreach ($kodeBarangKeluar as $brg) {
                $this->mutasiStockModel->save([
                    'tgl' => $dataTemp[0]->tgl_do,
                    'kode_brg' => $brg,
                    'qtt_out' => $qttKeluar[$k],
                ]);
            }
            // kosongkan tabel temp 
            $this->temp_barangkeluarModel->emptyTable();
            if ($berhasil) {
                $output = [
                    'status' => TRUE,
                    'psn' => 'Simpan data berhasil',
                    'kodebrg' => $kodeBarangKeluar,
                ];
                echo json_encode($output);
            } else {
                // $this->session->setFlashdata('pesan', 'Data gagal disimpan');
                $output = [
                    'status' => TRUE,
                    'psn' => 'Simpan data gagal'
                ];
                echo json_encode($output);
            }
        }
    }
    public function detil_do()
    {
        $noDO = $this->request->getPost('noDO');
        $data = [
            'data' => $this->detil_brgkeluarModel->getDetilBrgKeluar($noDO)->getResult()
        ];
        $hasil = view('modal/perincian_do', $data);
        echo json_encode($hasil);
    }
    // script awal edit DO
    // form edit DO
    public function fedit_do($no_do)
    {
        $data = [
            'data' => $this->detil_brgkeluarModel->getDetilBrgKeluar($no_do)->getResult(),
            'customer' => $this->customerModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Stock',
            'nama_submenu' => 'Pengeluaran Barang'
        ];
        return view('admin/fedit_do', $data);
    }
    public function dtemp_dofedit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $noDO = $this->request->getPost('noDO');
        // mengisi table temp utk edit 
        $data = $this->detil_brgkeluarModel->getDetilBrgKeluar($noDO)->getResult();
        if (count($data) > 0) {
            $dataTempFedit
                = $this->temp_barangkeluarModel->getTempBarangkeluar($noDO)->getResult();
            if (count($dataTempFedit) == 0) {
                foreach ($data as $d) {
                    $this->temp_barangkeluarModel->save([
                        'no_do' => $d->no_do,
                        'tgl_do' => $d->tgl_do,
                        'customer' => $d->customer,
                        'kode_brg' => $d->kode_brg,
                        'qtt' => $d->qtt,
                    ]);
                }
            }
        }
        $data = [
            'data' => $this->temp_barangkeluarModel->getTempBarangkeluar($noDO)->getResult()
        ];
        $output = [
            'hasil' => view('tabel/temp_dofedit', $data)
        ];
        echo json_encode($output);
    }
    public function cari_item_fedit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $data = [
            'data' => $this->barangModel->getBarang()->getResult(),
        ];
        $hasil = view('modal/list_barang_fedit_do', $data);
        echo json_encode($hasil);
    }
    public function simpan_fedit()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $noDO = $this->request->getPost('noDO');
        $customer = $this->request->getPost('customer');
        $tglDO = $this->request->getPost('tglDO');
        $dataTemp = $this->temp_barangkeluarModel->getTempBarangkeluar($noDO)->getResult();
        $data = $this->detil_brgkeluarModel->getDetilBrgKeluar($noDO)->getResult();
        // hapus isi tabel detil brg keluar yg noDO sesuai  
        if (count($data) > 0) {
            foreach ($data as $d) {
                $id = $d->id;
                $this->detil_brgkeluarModel->delete($id);
            }
        }
        // pindahkan data temp ke tabel detil brg keluar
        foreach ($dataTemp as $d) {
            $this->detil_brgkeluarModel->save([
                'no_do' => $d->no_do,
                'tgl_do' => $d->tgl_do,
                'customer' => $d->customer,
                'kode_brg' => $d->kode_brg,
                'qtt' => $d->qtt,
            ]);
        }
        // hapus data temp 
        $this->temp_barangkeluarModel->emptyTable();
        // mengupdate ke tabel brg keluar
        $dataEdit = [
            'no_do' => $noDO,
            'tgl_do' => $tglDO,
            'customer' => $customer,
        ];
        $data = $this->barangkeluarModel->getBarangKeluar($noDO)->getResult();
        if (count($data) > 0) {
            $id_brgkeluar = $data[0]->id;
        }
        $berhasil = $this->barangkeluarModel->update($id_brgkeluar, $dataEdit);
        if ($berhasil) {
            $this->session->setFlashdata('pesan', 'DO berhasil diedit');
            echo json_encode(['status' => TRUE]);
        } else {
            $this->session->setFlashdata('pesan', 'DO gagal diedit');
            echo json_encode(['status' => TRUE]);
        }
    }
    // end script edit DO
    public function return()
    {
        if (!$this->request->isAJAX()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        // cek data tabel brg keluar
        $noFaktur = $this->request->getPost('noFaktur');
        $data = $this->barangkeluarModel->getBarangKeluar($noFaktur)->getResult();
        $id_brgkeluar = $data[0]->id;
        if (
            count($data) > 0
        ) {
            $data = $this->detil_brgkeluarModel->getDetilBrgKeluar($noFaktur)->getResult();
            foreach ($data as $d) {
                $id = $d->id;
                $this->detil_brgkeluarModel->delete($id);
            }
            // hapus isi table brg keluar
            $berhasil = $this->barangkeluarModel->delete($id_brgkeluar);
            if ($berhasil) {
                $this->session->setFlashdata('pesan', 'Data berhasil diretur');
                echo json_encode(['status' => TRUE]);
            } else {
                $this->session->setFlashdata('pesan', 'Data gagal diretur');
                echo json_encode(['status' => TRUE]);
            }
        }
    }
    public function excel($tglAwal = null, $tglAkhir = null, $typeHistory = 'brg_out')
    {
        $tglAwal = $tglAwal ? date('Y-m-d', strtotime($tglAwal)) : date('Y-m-d');
        $tglAkhir = $tglAkhir ? date('Y-m-d', strtotime($tglAkhir)) : date('Y-m-d');

        // Ambil data dari model, pastikan field sesuai dengan yang dibutuhkan di view
        $result = $this->mutasiStockModel->getHisBrgKeluar($tglAwal, $tglAkhir);

        // Mapping data agar field sesuai dengan view
        $data = [];
        foreach ($result as $row) {
            $data[] = (object)[
                'tanggal'        => $row->tgl ?? $row->tanggal ?? '',
                'no_do'          => $row->no_do ?? '',
                'customer'       => $row->customer ?? '',
                'kode_barang'    => $row->kode_brg ?? $row->kode_barang ?? '',
                'nama_barang'    => $row->nama_brg ?? $row->nama_barang ?? '',
                'group'          => $row->nama_group ?? $row->group ?? '',
                'jumlah_keluar'  => $row->qtt_out ?? $row->jumlah ?? 0,
                'satuan'         => $row->nama_satuan ?? $row->satuan ?? '',
            ];
        }

        return view('admin/his_brgkeluar_excel', [
            'data'    => $data,
            'tglAwal' => $tglAwal,
            'tglAkhir'=> $tglAkhir
        ]);
    }
}