<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['id','nama', 'email', 'pass', 'isVerifikasi'];

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