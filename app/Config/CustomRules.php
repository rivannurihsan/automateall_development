<?php

    namespace Config;
    use \App\Controllers\BaseController;


//--------------------------------------------------------------------
    // Custom Rule Functions 
    //--------------------------------------------------------------------

    class CustomRules extends BaseController
    { 

        function __construct()
        {
            $this->User = new \App\Models\User();
        }

        public function isEmailExcist($str=null, &$error) : bool{
            $emailList = $this->User->getColumn('email');

            foreach ($emailList as $val) {
                $splitedEmail = preg_split('/@/', $val);
                $email = $this->decryption($splitedEmail[0]).'@'.$splitedEmail[1];
                if ($str == $email) {
                    return false;
                }
            }
            return true;
        }

        public function isTrue($str, $data){
            if($data) {
                return true;
            }
            return false;
        }

        public function isLogedIn($str, $error, $data){
            if ($data['emailLogin']) {
                $emailS = preg_split('/@/', $data['emailLogin']);
                $emailS = $this->encryption($emailS[0]).'@'.$emailS[1];
                $passwS = $this->encryption($str);
                print_r($emailS);
                print_r($passwS);
                
                $confirm = $this->User->getEmail_by_login($emailS, $passwS);
                if (gettype($confirm) != 'NULL') {
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }

}