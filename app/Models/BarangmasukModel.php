<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangmasukModel extends Model
{
    protected $table            = 'barangmasuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['no_faktur', 'tgl_faktur', 'supplier', 'total'];

    public function getBarangMasuk($nofaktur = false)
    {
        $this->builder()->select('barangmasuk.*, supplier.nama as nama_supplier');
        if ($nofaktur) {
            return $this->builder()->join('supplier', 'supplier.kode = barangmasuk.supplier')
                ->where('no_faktur', $nofaktur)->orderBy('id', 'DESC')->get();
        } else {
            return $this->builder()->join('supplier', 'supplier.kode = barangmasuk.supplier')->orderBy('id', 'DESC')->get();
        }
    }
}
