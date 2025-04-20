<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangkeluarModel extends Model
{
    protected $table            = 'barangkeluar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['no_do', 'tgl_do', 'customer', 'total'];

    public function getBarangKeluar($no_do = false)
    {
        if ($no_do) {
            return $this->builder()->where('no_do', $no_do)->orderBy('id', 'DESC')->get();
        } else {
            return $this->builder()->orderBy('id', 'DESC')->get();
        }
    }
}
