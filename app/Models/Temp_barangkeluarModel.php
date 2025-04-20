<?php

namespace App\Models;

use CodeIgniter\Model;

class Temp_barangkeluarModel extends Model
{
    protected $table            = 'temp_barangkeluar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['no_do', 'tgl_do', 'customer', 'kode_brg', 'qtt', 'hrg', 'subtotal'];

    public function getTempBarangkeluar($no_do)
    {
        $this->builder()->select('temp_barangkeluar.*, barang.nama as nama_brg');
        return $this->builder()->join('barang', 'barang.kode = temp_barangkeluar.kode_brg')
            ->where('no_do', $no_do)->orderBy('id', 'ASC')->get();
    }
}
