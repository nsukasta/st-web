<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\PseudoTypes\True_;



class UserModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'nilai'];

    public function getUser($id = false)
    {
        if ($id == false) {

            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    // public function freq()
    // {
    //     $this->db->select('id, kota, provinsi, COUNT(provinsi) as total');
    //     $this->db->group_by('provinsi');
    //     $this->db->order_by('total', 'desc');
    //     $hasil = $this->db->get('tablename');
    //     return $hasil;
    // }
}