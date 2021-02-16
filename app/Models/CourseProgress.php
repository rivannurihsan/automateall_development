<?php namespace App\Models;

use CodeIgniter\Model;

class CourseProgress extends Model
{
    protected $table        = 'courseprogress';
    protected $primaryKey   = 'id';
    protected $returnType   = 'array';
    protected $allowedFields= ['id','idDaftar','idEpisode'];

    public function getCourseProgress($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
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
     * Method untuk input data baru pada tabel 'CourseProgress'
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */    
    public function insertCourseProgress($data){
        // check if data exist
        if($this->getCourseProgress(['idDaftar'=>$data['idDaftar'], 'idEpisode'=>$data['idEpisode']])){
            $exist = true; 
        }else {
            $exist = false;
        };
        
        if (!$exist) {
            // Generate Random id
            $idList = $this->getCourseProgress(0,'id');
            if ($idList) {
                $isUnique = false;
                while(!$isUnique) { 
                    $id = $this->randomGenerator(5);
                    $id = $id;
                    if(!in_array($id, $idList)){
                        $isUnique = true;
                    }
                }
                $data['id'] = 'CPG'.$id;
            }else {
                $data['id'] = 'CPG'.$this->randomGenerator(5);
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

    /**
     * Method untuk update data pada tabel 'CourseProgress'
     * dengan data yang diinputkan
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @param array $where
     * @return integer|false
     */    
    public function updateCourseProgress($data, $where){
        // update
        $this->db->table($this->table)->update($data, $where);

        // check if updated data excist
        if( $this->where($data)->first() ) {
            return true;
        }else{
            return false;
        }
    }
    
}