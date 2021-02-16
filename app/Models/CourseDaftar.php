<?php namespace App\Models;

use CodeIgniter\Model;

class CourseDaftar extends Model
{
    protected $table        = 'coursedaftar';
    protected $primaryKey   = 'id';
    protected $returnType   = 'array';
    protected $allowedFields= ['id','idCourse','idUser','idSertifikat','uniqueCode','tglDaftar','maxTglBayar','jumlahBayar','rating','ulasan'];

    public function getCourseDaftar($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
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
     * Method untuk input data baru pada tabel 'CourseDaftar'
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */    
    public function insertCourseDaftar($data){
        // check if data exist
        if($this->getCourseDaftar(['idCourse'=>$data['idCourse'], 'idUser'=>$data['idUser']])){
           $exist = true; 
        }else {
            $exist = false;
        };

        if (!$exist) {
            // Generate Random id
            $idList = $this->getCourseDaftar(0,'id');
            if ($idList) {
                $isUnique = false;
                while(!$isUnique) { 
                    $id = $this->randomGenerator(5);
                    $id = $id;
                    if(!in_array($id, $idList)){
                        $isUnique = true;
                    }
                }
                $data['id'] = 'CDF'.$id;
            }else {
                $data['id'] = 'CDF'.$this->randomGenerator(5);
            }
            print_r($data);

            // Generate Unique Code
            $list = $this->getCourseDaftar(0,'uniqueCode');
            $isUnique = false;
            if ($list) {
                while(!$isUnique) { 
                    $id = strtoupper($this->randomGenerator(10));
                    if(!in_array($id, $list)){
                        $isUnique = true;
                    }
                }
                $data['uniqueCode'] = $id;
            }else {
                $data['uniqueCode'] = strtoupper($this->randomGenerator(10));
            }

            // insert
            $this->insert($data);   

            // check if inputed
            if( $this->where('id', $data['id'])->first() ) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function rollbackInsertCourseDaftar($where){
        $data = $this->getCourseDaftar($where)[0];
        $dateNow = date('Y-m-d H:i:s');
        $dateAgo = date('Y-m-d H:i:s', strtotime($dateNow.' - 30 minutes'));

        // cek jika data baru saja diinput 
        if ($data) {
            if ($dateAgo <= $data['createDate'] && $data['createDate'] <= $dateNow ) {
                // delete row
                $this->delete($where);
                return true;
            }
        }
        return false;
    }

    
    /**
     * Method untuk update data pada tabel 'CourseDaftar'
     * dengan data yang diinputkan
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @param array $where
     * @return integer|false
     */    
    public function updateCourseDaftar($data, $where){
        // update
        $this->db->table($this->table)->update($data, $where);

        // check if updated data excist
        if( $this->where($data)->first() ) {
            return true;
        }else{
            return false;
        }
    }

    public function rollbackUpdateCourseDaftar($id, $currData){
        $data = $this->getCourseDaftar(['id'=>$id]);
        $dateNow = date('Y-m-d H:i:s');
        $dateAgo = date('Y-m-d H:i:s', strtotime($dateNow.' - 30 minutes'));

        // cek jika data baru saja diinput 
        if ($data) {
            if ($dateAgo <= $data['lastUpdate'] && $data['lastUpdate'] <= $dateNow ) {
                // delete row
                $this->db->table($this->table)->update($currData, ['id'=>$id]);
                return true;
            }
        }
        return false;
    }
    
}