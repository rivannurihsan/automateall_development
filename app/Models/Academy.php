<?php namespace App\Models;

use CodeIgniter\Model;

class Academy extends Model
{
    protected $table      = 'academy';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';

    public function getAcademy($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
        // Where
        (!$data)?null:$this->where($data);

        // Order By
        (!$orderBy)?null:$this->orderBy($orderBy, $typeOrder);

        // Get result
        if($column == false) {
            $result = $this->findAll();
        }elseif (gettype($column) != 'array') {
            $result = $this->findColumn($column);
        }elseif(count($column) == 1) {
            $result = $this->findColumn($column[0]);
        }else{
            $resultArr = [];
            $result = $this->findAll();
            for ($i=0; $i < count($column); $i++) { 
                for ($j=0; $j < count($result); $j++) { 
                    $resultArr[$j][$column[$i]] = $result[$j][$column[$i]];
                }
            }
            $result = $resultArr;
        }

        // Output result
        if (!$result) {
            return false;
        }elseif (count($result) == 1) {
            return $result[0];
        }else {
            return $result;
        }
    }
    
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
    public function getAcademy_by_id($id, $column=false){
        if ($column) {
            return $this->where('id', $id)->first()[$column];
        }else {
            return $this->where('id', $id)->first();
        }
    }

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'referral' berdasarkan 'id' yang diinputkan pada parameter
     * 
     * @param string $column
     * @param string $id
     * @return array|false
     */
    public function getAcademy_by_judul($judul, $column=false){
        if ($column) {
            return $this->where('judul', $judul)->first()[$column];
        }else {
            return $this->where('judul', $judul)->first();
        }
    }        
}