<?php
    $arrLinksDivisions=$wm->getLinksDivisions();
    $arrLinksDonationType=$wm->getLinksDonationType();
    $arrLinksAmount=$wm->getLinksAmount();

    if (isset($_POST)  && $_POST)  {
        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/elad/elad_integration.class.php';
        require_once $_SERVER['DOCUMENT_ROOT'].'/classes/uuid/uuid.class.php';
            if(isset($_POST['sum']) && !is_numeric($_POST['sum'])){
                $_POST['sum'] = $_POST['other_amount_input'];
            }
    
            // --- send data to elad upon initial send ..
            $uuid = UUID::v4();                                                     // create registerGUID
    
            $Content_Data=array();
            foreach ($_POST as $fieldName => $fieldValue) {
                $rowArray=array(
                    "ID"            => ++$indexon,
                    "Field_Name"    => $fieldName, //$fieldName,
                    "Field_Value"   => $fieldValue //$value,
                );
                array_push($Content_Data, $rowArray);
            }
    
            $mofaId = $_POST['page_id'];
            /*tmp fix for elad debug*/
            //$mofaId=rand(1000,1000000);
    
            $formData=array(
                "division" => (isset($_POST['other_division_input'])?$_POST['other_division_input']:$_POST['division'])
            );
    
            $formData=$string->jsonEncodeUTF($formData);
    
            $elad = new EladIntegration();
            $event_data = array(
                "Email"         => $_POST['email'],
                "First_Name"    => $_POST['contact'],
                "Last_Name"     => $_POST['contact'],
                "Event_Price"   => $_POST['sum'],
                "Event_Currency"=> $_POST['currency'],
                "donationType"=> $_POST['donationType'],
                "Honor_Memory"=> $_POST['Honor_Memory'],
                "division"=> $_POST['division'],
                "other_division"=> $_POST['other_division_input'],
                "receipt"=> $_POST['receipt'],
                "comments"=> $_POST['comments'],
                "RegisterGUID"  => $uuid,
                "Status"        => 0,
                "Form_Data"     => $formData,
                "Content_Data"  => $Content_Data,
                "Patient_ID"    => -1,/*temp fix*/
                "Phone"         => $_POST['phone'],
                "Sheba_ID"      => -1,/*temp fix*/
                "Show_ID"       => intval($mofaId),
                "EventType_ID"  =>3
            );
            
            $isSent = $elad->register_patient_to_event($event_data, $mofaId);
            $formSent=true;
            $isSent=json_decode($isSent,true);
        }
    if (isset($_POST["ConfirmationCode"])  && $_POST["ConfirmationCode"]!="0000000")  {
        $RegisterGUID =  $uuid;
        $Status=1;
        $isSent = $elad->update_patient_to_event($RegisterGUID, $Status,3,$mofaId,$_POST['email']);
        $formSent=true;
    }
?>
