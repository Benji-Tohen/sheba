<?php
    // error_reporting(E_ALL);
    // ini_set("display_errors", 1);
    
    require_once $_SERVER['DOCUMENT_ROOT'].'/classes/elad/elad_integration.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/classes/uuid/uuid.class.php';
    if(isset($_POST["hidden_Submit"]) && $_POST["hidden_Submit"]) {
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
            "EventType_ID"  =>3,
            "notify_url_address" => $cfg["WM"]["Server"]."/notify_tranzila"
        );
        
        //$isSent = $elad->register_patient_to_event($event_data, $mofaId);

        $formSent=true;
        $isSent=json_decode($isSent,true);


        if(true){
            // MAKE SURE israelkasirer1
            $tranzilla_url = "https://direct.tranzila.com/israelkatest/iframe.php";  // israelkasirer1
            $tranzilla_url_test = "https://direct.tranzila.com/israelkatest/iframe.php";  // israelkasirer1
            // 12312312 / exp in future / cvv = 123 , id = 123456789 , sum = no more than 10 shekels
            $params = array();
            $params[] = "currency=".$_POST["currency"];
            $params[] = "pdesc=Donation";
            if ($_POST['sum']) {
                $amount = floatval($_POST['sum']);
                if ($_POST['other_amount']) $amount = floatval($_POST['other_amount']);
                $params[] = "sum=$amount";
            }else{
                $amount = floatval(50);
                $params[] = "sum=$amount";
            }
            if ($_POST['contact']) $params[] = "contact=".$_POST['contact'];
            if ($_POST['email']) $params[] = "email=".$_POST['email'];
            if ($_POST['phone']) $params[] = "phone=".$_POST['phone'];
            if ($_POST['address']) $params[] = "address=".$_POST['address'];
            if ($_POST['remarks']) $params[] = "remarks=Country:".$_POST['remarks'];
            if ($_POST['city']) $params[] = "city=".$_POST['city'];
            if ($_POST['donationType']) $params[] = "donationType=".$_POST['donationType'];
            if ($_POST['Honor_Memory']) $params[] = "Honor_Memory=".$_POST['Honor_Memory'];
            if ($_POST['division']) $params[] = "division=".$_POST['division'];
            if ($_POST['other_division_input']) $params[] = "other_division_input=".$_POST['other_division_input'];
            if ($_POST['receipt']) $params[] = "receipt=".$_POST['receipt'];
            if ($_POST['comments']) $params[] = "comments=".$_POST['comments'];
            if ($_POST['lang']) $params[] = "lang=".$_POST['lang'];
            if ($_POST['currency']) $params[] = "currency=".$_POST['currency'];


            $params[] = "uuid=".$uuid;                                              // add GUID to tranzila call
            $params[] = "mofaid=".$mofaId;

            foreach ($params as $key => $value) {
                    $params[$key]=$string->htmlentities($value);
                }

            if (strpos($_SERVER['SERVER_NAME'],"donationhe")!==false) $params[] = "lang=il";
            if ($params) $tranzilla_url .= "?".implode("&",$params);
                    $tranzila_api_host = 'secure5.tranzila.com';
            $tranzila_api_path = '/cgi-bin/tranzila71dt.cgi';
            
            // Prepare transaction parameters
            $query_parameters['supplier'] = 'israelkasirer';// 'TERMINAL_NAME' should be replaced by actual terminal name
            $query_parameters['sum'] =  intval($amount); //Transaction sum
            $query_parameters['currency'] = $_POST["currency"]; //Type of currency 1 NIS, 2 USD, 978 EUR, 826 GBP, 392 JPY
            $query_parameters['TranzilaPW'] = 'LvfH4fC'; // Token password if required
            $query_parameters['op'] = '1'; //Required for handshake
            // Prepare query string
            $query_string = '';
            foreach ($query_parameters as $name => $value) {
                $query_string .=($name . '=' . $value . '&');
            }
            
            $query_string = substr($query_string, 0, -1); // Remove trailing '&'
            
            // Initiate CURL
            $cr = curl_init();
            
            curl_setopt($cr, CURLOPT_URL, "https://$tranzila_api_host$tranzila_api_path");
            curl_setopt($cr, CURLOPT_POST, 1);
            curl_setopt($cr, CURLOPT_FAILONERROR, true);
            curl_setopt($cr, CURLOPT_POSTFIELDS, $query_string);
            curl_setopt($cr, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($cr, CURLOPT_SSL_VERIFYPEER, 0);
            // Execute request
            $result = curl_exec($cr);
            $error = curl_error($cr);
            
            if (!empty($error)) {
                die ($error);
            }
            curl_close($cr);

            // Return handshake token (thtk)
            echo str_replace('thtk=', '', $result);
            exit;
        }
    } else if (isset($_POST["ConfirmationCode"])) {
        // update the elad event ..
        $uuid = $_POST['uuid'];
        $mofaId = $_POST['mofaid'];
        if($_POST["ConfirmationCode"]=="0000000")
            $Status=0;
        else
            $Status=1;
        $RegisterGUID =  $uuid;
        $elad = new EladIntegration();
        $isSent = $elad->update_patient_to_event($RegisterGUID, $Status,3,$mofaId,$_POST['email']);
        $formSent=true;
    }

    exit;
?>