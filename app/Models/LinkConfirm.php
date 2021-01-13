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
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */
    public function insertLinkConfirm($data){
        // insert
        $this->insert($data);

        // check if inputed
        if( $this->where('token', $data['token'])->first() ) {
            return true;
        }else{
            return false;
        }
    }
    
}