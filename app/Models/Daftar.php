<?php namespace App\Models;

use CodeIgniter\Model;

class Daftar extends Model
{
    protected $table = 'daftar';
    protected $returnType = 'array';
    protected $allowedFields = ['idUser', 'idFriend', 'idAcademy', 'tglDaftar'];

    /**
     * Method untuk input data baru pada tabel daftar
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */
    public function insertDaftar($data){
        return $this->insert($data);
    }

}