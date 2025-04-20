<?php

namespace App\Models;

use CodeIgniter\Model;

class Detil_brgmasukModel extends Model
{
    protected $table            = 'detil_brgmasuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['no_faktur', 'tgl_faktur', 'supplier', 'kode_brg', 'qtt', 'hpp', 'subtotal'];

    public function getDetilBrgMasuk($no_faktur)
    {
        $this->builder()->select('detil_brgmasuk.*, barang.nama as nama_brg, supplier.nama as nama_supplier');
        return $this->builder()->join('barang', 'barang.kode = detil_brgmasuk.kode_brg')
            ->join('supplier', 'supplier.kode = detil_brgmasuk.supplier')
            ->where('no_faktur', $no_faktur)->orderBy('id', 'ASC')->get();
    }
}
