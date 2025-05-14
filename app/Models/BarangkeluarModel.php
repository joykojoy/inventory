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

    public function getHistoryKeluar($tglAwal = null, $tglAkhir = null)
    {
        $builder = $this->builder();
        $builder->select('
            barangkeluar.tgl_do as tgl,
            barangkeluar.no_do,
            customer.nama as nama_customer,
            detil_brgkeluar.kode_brg,
            barang.nama as nama_brg,
            group.nama as nama_group,
            detil_brgkeluar.qtt as qtt_out,
            satuan.nama as nama_satuan
        ');
        $builder->join('detil_brgkeluar', 'barangkeluar.no_do = detil_brgkeluar.no_do');
        $builder->join('barang', 'detil_brgkeluar.kode_brg = barang.kode');
        $builder->join('customer', 'barangkeluar.customer = customer.kode');
        $builder->join('group', 'barang.induk = group.kode');
        $builder->join('satuan', 'barang.satuan = satuan.id');
        
        // Debug date conditions
        if ($tglAwal && $tglAkhir) {
            $builder->where('DATE(barangkeluar.tgl_do) >=', $tglAwal);
            $builder->where('DATE(barangkeluar.tgl_do) <=', $tglAkhir);
        }

        $builder->orderBy('barangkeluar.tgl_do', 'DESC');
        
        return $builder;
    }
}