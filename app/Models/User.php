<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['id', 'uniqueCode', 'nama', 'email', 'pass', 'isVerifikasi'];

    public function getUser($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
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
     * dari tabel 'user' berdasarkan 'id' yang diinputkan pada parameter
     * 
     * @param string $id
     * @param string $column
     * @return array|false
     */
    public function getUser_by_id($id, $column){
        return $this->where('id', $id)->first()[$column];
    }

    /**
     * Method untuk mengambil data sebuah kolom (sesuai input diparameter)
     * dari tabel 'user' berdasarkan 'email' yang diinputkan pada parameter
     * 
     * @param string $email 
     * @param string $column
     * @return array|false
     */    
    public function getUser_by_email($email, $column){
        return $this->where('email', $email)->first()[$column];
    }

    public function getUser_by_name($nama, $column){
        return $this->where('nama', $nama)->first()[$column];
    }

    public function getColumn($column){
        return $this->findColumn($column);
    }

    /**
     * Method untuk mengambil data email dari tabel 'user'
     * berdasarkan 'email' dan 'pass' yang diinputkan pada parameter
     * 
     * @param string $email 
     * @param string $column
     * @return array|false
     */
    public function getEmail_by_login($email, $pass){
        $data = $this->select('email')->where('email', $email)->where('pass', $pass)->first();
        if (isset($data['email'])) {
            return $data['email'];
        }
        return null;
    }

    /**
     * Method untuk mengambil data baris dari tabel 'user'
     * berdasarkan 'email' dan 'pass' yang diinputkan pada parameter
     * 
     * @param string $email 
     * @param string $column
     * @return array|false
     */    
    public function getUser_by_login($email, $pass){
        $data = $this->where('email', $email)->where('pass', $pass)->first();
        if (isset($data)) {
            return $data;
        }
        return null;
    }

    /**
     * Method untuk input data baru pada tabel 'user'
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */    
    public function insertUser($data){
        // Generate Uniqu Code
        $list = $this->getColumn('uniqueCode');
        $isUnique = false;
        while(!$isUnique) { 
            $id = $this->randomGenerator(20);
            if(!in_array($id, $list)){
                $isUnique = true;
            }
        }
        $data['uniqueCode'] = strtoupper($id);

        $id = $data['id'];
        $this->insert($data);

        // cek jika data yang diinput benar
        if ($this->getUser_by_id($id, 'id')) {
            return true;
        }else{
            return false;
        }        
    }

    /**
     * Method untuk update data pada tabel 'user'
     * dengan data yang diinputkan
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @param array $where
     * @return integer|false
     */    
    public function updateUser($data, $where){
        $this->db->table($this->table)->update($data, $where);
        
        if($this->where($data)->first()){
            return true;
        }else{
            return false;
        }
    }

}