<?php

namespace App\Models;

use CodeIgniter\Model;

class Detil_brgkeluarModel extends Model
{
    protected $table            = 'detil_brgkeluar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['no_do', 'tgl_do', 'customer', 'kode_brg', 'qtt', 'hrg', 'subtotal', 'keterangan'];

    public function getDetilBrgKeluar($no_do)
    {
        $this->builder()->select('detil_brgkeluar.*, barang.nama as nama_brg, customer.nama as nama_customer');
        return $this->builder()->join('barang', 'barang.kode = detil_brgkeluar.kode_brg')
            ->join('customer', 'customer.kode = detil_brgkeluar.customer')
            ->where('no_do', $no_do)->orderBy('id', 'ASC')->get();
    }
}
