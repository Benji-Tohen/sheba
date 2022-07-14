<?php

    require_once 'classes/elad/elad_integration.class.php';
    require_once 'classes/uuid/uuid.class.php';

    if(isset($_POST["contact_Submit"]) && $_POST["contact_Submit"]) {             // use $_POST or $_GET
        $Content_Data=array();
        foreach ($_POST as $fieldName => $fieldValue) {
            $rowArray=array(
                "ID"            => ++$indexon,
                "Field_Name"    => $fieldName, //$fieldName,
                "Field_Value"   => $fieldValue //$value,
            );
            array_push($Content_Data, $rowArray);
        }
        
        $mofaId = time();
        
        $elad = new EladIntegration();
        $event_data = array(
            "Email"         => $_POST['Email'],
            "First_Name"    => $_POST['First_Name'],
            "Last_Name"     => "",
            "RegisterGUID"  => "",
            "Status"        => 0,
            "Form_Data"     => "",
            "Content_Data"  => $Content_Data,
            "Patient_ID"    => -1,/*temp fix*/
            "Phone"         => $_POST['Phone'],
            "Sheba_ID"      => -1,/*temp fix*/
            "Show_ID"       => "",
			"EventType_ID" =>3
        );  
        
        // first event is sent properly - only thing that is missing is the registerGUID which is not saved..
       
        $isSent = $elad->register_patient_to_event($event_data, $wmPage["ID"]);
        $formSent=true;
        //echo "shery:".$isSent["Success"]."<br/>";

        $isSent=json_decode($isSent,true);


        }
        
/*

Array
(
    [hidden_url] => http://donation.sheba.tohendns.com/1778
    [hidden_subject] => שלח donation.sheba.tohendns.com (מחיצת טופס 03)
    [Amount] => 1
    [other_amount] => 1
    [Currency] => nis
    [Honor_Memory] => 
    [Designation] => 1
    [Title] => 1
    [Full_Name] => sheriff cherkasky
    [Email] => shery@tohen-media.com
    [Phone] => 0506666999
    [Address] => p.o.b 123
    [Billing_Address] => shery@tohen-media.com
    [Country] => ISRAEL
    [State] => ISRAEL
    [Zip_Postal_Code] => 99999
    [Comment] => 
    [submit] => 
    [hidden_Submit] => 1
)

*/
?>
<?php


    if(isset($_POST["newsletter_Submit"]) && $_POST["newsletter_Submit"]) {             // use $_POST or $_GET
        /*echo __LINE__."line:";
        print_r($_GET);
        print_r($_POST);*/

        $Content_Data=array();
        foreach ($_POST as $fieldName => $fieldValue) {
            $rowArray=array(
                "ID"            => ++$indexon,
                "Field_Name"    => $fieldName, //$fieldName,
                "Field_Value"   => $fieldValue //$value,
            );
            array_push($Content_Data, $rowArray);
        }
        
        $mofaId = time();
        
        $elad = new EladIntegration();
        $event_data = array(
            "Email"         => $_POST['Email'],
            "First_Name"    => "",
            "Last_Name"     => "",
            "RegisterGUID"  => "",
            "Status"        => 0,
            "Form_Data"     => "",
            "Content_Data"  => $Content_Data,
            "Patient_ID"    => -1,/*temp fix*/
            "Phone"         => "",
            "Sheba_ID"      => -1,/*temp fix*/
            "Show_ID"       => "",
			"EventType_ID" =>3
        );  
        
        // first event is sent properly - only thing that is missing is the registerGUID which is not saved..
       
        $isSent = $elad->register_patient_to_event($event_data, $wmPage["ID"]);
        $formSent=true;
        //echo "shery:".$isSent["Success"]."<br/>";

        $isSent=json_decode($isSent,true);
        //print_r($isSent);
        }
?>