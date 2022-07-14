<?php
// class for strong encryption / decryption
class encrypt {
    var $salt;
    var $key;
    // ----------------------------------------------------------------------------------------------------------------------------------------
    function __construct() {                                                    // class constructor
        $this->salt = strrev('cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH');
        $this->key = hash('sha512', "Y0u w0u1d h4ve 7o gu3s5 th1s realy h4rd!", true);
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    function encrypt($data) {                                                   // this function produces a base64 encoded version of $data
        $key = $this->key;
        $salt = $this->salt;
        $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
        return $encrypted;
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    function decrypt($data) {                                                   // this function decrypts the base64 encoded version of $data
        $key = $this->key;
        $salt = $this->salt;
        $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
        return $decrypted;
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    function sha256($data) {
        return hash('sha256', $data);
    }
}
?>