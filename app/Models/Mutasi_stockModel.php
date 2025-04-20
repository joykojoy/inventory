<?php

namespace App\Models;

use CodeIgniter\Model;

class Mutasi_stockModel extends Model
{
    protected $table = 'mutasi_stock';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['tgl', 'kode_brg', 'qtt_in', 'qtt_out'];

    public function getMutasiStock($kode_brg = false)
    {
        $this->builder()->select('mutasi_stock.*, barang.nama as nama_brg, satuan.nama');
        if ($kode_brg) {
            return $this->builder()->join('barang', 'barang.kode = mutasi_stock.kode_brg')
                ->join('satuan', 'satuan.id = barang.satuan')
                ->where('kode_brg', $kode_brg)->get();
        } else {
            return $this->builder()->join('barang', 'barang.kode = mutasi_stock.kode_brg')
                ->join('satuan', 'satuan.id = barang.satuan')->get();
        }
    }

    public function getHisBrg($tglAwal = null, $tglAkhir = null)
    {
        $builder = $this->db->table('mutasi_stock');
        $builder->select('
            mutasi_stock.*,
            barang.nama as nama_brg,
            barang.harga as harga,
            barang.satuan
        ');
        $builder->join('barang', 'barang.kode = mutasi_stock.kode_brg');
        
        if ($tglAwal && $tglAkhir) {
            $builder->where('DATE(mutasi_stock.tgl) >=', $tglAwal);
            $builder->where('DATE(mutasi_stock.tgl) <=', $tglAkhir);
        }
        
        $builder->orderBy('mutasi_stock.tgl', 'ASC');
        
        return $builder;
    }

    public function getHisBrgMasuk($tglAwal = null, $tglAkhir = null)
    {
        $builder = $this->db->table('mutasi_stock')
            ->select('
                mutasi_stock.tgl,
                mutasi_stock.kode_brg,
                mutasi_stock.qtt_in,
                barang.nama as nama_brg,
                barang.harga as harga,
                satuan.nama as nama_satuan,
                group.nama as nama_group,
                (mutasi_stock.qtt_in * barang.harga) as total_price_in
            ')
            ->join('barang', 'barang.kode = mutasi_stock.kode_brg')
            ->join('satuan', 'satuan.id = barang.satuan')
            ->join('group', 'group.kode = barang.induk')
            ->where('barang.status', 1)
            ->where('mutasi_stock.qtt_in >', 0);

        // Only add date filters if both dates are provided
        if (!empty($tglAwal) && !empty($tglAkhir)) {
            $builder->where('DATE(mutasi_stock.tgl) >=', $tglAwal)
                    ->where('DATE(mutasi_stock.tgl) <=', $tglAkhir);
        }

        return $builder->orderBy('mutasi_stock.tgl', 'ASC')->get();
    }

    public function getHisBrgKeluar($tglAwal, $tglAkhir)
    {
        return $this->db->table('mutasi_stock')
            ->select('
                mutasi_stock.tgl,
                mutasi_stock.kode_brg,
                mutasi_stock.qtt_out,
                barang.nama as nama_brg,
                barang.harga as harga,
                satuan.nama as nama_satuan,
                group.nama as nama_group,
                (mutasi_stock.qtt_out * barang.harga) as total_price_out
            ')
            ->join('barang', 'barang.kode = mutasi_stock.kode_brg')
            ->join('satuan', 'satuan.id = barang.satuan')
            ->join('group', 'group.kode = barang.induk')
            ->where('DATE(mutasi_stock.tgl) >=', $tglAwal)
            ->where('DATE(mutasi_stock.tgl) <=', $tglAkhir)
            ->where('barang.status', 1)
            ->where('mutasi_stock.qtt_out >', 0)
            ->orderBy('mutasi_stock.tgl', 'ASC')
            ->get();
    }
}
