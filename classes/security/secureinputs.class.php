<?php
// this class deals with securing and validating user input, to prevent from malicious code being entered
class secure_inputs {
    // -----------------------------------------------------------------------------------------------------------------------------------------
    /*
        $inputs=array(
            array("string255"=>$_POST["Name"]),
            array("string1000"=>$_POST["Value"])
        );
     */   
    function isNotSecure($inputs) {                                             // this function runs security checks on the given inputs
        foreach ($inputs as $n=>$array) {
            $operation = array_pop(array_keys($array));                         // "string255" , "string1000" , "email" , etc.
            $member = $array[$operation];                                       // extract the reference from the array directly
            if (!strlen($member)) continue;                                     // no need to check empty strings
            switch ($operation) {
                case "string10":    $ret = $this->isString($member,10);     break;
                case "string255":   $ret = $this->isString($member,255);    break;
                case "string1000":  $ret = $this->isString($member,1000);   break;
                case "text":        $ret = $this->isString($member,65500);  break;
                case "email":       $ret = $this->isEmail($member);         break;
                case "url":         $ret = $this->isURL($member);           break;
                case "number":      $ret = $this->isNumber($member);        break;
            }
            if ($ret) return $ret;
        }
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------
    function isMalicious($string) {
        if (stripos($string, 'www.youtube.com/embed')!==false) return false;
        if (stripos($string, 'www.sheba.co.il/')!==false) return false;
        if (stripos($string,"<script")!==false) return true;
        if (stripos($string,"<iframe")!==false) return true;
        if (stripos($string,"eval(")!==false) return true;
        return false;
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------
    function isString($string, $length) {                                       // since string is reference, value can be modified too if need
        if (mb_strlen($string,"UTF-8")>$length) return "Saving error: String is more than $length chars: \\n".$string;
        if ($this->isMalicious($string)) return "Malicious code entered";        
        return false;
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------
    function isEmail($string) {
        if (!filter_var($string, FILTER_VALIDATE_EMAIL)) return "Invalid email format: ".$string; 
        return false;
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------
    function isURL($string) {
        $tempString=$string;
        $tempString=preg_replace("/\p{Hebrew}/u",'a',$tempString);
        if (stripos($string,"tel") !== false) return false;
        if (!filter_var($tempString, FILTER_VALIDATE_URL)) return "Invalid URL format: ".$string; 
        return false;
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------
    function isNumber($string) {
        if (filter_var($string, FILTER_VALIDATE_INT)!==0) {
            if (!filter_var($string, FILTER_VALIDATE_FLOAT)) return "Invalid number format: ".$string; 
        }
        return false;
    }
    // -----------------------------------------------------------------------------------------------------------------------------------------
}
?>
