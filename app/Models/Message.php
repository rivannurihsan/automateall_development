<?php namespace App\Models;

use CodeIgniter\Model;

class Message extends Model
{
    protected $table      = 'messages';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $allowedFields = ['name', 'email', 'phone', 'message'];
 
    /**
     * Method untuk menyimpan ke tabel messages di database
     * method ini menggunakan method save() dari class Model
     * 
     * parameter $name type string
     * parameter $email type string
     * parameter $phone type string
     * parameter $message type string 
     */
    public function saveMessage($name, $email, $phone, $message)
    {
        $this->save([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
        ]);
    }
}