<?php namespace App\Models;

use CodeIgniter\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    protected $id = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['code', 'id', 'idVital', 'isDelete', 'jumlah', 'keterangan', 'potongan', 'tglMulai', 'tglSelesai'];

    public function getCoupon_by_id($id, $column=false){
        if ($column) {
            return $this->where('id', $id)->first()[$column];
        }else {
            return $this->where('id', $id)->first();
        }
    }

    public function getCoupon_by_code($code, $column=false)
    {
        if ($column) {
            return $this->where('code', $code)->first()[$column];
        }else {
            return $this->where('code', $code)->first();
        }
    }

    public function getCoupon_idVital($columnName)
    {
        return $this->query("SELECT JSON_EXTRACT((SELECT idVital FROM coupon), '$.".$columnName."') as ".$columnName.";")->getRowArray()[$columnName];
    }

    public function insertCoupon($data){
        // Generate random id
        $idList = $this->findColumn('id');
        $isUnique = false;
        while(!$isUnique){
            $id = $this->randomGenerator(5);
            $id = $id;
            if (!in_array($id, $idList)) {
                $isUnique = true;
            }
        }

        $data['id'] = 'CPN'.$id;
        $this->insert($data);

        if($this->where('id', 'CPN'.$id)->first()){
            return true;
        }else {
            return false;
        }
    }

}
