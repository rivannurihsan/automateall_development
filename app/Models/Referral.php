<?php namespace App\Models;

use CodeIgniter\Model;

class Referral extends Model
{
    protected $table      = 'referral';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'referral' yang diurutkan berdasarkan nama
     * 
     * @param string $column
     * @return array|false
     */  
    public function getReferral_Order_nama($column, $idAcademy){
        return $this->where('id_academy', $idAcademy)->orderBy('nama')->findColumn($column);
    }
}