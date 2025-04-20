<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_barang',
        'id_user',
        'jumlah',
        'tgl_pinjam',
        'tgl_kembali',
        'status',
        'keterangan'
    ];
    
    public function getPeminjaman($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }
        
        return $this->where(['id' => $id])->first();
    }
}
