<?php namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'product' yang diurutkan secara descending berdasarkan 
     * kolom 'tanggalupload'
     * 
     * parameter $column type string
     * return array
     */
    public function getProducts_Order_TglUpload($column){
        return $this->orderBy('tanggalUpload', 'DESC')->findColumn($column);
    }

    /**
     * Method untuk mengambil data sebuah baris dari tabel 'product' 
     * berdasarkan id yang diinputkan di parameter. lalu mengambil
     * kolom sesuai column yang diinputkan di parameter
     * 
     * parameter $id type string
     * parameter $column type string
     * return string
     */
    public function getProduct_by_id($id, $column){
        return $this->where('id', $id)->first()[$column];
    }
}