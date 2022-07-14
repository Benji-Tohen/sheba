<?php
// miki, reference: http://www.wikihow.com/Create-a-Secure-Session-Managment-System-in-PHP-and-MySQL
require_once(dirname(__FILE__).'/../DB/class.database.php');
require_once(dirname(__FILE__).'/../../../dbaccess.php');
// ==========================================================================================================================================
class session {                                                                 // set our custom session functions.
    var $table = "wm_sessions";
    // This function will be called every time we create a new instance of an object using the 'session' class.
    // You can read up on the PHP __construct function here.
    // This function sets our custom session handler so it is available for use as soon as the class is instantiated
    // (i.e., made/built/constructed).
    function __construct() {
        session_set_save_handler(
            array($this, 'open'),
            array($this, 'close'),
            array($this, 'read'),
            array($this, 'write'),
            array($this, 'destroy'),
            array($this, 'gc')
        );
        register_shutdown_function('session_write_close');                      // This line prevents unexpected effects when using objects as save handlers.
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This function will be called every time you want to start a new session, 
    // use it instead of session_start();. See the comments in the code to see what each line does.
    function start_session($session_name, $secure) {
	
        $httponly = true;                                                       // Make sure the session cookie is not accessible via javascript.
        $session_hash = 'sha512';                                               // Hash algorithm to use for the session. (use hash_algos() to get a list of available hashes.)
        if (in_array($session_hash, hash_algos())) {				// Check if hash is available
            ini_set('session.hash_function', $session_hash);                    // Set the has function.
        }
        ini_set('session.hash_bits_per_character', 5);                          // How many bits per character of the hash. The possible values are '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ",").
        ini_set('session.use_only_cookies', 1);                                 // Force the session to only use cookies, not URL variables.
        $cookieParams = session_get_cookie_params();                            // Get session cookie parameters  
	
	//	Tomer - Trying ot bind subdomains
	//$cookieParams["path"]="/";
	//$cookieParams["domain"]=".sheba.tohendns.com";
	//	end of subdomains experiment
        if($_SERVER["HTTP_HOST"]=="www.msr.org.il" || $_SERVER["HTTP_HOST"]=="eng.msr.org.il"){
            $cookieParams["domain"]=$_SERVER["HTTP_HOST"];
        }

        session_set_cookie_params(                                              // Set the parameters
            $cookieParams["lifetime"],
            $cookieParams["path"],
            $cookieParams["domain"],
            $secure,
            $httponly
        );

        session_name($session_name);                                            // Change the session name 

        session_start();                                                        // Now we cat start the session
        //session_regenerate_id(true);                                          // This line regenerates the session and delete the old one. 
                                                                                // It also generates a new encryption key in the database. 
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This is a security function for validating user input
    function validate_key($id) {
        if (preg_match('/[^a-z0-9]+/', $id)) die("invalid session key entered");
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This is a security function for validating user input
    function validate_cross_site_scripting($data) {
        if (stripos($data,"<script")!==false) die("invalid input");
        if (stripos($data,"<iframe")!==false) die("invalid input");
        if (stripos($data,"<input")!==false) die("invalid input");
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This function will be called by the PHP sessions when we start a new session, we use it to start a new database connection.
    function open() {
        global $cfg;
        $this->db = new DB($cfg["WM"]["DBServer"], $cfg["WM"]["DBName"], $cfg["WM"]["DBUser_Name"], $cfg["WM"]["DBPassword"]);
        return true;
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This function will be called when the sessions want to be closed.
    function close() {
        $this->db->disconnect();
        return true;
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This function will be called by PHP when we try to access a session for example when we use echo $_SESSION['something'];.
    // Because there might be many calls to this function on a single page, we take advantage of prepared statements, not only
    // for security but for performance also. We only prepare the statement once then we can execute it many times.
    // We also decrypt the session data that is encrypted in the database. We are using 256-bit AES encryption in our sessions.
    function read($id) {
        $this->validate_key($id);
        $arr = $this->db->getArray("SELECT data FROM {$this->table} WHERE id = '$id' LIMIT 1");
        $key = $this->getkey($id);
        $data = $this->decrypt(@$arr[0]['data'], $key);
        //$this->validate_cross_site_scripting($data);
        return $data;
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This function is used when we assign a value to a session, for example $_SESSION['something'] = 'something else';.
    // The function encrypts all the data which gets inserted into the database.
    function write($id, $data) {
        $this->validate_key($id);
        //$this->validate_cross_site_scripting($data);
        $key = $this->getkey($id);                                              // Get unique key
        $data = $this->encrypt($data, $key);                                    // Encrypt the data
        $time = time();
        $this->db->runQuery("REPLACE INTO {$this->table} (id, set_time, data, session_key) VALUES ('$id', '$time', '$data', '$key')");
        return true;
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This function deletes the session from the database, it is used by php when we call functions like session__destroy();.
    function destroy($id) {
        $this->validate_key($id);
        $this->db->runQuery("DELETE FROM {$this->table} WHERE id = '$id'");
        return true;
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This function is the garbage collector function it is called to delete old sessions.
    // The frequency in which this function is called is determined by two configuration directives,
    // session.gc_probability and session.gc_divisor.
    function gc($max) {
        $old = time() - $max;
        $this->db->runQuery("DELETE FROM {$this->table} WHERE set_time < $old");
        return true;
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // This function is used to get the unique key for encryption from the sessions table. If there is no session it
    // just returns a new random key for encryption.
    private function getkey($id) {
        $this->validate_key($id);
        $arr = $this->db->getArray("SELECT session_key FROM {$this->table} WHERE id = '$id' LIMIT 1");
        if(count($arr) == 1) {
            return $arr[0]['session_key'];
        } else {
            $random_key = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            return $random_key;
        }
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    // These functions encrypt the data of the sessions, they use an encryption key from the database
    // which is different for each session. We don't directly use that key in the encryption but we use it to
    // make the key hash even more random.
    private function encrypt($data, $key) {
       $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
       $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
       $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
       $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $data, MCRYPT_MODE_ECB, $iv));
       return $encrypted ;
    }
    
    private function decrypt($data, $key) {
       $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
       $key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
       $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
       $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($data), MCRYPT_MODE_ECB, $iv);
       return $decrypted ;
    }

}

?>