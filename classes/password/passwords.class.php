<?php
require_once(dirname(__FILE__).'/../encrypt/encrypt.class.php');
// class for all password security checks
class passwords {
    var $db;                                                                    // holds database connection
    var $table;                                                                 // holds table name
    var $users;                                                                 // holds the name of users table
    var $old_passwords;                                                         // holds old passwords
    // ---------------------------------------------------------------------------------------------------------------------------------------
    function __construct($db, $table="wm_passwords_history", $users="wm_users") {  // class constructor
        $this->db = $db;
        $this->users = $users;
        $this->table = $table;
        $this->old_passwords = array("index"=>array(),"list"=>array());
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    function is_password_strong($password) {                                    // check if password is "strong" enough
        $count = 0;
        $matches = array();
        $regs = array("/[0-9]+/", "/[a-z]+/", "/[A-Z]+/");
        foreach ($regs as $n=>$reg) preg_match($reg, $password, $matches[$n]);
        foreach ($matches as $n=>$arr) if (count($arr)>=1) $count++;
        return ($count<3) ? false : true;
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    function load_old_passwords($user_id=0) {                                   // load old passwords to temporary memory
        if (!$user_id) return;
        $arr = $this->db->getArray("SELECT * FROM {$this->table} WHERE wm_users_id=$user_id");
        if ($arr) {
            $ec = new encrypt();
            foreach ($arr as $n=>$array) {
                $password = $ec->decrypt($array['password']);
                $this->old_passwords["index"][$password] = 1;
                $this->old_passwords["list"][] = $password;
            }
        }
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    function is_old_password($password, $user_id) {                             // check if its an old password
        if (!count($this->old_passwords["list"])) {
            $this->load_old_passwords($user_id);                                // load old passwords
        }
        if (!count($this->old_passwords["list"])) return false;                 // if no old passwords exist, return false (its not old)
        else return (@$this->old_passwords["index"][$password]);                // if old passwords exist, returns true if password idx exists
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    /** @return an array of adjacent letter pairs contained in the input string */
    function letterPairs($str) {
        $pairs = array();
        $numPairs = strlen($str)-1;
        for ($i=0; $i<$numPairs; $i++) {
            $pairs[] = substr($str,$i,2);
        }
        return $pairs;
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    /** @return an ArrayList of 2-character Strings. */
    function wordLetterPairs($str) {
        $allPairs = array();
        // Tokenize the string and put the tokens/words into an array
        $words = explode(" ",$str);
        // For each word
        for ($w=0; $w < count($words); $w++) {
            // Find the pairs of characters
            $pairsInWord = $this->letterPairs($words[$w]);
            for ($p=0; $p<count($pairsInWord); $p++) {
                $allPairs[] = $pairsInWord[$p];
            }
        }
        return $allPairs;
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    // the following function is based on http://www.catalysoft.com/articles/StrikeAMatch.html
    function similarity($s1, $s2) {                                             // similarity result between two strings
       $pairs1 = $this->wordLetterPairs(strtoupper($s1));
       $pairs2 = $this->wordLetterPairs(strtoupper($s2));
       $intersection = 0;
       $union = count($pairs1) + count($pairs2);
       for ($i=0; $i<count($pairs1); $i++) {
           $pair1 = $pairs1[$i];
           for($j=0; $j<count($pairs2); $j++) {
               $pair2 = $pairs2[$j];
               if ($pair1==$pair2) {
                   $intersection++;
                   array_splice($pairs2, $j, 1);                                // remove the found element
                   break;
               }
           }
       }
       return (2.0*$intersection)/$union;
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    function similar_password($password) {                                      // check if password is similar
        foreach ($this->old_passwords["list"] as $n=>$p) {
            if ($this->similarity($p,$password)>0.8) return $p;                 // if similarity is found (80% similarity), return the string
        }
        return false;
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    function is_existing_password($password, $user_id=0) {                      // check if its our existing password
        if (!$_SESSION["User_Data"]["Password"]) {
            $arr = $this->db->getRow("SELECT * FROM {$this->users} WHERE ID=$user_id");
            $old_password = $arr["Password"];
        } else $old_password = $_SESSION["User_Data"]["Password"];
        $ec = new encrypt();
        return ($ec->sha256($password)==$old_password);                         // will return true if sha256 of passwords match
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    function change_password($old_password, $new_password, $user_id=0) {        // perform a new password change
        if (!$user_id) return;
        $ec = new encrypt();
        $now_time = time();
        $new_password_sha256 = $ec->sha256($new_password);
        $old_password_encrypt = $ec->encrypt($old_password);
        $this->db->runQuery("UPDATE {$this->users} SET Password='{$new_password_sha256}',password_time=$now_time WHERE ID=$user_id");
        $this->db->updateData(
                $this->table,
                array(
                    "wm_users_id"   => $user_id,
                    "password"      => $old_password_encrypt,
                    "date_changed"  => $now_time
                )
        );
        unset($_SESSION["User_Data"]["replace_password"]);                      // unset the session variable to allow access to site
    }
    // ---------------------------------------------------------------------------------------------------------------------------------------
    function new_password_check($password, $user_id=0) {                        // perform a test for a new password that is inserted
        $user_id = intval($user_id);
        if (strlen($password)<6) return "אורך הסיסמא החדשה חייב להיות 6 תווים לפחות";
        if (!$this->is_password_strong($password)) return "על הסיסמא החדשה להכיל ספרה אחת, אות אנגלית גדולה אחת ואות אנגלית קטנה אחת לפחות";
        if ($this->is_old_password($password, $user_id)) return "השתמשת בעבר בסיסמא זו, אנא בחר סיסמא חדשה";
        if ($similar = $this->similar_password($password)) return "סיסמא זו דומה לסיסמא שהשתמשת בה בעבר (".$similar.") אנא בחר סיסמא חדשה";
        return "";
    }
}

?>
