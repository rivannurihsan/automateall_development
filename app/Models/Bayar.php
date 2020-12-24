<?php namespace App\Models;

use CodeIgniter\Model;

class Bayar extends Model
{
    protected $table = 'bayar';
    protected $returnType = 'array';
    protected $allowedFields = ['id','idDaftar','idCoupon','metode','tglBayar','jumlah','bukti','maxTglBayar'];

    public function getBayar_by_id($id, $column=false)
    {
        if (!$column) {
            return $this->where('id', $id)->first()[$column];
        }else {
            return $this->where('id', $id)->first;
        }
    }

    /**
     * Method untuk input data baru pada tabel bayar
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */
    public function insertBayar($data, $id=false){
        if (!$id) {
            // Generate Random id
            $idList = $this->getColumn('id');
            $isUnique = false;
            while(!$isUnique) { 
                $id = $this->randomGenerator(5);
                $id = $id;
                if(!in_array($id, $idList)){
                    $isUnique = true;
                }
            }             
        }

        // insert
        $data = [
            'id' => 'BYR'.$id
        ];
        $this->insert($data);

        // check if inputed
        if( $this->where('id', 'BYR'.$id)->first() ) {
            return true;
        }else{
            return false;
        }
    }

    public function updateBayar($data, $where){
        $this->db->table($this->table)->update($data, $where);

        if ($this->where($data)->first()) {
            return true;
        }else {
            return false;
        }
    }

    public function getColumn($column){
        return $this->findColumn($column);
    }


}