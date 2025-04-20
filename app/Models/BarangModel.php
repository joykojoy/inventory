<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'induk',
        'kode',
        'nama',
        'satuan',
        'status',
        'min',
        'harga' // Add this field
    ];
    protected $useTimestamps    = false;

    // Add type casting to ensure proper data type
    protected $casts = [
        'min' => 'integer'
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
}
