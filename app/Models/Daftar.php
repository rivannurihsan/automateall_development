<?php namespace App\Models;

use CodeIgniter\Model;

use function PHPSTORM_META\type;

class Daftar extends Model
{
    protected $table = 'daftar';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $allowedFields = ['id','nama','idPendaftar','idPengajak','idAcademy','namaPengajak','whatsapp','organisasi','jumlahBayar','tglDaftar','maxTglBayar'];

    public function getDaftar($data=false, $column=false, $orderBy=false, $typeOrder='desc'){
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
            if ($idList) {
                $isUnique = false;
                while(!$isUnique) { 
                    $id = $this->randomGenerator(5);
                    $id = $id;
                    if(!in_array($id, $idList)){
                        $isUnique = true;
                    }
                }
            }else {
                $id = 'DAF'.$id;
            }
        }

        // Generate unique name
        $nameList = $this->getColumn('nama');
        $isUnique = false;
        if ($nameList) {
            while(!$isUnique) { 
                $nama = $this->randomGenerator(10);
                if(!in_array($nama, $nameList)){
                    $isUnique = true;
                }
            }
        }else {$nama = $this->randomGenerator(10);}

        // insert
        $data['id'] = $id;
        $data['nama'] = $nama;
        $this->insert($data);

        // check if inputed
        if( $this->where('id', $id)->first() ) {
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