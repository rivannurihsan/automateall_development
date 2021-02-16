<?php namespace App\Models;

use CodeIgniter\Model;

class Bayar extends Model
{
    protected $table = 'bayar';
    protected $returnType = 'array';
    protected $allowedFields = ['id','idDaftar','idCourseDaftar','idCoupon','metode','tglBayar','hargaAwal','diskon','total','bukti','keterangan'];
    
    public function getBayar($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
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

    public function getBayar_by_id($id, $column=false)
    {
        if (!$column) {
            return $this->where('id', $id)->first()[$column];
        }else {
            return $this->where('id', $id)->first;
        }
    }

    /**
     * Method untuk input data baru pada tabel bayar
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */
    public function insertBayar($data, $id=false){
        if (!$id) {
            // Generate Random id
            $idList = $this->getColumn('id');
            $isUnique = false;
            if ($idList) {
                while(!$isUnique) { 
                    $id = $this->randomGenerator(5);
                    $id = $id;
                    if(!in_array($id, $idList)){
                        $isUnique = true;
                    }
                }
            }else {
                $id = $this->randomGenerator(5);
            }
        }

        // insert
        $data['id'] = 'BYR'.$id;
        $this->insert($data);

        // check if inputed
        if( $this->where('id', 'BYR'.$id)->first() ) {
            return true;
        }else{
            return false;
        }
    }

    public function updateBayar($data, $where){
        $this->db->table($this->table)->update($data, $where);

        if ($this->where($data)->first()) {
            return true;
        }else {
            return false;
        }
    }

    public function getColumn($column){
        return $this->findColumn($column);
    }


}