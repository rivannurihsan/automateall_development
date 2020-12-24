<?php namespace App\Models;

use CodeIgniter\Model;

class Daftar extends Model
{
    protected $table = 'daftar';
    protected $returnType = 'array';
    protected $allowedFields = ['id','idPendaftar','idPengajak','idAcademy','namaPengajak','whatsapp','organisasi','tglDaftar'];

    public function getDaftar_by_id_userId($id, $idPendaftar, $column = false)
    {
        $where = ['id'=>$id, 'idPendaftar'=>$idPendaftar];
        if($column) {
            return $this->where($where)->first()[$column];
        }else {
            return $this->where($where)->first();
        }
    }

    public function getDaftar_by_nama_userId($nama, $idPendaftar, $column = false){
        $where = ['nama'=>$nama, 'idPendaftar'=>$idPendaftar];
        if($column) {
            return $this->where($where)->first()[$column];
        }else {
            return $this->where($where)->first();
        }
    }

    public function countDaftar_by_pengajak_academy($idPengajak, $idAcademy){
        $where = ['idPengajak'=>$idPengajak, 'idAcademy'=>$idAcademy];
        return count($this->where($where)->findAll());
    }

    /**
     * Method untuk input data baru pada tabel daftar
     * Jika berhasil input, akan mengembalikan id input
     * 
     * @param array $data
     * @return integer|false
     */
    public function insertDaftar($data, $id=false){
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
            'id' => 'DAF'.$id
        ];
        $this->insert($data);

        // check if inputed
        if( $this->where('id', 'DAF'.$id)->first() ) {
            return true;
        }else{
            return false;
        }
    }

    public function updateDaftar($data, $where){
        // update
        $this->db->table($this->table)->update($data, $where);

        // check if updated data excist
        if( $this->where($data)->first() ) {
            return true;
        }else{
            return false;
        }
    }

    public function getColumn($column){
        return $this->findColumn($column);
    }
}