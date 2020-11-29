<?php namespace App\Models;

use CodeIgniter\Model;

class LinkConfirm extends Model
{
    protected $table      = 'linkConfirm';
    protected $primaryKey = 'token';
    protected $returnType     = 'array';
    protected $allowedFields = ['token', 'tglTerbuat', 'type'];

    /**
     * Method untuk mengambil data sebuah baris dari tabel 'linkconfirm' 
     * berdasarkan 'id' yang diinputkan di parameter. lalu mengambil
     * kolom sesuai column yang diinputkan di parameter
     * 
     * @param string $token
     * @return array|false
     */
    public function get_by_token($token){
        return $this->where('token', $token)->first();
    }
    
    /** 
     * Method untuk menghapus baris dari tabel 'linkconfirm' 
     * berdasarkan 'token' yang diinputkan di parameter
     * 
     * @param string $token
     * @return true|false
     */
    public function delete_row($token)
    {
        return $this->where('token', $token)->delete();
    }

    /**
     * Method untuk input data baru pada tabel linkConfirm
     * Jika berhasil input, akan mengembalikan true
     * 
     * @param array $data
     * @return true|false
     */      
    public function insert_row($data){
        $tkn = $data['token'];
        // input data ke tabel
        $this->insert($data);
        
        // cek jika data yang diinput benar
        if ($this->get_by_token($tkn)) {
            return true;
        }else{
            return false;
        }
    }   
}