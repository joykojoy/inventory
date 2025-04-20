<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\BarangmasukModel;
use App\Models\Temp_barangmasukModel;
use App\Models\Detil_brgmasukModel;
use App\Models\SupplierModel;
use App\Models\Mutasi_stockModel;
use App\Models\StockModel;
use CodeIgniter\CLI\Console;

class Barangmasuk extends BaseController
{
    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->barangmasukModel = new BarangmasukModel();
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
            'data' => $this->barangmasukModel->getBarangMasuk()->getResult(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Stock',
            'nama_submenu' => 'Penerimaan Barang'
        ];
        return view('admin/manbrgmasuk', $data);
    }
    public function tambah()
    {
        $data = [
            'data' => $this->temp_barangmasukModel->findAll(),
            'supplier' => $this->supplierModel->findAll(),
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Kelola Stock',
            'nama_submenu' => 'Penerimaan Barang'
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
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        // simpan ke tabel temp brg masuk
        $noFaktur = $this->request->getPost('noFaktur');
        $supplier = $this->request->getPost('supplier');
        $kodeBarang = $this->request->getPost('kodeBarangInput');
        $jumlahBarang = $this->request->getPost('jumlahBarangInput');
        $hpp = $this->request->getPost('hpp');
        $subTotal = intval($hpp) * intval($jumlahBarang);
        $berhasil = $this->temp_barangmasukModel->save([
            'no_faktur' => $noFaktur,
            'tgl_faktur' => date("Y-m-d"),
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
            echo json_encode($output);
        } else {
            $output = [
                'status' => TRUE,
                'psn' => 'Simpan data gagal'
            ];
            echo json_encode($output);
        }
        // validasi nomer faktur
        // $data = [
        //     'no_faktur' => $noFaktur
        // ];
        // $validate = $this->validation->run($data, 'barangMasukRule');
        // if (!$validate) {
        //     $errors = $this->validation->getErrors();
        //     $output = [
        //         'status' => FALSE,
        //         'errors' => $errors
        //     ];
        //     echo json_encode($output);
        // } else {
        //     $subTotal = intval($hpp) * intval($jumlahBarang);
        //     $berhasil = $this->temp_barangmasukModel->save([
        //         'no_faktur' => $noFaktur,
        //         'tgl_faktur' => date("Y-m-d"),
        //         'supplier' => $supplier,
        //         'kode_brg' => $kodeBarang,
        //         'qtt' => $jumlahBarang,
        //         'hpp' => $hpp,
        //         'subtotal' => $subTotal,
        //     ]);
        //     if ($berhasil) {
        //         $output = [
        //             'status' => TRUE,
        //             'psn' => 'Simpan data berhasil'
        //         ];
        //         echo json_encode($output);
        //     } else {
        //         $output = [
        //             'status' => TRUE,
        //             'psn' => 'Simpan data gagal'
        //         ];
        //         echo json_encode($output);
        //     }
        // }
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
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $noFaktur = $this->request->getPost('noFaktur');
        $dataTemp = $this->temp_barangmasukModel->getTempBarangMasuk($noFaktur)->getResult();
        if (count($dataTemp) == 0) {
            $output = [
                'status' => 'nofound',
                'psn' => 'Data tidak ditemukan'
            ];
            echo json_encode($output);
        } else {
            // simpan barang ke detil brg masuk
            $k = 1;
            $total = 0;
            $kodeBarangMasuk = [];
            $qttMasuk = [];
            foreach ($dataTemp as $d) {
                // simpan barang ke detil brg masuk
                $total += $d->subtotal;
                $this->detil_brgmasukModel->save([
                    'no_faktur' => $d->no_faktur,
                    'tgl_faktur' => $d->tgl_faktur,
                    'supplier' => $d->supplier,
                    'kode_brg' => $d->kode_brg,
                    'qtt' => $d->qtt,
                    'hpp' => $d->hpp,
                    'subtotal' => $d->subtotal,
                ]);
                $kodeBarangMasuk[$k] = $d->kode_brg;
                $qttMasuk[$k] = $d->qtt;
                $k++;

                // simpan ke tabel stock 
                $data = $this->stockModel->getStock($d->kode_brg)->getResult();
                if (count($data) > 0) {
                    $data = $data[0];
                    $qtt = $data->qtt + $d->qtt;
                    $hpp = ($data->qtt * $data->hpp + $d->qtt * $d->hpp) / ($data->qtt + $d->qtt);
                    $dataEdit = [
                        'kode_brg' => $d->kode_brg,
                        'qtt' => $qtt,
                        'hpp' => $hpp
                    ];
                    $this->stockModel->update($data->id, $dataEdit);
                } else {
                    $this->stockModel->save([
                        'kode_brg' => $d->kode_brg,
                        'qtt' => $d->qtt,
                        'hpp' => $d->hpp
                    ]);
                }
            }
            // simpan ke tabel barang masuk
            $berhasil = $this->barangmasukModel->save([
                'no_faktur' => $noFaktur,
                'tgl_faktur' => $dataTemp[0]->tgl_faktur,
                'supplier' => $dataTemp[0]->supplier,
                'total' => $total,
            ]);
            // simpan ke tabel mutasi stock 
            $k = 1;
            foreach ($kodeBarangMasuk as $brg) {
                $this->mutasiStockModel->save([
                    'tgl' => $dataTemp[0]->tgl_faktur,
                    'kode_brg' => $brg,
                    'qtt_in' => $qttMasuk[$k],
                ]);
                $k++;
            }
            // kosongkan tabel temp 
            $this->temp_barangmasukModel->emptyTable();
            if ($berhasil) {
                $output = [
                    'status' => TRUE,
                    'psn' => 'Simpan data berhasil',
                    'kodebrg' => $kodeBarangMasuk,
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
}
