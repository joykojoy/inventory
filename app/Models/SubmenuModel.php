<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    protected $table            = 'submenu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields        = ['id_menu_induk', 'nama', 'url', 'icon', 'urutan', 'aktif'];

    public function getSubmenu($menu_id = false)
    {
        $this->builder()->select('submenu.*, menu.nama as nama_induk');
        if ($menu_id) {
            return $this->builder()->join('menu', 'menu.id = submenu.id_menu_induk')
                ->where(['submenu.id_menu_induk' => $menu_id, 'submenu.aktif' => '1'])->orderBy('urutan ASC')->get();
        } else {
            return $this->builder()->join('menu', 'menu.id = submenu.id_menu_induk')
                ->orderBy('urutan ASC')->get();
        }
    }
}
