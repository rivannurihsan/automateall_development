<?php namespace App\Models;

use CodeIgniter\Model;

class CourseOnline extends Model
{
    protected $table        = 'courseonline';
    protected $primaryKey   = 'id';
    protected $returnType   = 'array';

    public function getCourseOnline($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
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

        // // Split result
        // if (count($result) == count($result, COUNT_RECURSIVE)) {
        //     foreach ($result as $key => $value) {
        //         if (preg_match('/;;/', $value)) {
        //             $result[$key] = explode(';;', $value);
        //         }
        //     }
        // }else{
        //     foreach ($result as $key => $value) {
        //         foreach ($value as $key1 => $value1) {
        //             if (preg_match('/;;/', $value1)) {
        //                 $result[$key][$key1] = explode(';;', $value1);
        //             }
        //         }
        //     }
        // }

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