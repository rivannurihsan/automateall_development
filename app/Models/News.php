<?php namespace App\Models;

use CodeIgniter\Model;

class News extends Model
{
    protected $table      = 'news';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'news' yang diurutkan berdasarkan tgl upload terbaru
     * 
     * @param string $column
     * @return array|false
     */  
    public function getNewss_Order_TglUpload($column){
        return $this->orderBy('tanggalUpload', 'DESC')->findColumn($column);
    }

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'news' berdasarkan id yang diinputkan pada parameter
     * 
     * @param string $column
     * @return array|false
     */     
    public function getNews_by_id($id, $column){
        return $this->where('id', $id)->first()[$column];
    }
}