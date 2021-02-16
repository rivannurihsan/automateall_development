<?php namespace App\Models;

use CodeIgniter\Model;

class CourseSertifikat extends Model
{
    protected $table        = 'coursesertifikat';
    protected $primaryKey   = 'id';
    protected $returnType   = 'array';
    protected $allowedFields= ['id','token','version', 'location'];

    public function getCourseSertifikat($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
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
    public function insertCourseSertifikat($data){
        if(!isset($data['id'])){
            // Generate Random id
            $idList = $this->getCourseSertifikat(0,'id');
            if ($idList) {
                $isUnique = false;
                while(!$isUnique) { 
                    $id = $this->randomGenerator(5);
                    $id = $id;
                    if(!in_array($id, $idList)){
                        $isUnique = true;
                    }
                }
                $data['id'] = 'CST'.$id;
            }else {
                $data['id'] = 'CST'.$this->randomGenerator(5);
            }
        }

        // insert
        $this->insert($data);   

        // check if inputed
        if( $this->where('id', $data['id'])->first() ) {
            return true;
        }else{
            return false;
        }
    }

    public function rollbackInsertCourseSertifikat($where){
        $data = $this->getCourseSertifikat($where)[0];
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
    
}