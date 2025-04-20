<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Temp_barangmasukModel;
use App\Models\Temp_barangkeluarModel;
use App\Models\Detil_brgmasukModel;

class Tes extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->temp_barangmasukModel = new Temp_barangmasukModel;
        $this->temp_barangkeluarModel = new Temp_barangkeluarModel;
        $this->detil_brgmasukModel = new Detil_brgmasukModel;
    }
    public function index()
    {
        $data = $this->detil_brgmasukModel->getDetilBrgMasuk('FK001')->getResult();
        dd($data);
    }
}
