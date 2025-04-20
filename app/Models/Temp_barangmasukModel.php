<?php

namespace App\Models;

use CodeIgniter\Model;

class Temp_barangmasukModel extends Model
{
    protected $table            = 'temp_barangmasuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['no_faktur', 'tgl_faktur', 'supplier', 'kode_brg', 'qtt', 'hpp', 'subtotal'];

    public function getTempBarangMasuk($no_faktur)
    {
        $this->builder()->select('temp_barangmasuk.*, barang.nama as nama_brg');
        return $this->builder()->join('barang', 'barang.kode = temp_barangmasuk.kode_brg')
            ->where('no_faktur', $no_faktur)->orderBy('id', 'ASC')->get();
    }
}
