<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $addUserRule = [
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ],
        'username' => [
            'rules' => 'required|min_length[3]|is_unique[user.username]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
                'is_unique' => 'username sudah terdaftar'
            ]
        ],
        'level' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'harus disi'
            ]
        ]
    ];
    public $updateUserRule = [
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ],
        'level' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'harus disi'
            ]
        ]
    ];
    public $addSupplierRule = [
        'kode' => [
            'rules' => 'required|min_length[2]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 2 karakter',
            ]
        ],
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ]
    ];
    public $updateSupplierRule = [
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ]
    ];
    public $addCustomerRule = [
        'kode' => [
            'rules' => 'required|min_length[2]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 2 karakter',
            ]
        ],
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ]
    ];
    public $updateCustomerRule = [
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ]
    ];
    public $addBarangRule = [
        'kode' => [
            'rules' => 'required|is_unique[barang.kode]',
            'errors' => [
                'required' => 'Kode barang harus diisi',
                'is_unique' => 'Kode barang sudah ada'
            ]
        ],
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama barang harus diisi'
            ]
        ],
        'induk' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Group harus dipilih'
            ]
        ],
        'satuan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Satuan harus dipilih'
            ]
        ]
    ];
    public $updateBarangRule = [
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama barang harus diisi'
            ]
        ],
        'induk' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Group harus dipilih'
            ]
        ],
        'satuan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Satuan harus dipilih'
            ]
        ]
    ];
    public $addSatuanRule = [
        'nama' => [
            'rules' => 'required|min_length[3]|is_unique[satuan.nama]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
                'is_unique' => 'sudah terdaftar'
            ]
        ]
    ];
    public $addGroupRule = [
        'kode' => [
            'rules' => 'required|min_length[2]|is_unique[group.kode]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 2 karakter',
                'is_unique' => 'kode group sudah terdaftar',
            ]
        ],
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ]
    ];
    public $updateGroupRule = [
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ]
    ];
    public $barangMasukRule = [
        'no_faktur' => [
            'rules' => 'required|is_unique[no_faktur]',
            'errors' => [
                'required' => 'harus disi',
                'is_unique' => 'Faktur sudah dientrikan',
            ]
        ]
    ];
    public $resetPassword = [
        'pss1' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'mininam 3 karakter',
            ]
        ],
        'pss2' => [
            'rules' => 'required|min_length[3]|matches[pss1]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'mininam 3 karakter',
                'matches' => 'password & konfirmasinya tdk sama'
            ]
        ]
    ];
}
