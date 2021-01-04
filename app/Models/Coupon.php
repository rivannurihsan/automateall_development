<?php namespace App\Models;

use CodeIgniter\Model;

class Coupon extends Model
{
    protected $table = 'coupon';
    protected $id = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['code', 'id', 'idVital', 'isDelete', 'jumlah', 'keterangan', 'potongan', 'tglMulai', 'tglSelesai'];
    
    public function getCoupon($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
        // Where
        if (isset($data['idVital'])) {
            foreach ($data as $key => $value) {
                if ($key == 'idVital') {
                    foreach ($value as $keyChild => $valueChild) {
                        $this->where("JSON_EXTRACT(idVital, '$.".$keyChild."') = '".$valueChild."'");
                    }
                }else {
                    $this->where($key." = '".$value."'");
                }
            }
        }else {
            (!$data)?null:$this->where($data);
        };

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
            $result[0]['idVital'] = json_decode($result[0]['idVital'], true);
            return $result[0];
        }else {
            for ($i=0; $i < count($result); $i++) { 
                $result[$i]['idVital'] = json_decode($result[$i]['idVital'], true);   
            }
            return $result;
        }
    }

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

    /**
     * Method untuk input data baru pada tabel coupon
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */
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

    /**
     * Method untuk update data pada tabel 'coupon'
     * dengan data yang diinputkan
     * Jika berhasil update, akan mengembalikan true
     * 
     * @param array $data
     * @param array $where
     * @return integer|false
     */    
    public function updateCoupon($data, $where){
        $this->db->table($this->table)->update($data, $where);
        
        if($this->where($data)->first()){
            return true;
        }else{
            return false;
        }
    }

    public function coba()
    {
        $data = [
            'id' => 'tot',
            'idDaftar' => 'DAFvJMAR', 
            'keterangan' => 'pengecekan', 
            'hargaAwal' => '100000', 
            'diskon' => '100000', 
            'total' => '0', 
            'bukti' => 'Free Entry', 
            'idCoupon' => 'qwerty ',
        ];
        return $this->insert($data);
    }
}
