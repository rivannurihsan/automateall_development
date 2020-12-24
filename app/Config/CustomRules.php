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
                $email = $splitedEmail[0].'@'.$splitedEmail[1];
                if ($str == $email) {
                    return false;
                }
            }
            return true;
        }

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function isCouponExcist($str, &$error){
            $couponCodeList = $this->Coupon->getCoupon_by_code($str);

            if ($couponCodeList) {
                return false;
            }
            return true;
        }
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        public function isLogedIn($str, $error, $data){
            if ($data['Email']) {
                $emailS = preg_split('/@/', $data['Email']);
                $emailS = $emailS[0].'@'.$emailS[1];
                $passwS = $str;
                
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