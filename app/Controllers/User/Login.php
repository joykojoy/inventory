<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\AksesModel;

class Login extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->levelModel = new levelModel();
        $this->aksesModel = new aksesModel();
        $this->validation = \Config\Services::validation();
        $this->errors = $this->validation->getErrors();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        return view('user/login');
    }
    public function ceklogin()
    {
        $dataLogin = $this->request->getPost();
        $user = $this->userModel->getUser($dataLogin['username'])->getResult();

        if (!$user) {
            $_SESSION['color'] = 'danger';
            $this->session->setFlashdata('pesan', 'Data akun tidak ditemukan');
            return redirect()->to('/user/login');
        }

        if (password_verify($dataLogin['pss'], $user[0]->password)) {
            $sessionData = [
                'logged_in' => true,
                'user_id' => $user[0]->id,
                'username' => $user[0]->username,
                'level' => $user[0]->level,
                'nama' => $user[0]->nama
            ];
            
            $this->session->set($sessionData);
            return redirect()->to('admin/dashboard');
        } else {
            $_SESSION['color'] = 'danger';
            $this->session->setFlashdata('pesan', 'Password salah');
            return redirect()->to('/user/login');
        }
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('user/login')->with('pesan', 'Berhasil logout');
    }
}
