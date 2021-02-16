<?php namespace App\Models;

use CodeIgniter\Model;

class CourseEpisode extends Model
{
    protected $table        = 'courseepisode';
    protected $primaryKey   = 'id';
    protected $returnType   = 'array';

    public function getCourseEpisode($data=false, $column=false, $orderBy=false, $typeOrder=''){
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
            return $result;
        }else {
            return $result;
        }
    }
    
}