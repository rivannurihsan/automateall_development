<?php namespace App\Models;

use CodeIgniter\Model;

class Academy extends Model
{
    protected $table      = 'academy';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';

    /**
    * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'referral' yang diurutkan secara descending
     * berdasarkan kolom 'progress'
     * 
     * @param string $column
     * @return array|false
     */    
    public function getAcademy_Order_waktu($column){
        return $this->orderBy('waktuMulai', 'DESC')->findColumn($column);
    }

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'referral' berdasarkan 'id' yang diinputkan pada parameter
     * 
     * @param string $column
     * @param string $id
     * @return array|false
     */
    public function getAcademy_by_id($id, $column){
        return $this->where('id', $id)->first()[$column];
    }    
}