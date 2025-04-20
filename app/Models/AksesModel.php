<?php

namespace App\Models;

use CodeIgniter\Model;

class AksesModel extends Model
{
    protected $table            = 'akses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = [];

    public function getMenu_akses($level_id)
    {
        $this->builder()->select('akses.*, level.*');
        return $this->builder()->join('level', 'level.id=akses.akses_menu_id')
            ->where('akses.level_id', $level_id)->get();
    }
}
