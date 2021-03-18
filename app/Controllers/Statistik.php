<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Database\MySQLi\Result;
use CodeIgniter\HTTP\Request;
use PhpParser\Builder;

class Statistik extends BaseController
{

    protected $orangModel;
    public function __construct()
    {

        $this->orangModel = new UserModel();
    }

    public function index()

    {
        $db  = \Config\Database::connect(); {
            $builder = $db->table('user');

            $builder->selectMax('nilai');
            $query  = $builder->get();

            $builder->selectMin('nilai');
            $nMin   = $builder->get();

            $builder->selectAvg('nilai');
            $nAvg   = $builder->get();

            $builder->selectCount('nilai');
            $nTotal = $builder->get();

            $builder->selectSum('nilai');
            $nSum   = $builder->get();

            $nf = $db->query('SELECT nilai, COUNT(*) as count FROM user GROUP BY nilai');


        }

        $user = $this->orangModel->findAll();

        $data = [

            'nf'            => $nf,
            'nSum'          => $nSum,
            'nTotal'        => $nTotal,
            'nAvg'          => $nAvg,
            'nMin'          => $nMin,
            'nMax'          => $query,
            'title'         => 'Statistik Deskriptif | Statistik',
            'users'         => $user,
            'validation'    => \Config\Services::validation()
        ];
        return view('statistik/index', $data);
    }



    public function save()
    {
        // validasi input

        if (!$this->validate([

            'nama' => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} harus diisi.',
                ]

            ],

            'nilai' => [

                'rules'              => 'required|integer|is_natural|less_than[101]|decimal',
                'errors'             => [
                    'required'       => '{field} harus diisi.',
                    'integer'        => '{field} harus desimal',
                    'less_than'      => '{field} maximal 100',
                    'decimal'        => '{field} harus desimal',
                    'is_natural'     => '{field} minimum 0'
                ]
            ]


        ])) {

            $validation = \Config\Services::validation();

            return redirect()->to('/statistik/index')->withInput()->with('validation', $validation);
        }


        $request = service('request');
        $request->getVar();


        $slug = url_title($request->getVar('nama'), '-', true);

        $this->orangModel->save([
            'nama' => $request->getVar('nama'),
            'slug' => $slug,
            'nilai' => $request->getVar('nilai')

        ]);

        session()->setFlashdata('pesan', 'Nilai berhasil ditambahkan.');

        return redirect()->to('/statistik');
    }



    public function delete($id)
    {

        $this->orangModel->delete($id);

        session()->setFlashdata('pesan', 'Nilai berhasil dihapus.');

        return redirect()->to('/statistik');
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Edit Nilai | Statistik',

            'validation' => \Config\Services::validation(),

            'user' => $this->orangModel->getUser($id)

        ];

        return view('/statistik/edit', $data);
    }



    public function update($id)

    {
        $request = service('request');
        $request->getVar();

        $slug = url_title($request->getVar('nama'), '-', true);

        if (!$this->validate([

            'nama' => [
                'rules'         => 'required',
                'errors'        => [
                    'required'  => '{field} harus diisi.',
                ]

            ],

            'nilai' => [

                'rules'              => 'required|integer|is_natural|less_than[101]|decimal',
                'errors'             => [
                    'required'       => '{field} harus diisi.',
                    'integer'        => '{field} harus desimal',
                    'less_than'      => '{field} maximal 100',
                    'decimal'        => '{field} harus desimal',
                    'is_natural'     => '{field} minimum 0'
                ]
            ]

        ])) {

            $validation = \Config\Services::validation();

            return redirect()->to('/statistik/edit/' . $request->getVar('id'))->withInput()->with('validation', $validation);
        }

        $this->orangModel->save([
            'id' => $id,
            'nama' => $request->getVar('nama'),
            'slug' => $slug,
            'nilai' => $request->getVar('nilai')

        ]);

        session()->setFlashdata('pesan', 'Nilai berhasil diubah.');

        return redirect()->to('/statistik');
    }

  
}