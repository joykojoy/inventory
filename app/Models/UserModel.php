<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama', 'username', 'password', 'level', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUser($username = false)
    {
        $this->builder()->select('user.*, level.nama as nama_level');
        if ($username) {
            return $this->builder()->join('level', 'level.id = user.level')
                ->where('username', $username)->get();
        } else {
            return $this->builder()->join('level', 'level.id = user.level')->get();
        }
    }

    public function insertUser($data)
    {
        // Add default password
        $data['password'] = password_hash('12345678', PASSWORD_DEFAULT);
        
        return $this->insert($data);
    }
}
