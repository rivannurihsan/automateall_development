<?php namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'product' yang diurutkan berdasarkan tgl upload terbaru
     * 
     * @param string $column
     * @return array|false
     */  
    public function getProducts_Order_TglUpload($column){
        return $this->orderBy('tanggalUpload', 'DESC')->findColumn($column);
    }

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'product' berdasarkan id yang diinputkan pada parameter
     * 
     * @param string $column
     * @return array|false
     */   
    public function getProduct_by_id($id, $column){
        return $this->where('id', $id)->first()[$column];
    }
}