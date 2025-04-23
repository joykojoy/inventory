<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangkeluarModel extends Model
{
    protected $table            = 'barangkeluar';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['no_do', 'tgl_do', 'customer'];

    public function getBarangKeluar($no_do = false)
    {
        if ($no_do) {
            return $this->builder()
                ->select('barangkeluar.*, barang.nama as nama_brg')
                ->join('detil_brgkeluar', 'detil_brgkeluar.no_do = barangkeluar.no_do')
                ->join('barang', 'barang.kode = detil_brgkeluar.kode_brg')
                ->where('barangkeluar.no_do', $no_do)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            return $this->builder()
                ->select('barangkeluar.*, barang.nama as nama_brg') 
                ->join('detil_brgkeluar', 'detil_brgkeluar.no_do = barangkeluar.no_do')
                ->join('barang', 'barang.kode = detil_brgkeluar.kode_brg')
                ->orderBy('id', 'DESC')
                ->get();
        }
    }
}