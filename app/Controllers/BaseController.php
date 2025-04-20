<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AksesModel;
use App\Models\MenuModel;
use App\Models\SubmenuModel;


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
    public function tampil_menu($user_level_id)
    {
        $menuModel = new MenuModel();
        $aksesModel = new AksesModel();
        $dtlakses = $aksesModel->getMenu_akses($user_level_id)->getResult();
        $dtmenu = [];
        foreach ($dtlakses as $menu) {
            $dtmenu[$menu->nama] = $menuModel->getMenu($menu->akses_menu_id)->getResult();
        }
        return $dtmenu;
    }
    public function tampil_submenu($user_level_id)
    {
        $submenuModel = new SubmenuModel();
        $dtsubmenu = [];
        foreach ($this->tampil_menu($user_level_id) as $m) {
            foreach ($m as $ms) {
                if ($ms->submenu == '1') {
                    $dtsubmenu[$ms->id] = $submenuModel->getSubmenu($ms->id)->getResult();
                }
            }
        }
        return $dtsubmenu;
    }
    public function tgl_indonesia($tgl)
    {
        $nama_bln = [
            '01' => 'Januari',
            '02' => 'Febuari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'Nopember',
            '12' => 'Desember',
        ];
        $parsial = explode('-', $tgl);
        return $parsial[2] . '-' . $nama_bln[$parsial[1]] . '-' . $parsial[0];
    }

    // Add this function to your BaseController
    protected function println($message) {
        $debug_file = WRITEPATH . 'logs/price_debug.log';
        $timestamp = date('Y-m-d H:i:s');
        file_put_contents($debug_file, "[$timestamp] " . print_r($message, true) . "\n", FILE_APPEND);
    }

    protected function setupPagination($query)
    {
        // Get current page from URL parameter
        $currentPage = (int)($this->request->getGet('page') ?? 1);
        $perPage = 3; // Items per page
        
        // Calculate offset (start from 0 for first page)
        $offset = ($currentPage - 1) * $perPage;
        
        if ($query instanceof \CodeIgniter\Database\ResultInterface) {
            $allData = $query->getResult();
            $total = count($allData);
            
            // Remove +1 since header is not counted in data
            $data = array_slice($allData, $offset, $perPage, true);
        } else {
            // For Query Builder instances
            $total = $query->countAllResults(false);
            
            // Remove +1 from limit since header is not counted
            $data = $query->limit($perPage)
                         ->offset($offset)
                         ->get()
                         ->getResult();
        }
        
        $totalPages = (int)ceil($total / $perPage);
        
        return [
            'data' => $data,
            'pager' => [
                'currentPage' => $currentPage,
                'perPage' => $perPage,
                'total' => $total,
                'totalPages' => $totalPages,
                'offset' => $offset
            ]
        ];
    }
}
