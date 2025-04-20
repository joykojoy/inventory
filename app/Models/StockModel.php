<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table            = 'stock';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
                                    'kode_brg',
                                    'qtt',
                                    'hpp'
                                ];

    public function getStock($kode_brg = false)
    {
        $this->builder()->select('
            stock.*,
            barang.nama as nama_brg,
            barang.min as min_stok,
            satuan.nama as nama_satuan,
            group.nama as nama_group
        ');
        
        if ($kode_brg) {
            return $this->builder()
                ->join('barang', 'barang.kode = stock.kode_brg')
                ->join('satuan', 'satuan.id = barang.satuan')
                ->join('group', 'group.kode = barang.induk')
                ->where('kode_brg', $kode_brg)
                ->where('barang.status', 1)
                ->where('stock.qtt >=', 0)
                ->orderBy('group.kode', 'ASC')
                ->get();
        } else {
            return $this->builder()
                ->join('barang', 'barang.kode = stock.kode_brg')
                ->join('group', 'group.kode = barang.induk')
                ->join('satuan', 'satuan.id = barang.satuan')
                ->where('barang.status', 1)
                ->where('stock.qtt >=', 0)
                ->orderBy('group.kode', 'ASC')
                ->get();
        }
    }

    public function getReadyStock()
    {
        return $this->builder()
            ->select('
                barang.kode as kode_brg,
                barang.nama as nama_brg,
                barang.min as min_stok,
                barang.harga as harga,
                satuan.nama as nama_satuan,
                group.nama as nama_group,
                COALESCE(stock.qtt, 0) as qtt
            ')
            ->join('barang', 'barang.kode = stock.kode_brg', 'right')
            ->join('satuan', 'satuan.id = barang.satuan')
            ->join('group', 'group.kode = barang.induk')
            ->where('barang.status', 1)
            ->orderBy('group.kode', 'ASC')
            ->get();
    }
}
