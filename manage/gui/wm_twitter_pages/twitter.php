<?php
require_once('EpiCurl.php');
require_once('EpiOAuth.php');
require_once('EpiTwitter.php');
// =========================================================================================================================================
class twitter {
    var     $consumer_key;
    var     $consumer_secret;
    var     $token;
    var     $secret;
    var     $twitterObj;
    var     $twitterObjUnAuth;
    // -------------------------------------------------------------------------------------------------------------------------------------
    function twitter($consumer_key='', $consumer_secret='', $token='', $secret='') {
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->token = $token;
        $this->secret = $secret;
        $this->twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $token, $secret);
        $this->twitterObjUnAuth = new EpiTwitter($consumer_key, $consumer_secret);
    }
    // -------------------------------------------------------------------------------------------------------------------------------------
    function postTweet($status) {
        $status = $this->twitterObj->post('/statuses/update.json', array('status' => $status));
    }
}
?>
