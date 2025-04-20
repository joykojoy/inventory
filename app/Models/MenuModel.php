<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields        = ['user_level_id', 'nama', 'url', 'icon', 'urutan', 'aktif', 'submenu'];

    public function getMenu($user_level_id)
    {
        $this->builder()->select('menu.*');
        return $this->builder()->join('level', 'level.id = menu.user_level_id')
            ->where(['menu.user_level_id' => $user_level_id, 'aktif' => '1'])->orderBy('urutan ASC')->get();
    }
}
