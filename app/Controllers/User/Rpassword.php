<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Rpassword extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'validation' => $this->validation,
            'data' => $this->userModel->getUser($this->session->username)->getResult()[0],
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Ganti Password',
            'nama_submenu' => 'Ganti Password'
        ];
        return view('user/rpassword', $data);
    }
    public function updatepss()
    {
        $data = $this->request->getPost();
        $validate = $this->validation->run($data, 'resetPassword');
        if ($validate) {
            $data = $this->userModel->getUser($this->session->username)->getResult();
            if (count($data) > 0) {
                $id = $data[0]->id;
            }
            $pssbaru = password_hash($this->request->getPost('pss1'), PASSWORD_DEFAULT);
            $user = $this->userModel->find($id);
            unset($user->password);
            if (!isset($user->password)) {
                $user->password = $pssbaru;
            }
            $this->userModel->save($user);
            $_SESSION['color'] = 'success';
            session()->setFlashdata('pesan', 'Password berhasil diupdate');
            return redirect()->to('/user/profile');
        } else {
            $_SESSION['color'] = 'danger';
            session()->setFlashdata('pesan', 'Data belum valid');
            return redirect()->to('/user/rpassword')->withInput();
        }
    }
}
