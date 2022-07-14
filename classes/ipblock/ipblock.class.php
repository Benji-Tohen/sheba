<?php
// class for handling and maintaining IP blocks
class ipblock {
    var $db;                                                                    // reference to db object
    var $cfg;                                                                   // reference to cfg object
    var $table;
    var $users;                                                                 // holds the wm_users table
    var $block_time;                                                            // time (in seconds) to keep block active (30 minutes..)
    var $block_page;                                                            // a specific page for showing that access has been blocked
    var $maximum_attempts;                                                      // maximum attempts before blocking
    // ----------------------------------------------------------------------------------------------------------------------------------------
    // class constructor
    function __construct($db, $cfg, $table="wm_blocked_ips", $users="wm_users", $block_time=1800, $maximum_attempts=5, $block_page="") {
        $this->db = $db;
        $this->cfg = $cfg;
        $this->table = $table;
        $this->users = $users;
        $this->block_time = $block_time;
        $this->block_page = $block_page;
        $this->maximum_attempts = $maximum_attempts;
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    // This function checks if an IP address trying to access the system is allowed or blocked
    function is_ip_allowed() {                                                  
        $ip = $_SERVER['REMOTE_ADDR'];
        if($ip != '192.168.151.1'){/*this ip adress is always allowed - 192.168.151.1*/
            $arr = $this->db->getArray("SELECT * FROM {$this->table} WHERE ip_address='$ip'");
            if ($arr) {                                                             // <-- if IP is found in the table ..
                if ($arr[0]['is_blocked']) {                                        // <-- if IP is blocked ..
                    $time = time();
                    if ($time - $arr[0]['block_time'] >= $this->block_time) {       // check if block time has passed ..
                        $this->remove_ip_block();                                   // if it was - remove the block and allow access
                        return true;
                    } else return false;                                            // if not - keep blocked (deny access)
                }
            }
        }
        return true;                                                            // if IP is not in DB, or IP is not blocked - allow access
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    // This function adds a block to an IP address to the block list table, and alerts the moderators who have email set
    function block_ip($reason="Excessive login attempts") {
        $time = time();
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->db->runQuery("REPLACE INTO {$this->table} (ip_address, attempts, is_blocked, block_time) VALUES ('$ip', 0, 1, $time)");
        $this->alert_moderators($reason);                                       // send mail to moderators
        $this->show_block_page();
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    // This function removes a block on an IP address from the block list table
    function remove_ip_block() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->db->runQuery("DELETE FROM {$this->table} WHERE ip_address='$ip'");
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    // This function is fired when a "suspicious" action like an attempt to enter bad password is entered, it raises # of attempts before block
    function trigger_suspicious_action() {
        $time = time();
        $ip = $_SERVER['REMOTE_ADDR'];
        $arr = $this->db->getArray("SELECT * FROM {$this->table} WHERE ip_address='$ip'");
        if ($arr) {                                                             // if IP is found in block table ..
            $attempts = $arr[0]['attempts'] + 1;
            if ($attempts >= $this->maximum_attempts) $this->block_ip();        // if attempts > maximum attempts, block our IP
            else {                                                              // if not .. update our data and raise number of attempts ..
                $this->db->updateData($this->table,array("ip_address"=>$ip,"attempts"=>$attempts),$ip,"ip_address",true);
            }
        } else {                                                                // if IP is not found in block table .. add it with attempts=1
            $this->db->updateData($this->table,array("ip_address"=>$ip,"attempts"=>1));
        }
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    // This function is used to show the block page, or throw a die() if no page is defined
    function show_block_page() {
        if ($this->block_page) {
            header("Location: {$this->block_page}");
            exit;
        } else die("Access has been denied, IP address is blocked");
    }
    // ----------------------------------------------------------------------------------------------------------------------------------------
    // This function sends mail to the system moderators who have mail enabled
    function alert_moderators($reason) {
        require_once(dirname(__FILE__)."/../phpmailer/class.send_mail.php");
        require_once(dirname(__FILE__).'/../phpmailer/sendmail.php');
        require_once(dirname(__FILE__).'/../encrypt/encrypt.class.php');
        $moderators = $this->db->getArray("SELECT * FROM {$this->users} WHERE level=1 AND length(mail)>0");
        if ($moderators) {
            foreach ($moderators as $n=>$moderator) {
                $ec = new encrypt();
                $to = $ec->decrypt($moderator['mail']);
                $from = "ipblock@sheba.co.il";
                $subject = "IP access block";
                $body = "Access for IP address {$_SERVER['REMOTE_ADDR']} has been blocked due to: $reason";
                sendSingleMail($subject, $body, $to, $from);
            }
        }

    }
}
?>