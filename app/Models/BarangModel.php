<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id',
        'induk',
        'kode',
        'nama',
        'satuan',
        'status',
        'min',
        'harga'
    ];
    protected $useTimestamps    = false;

    // Add proper type casting
    protected $casts = [
        'min' => 'integer',
        'status' => 'integer',
        'satuan' => 'integer',
        'harga' => 'decimal'
    ];

    public function getBarang($kode = false)
    {
        $builder = $this->db->table('barang');
        $builder->select('
            barang.*, 
            barang.nama as nama_barang, 
            barang.kode as kode_barang, 
            barang.min as min_stok, 
            satuan.nama as nama_satuan, 
            group.nama as nama_group, 
            barang.harga as harga' // Add price selection
        );
        if ($kode) {
            return $builder->join('satuan', 'satuan.id = barang.satuan')
                ->join('group', 'group.kode = barang.induk')
                ->where('barang.kode', $kode)->get();
        } else {
            return $builder->join('satuan', 'satuan.id = barang.satuan')
                ->join('group', 'group.kode = barang.induk')->get();
        }
    }

    public function updateHarga($kode, $harga)
    {
        return $this->update(['kode' => $kode], ['harga' => $harga]);
    }
}