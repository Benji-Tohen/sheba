<?php

//error_log("Elad Integration");


require_once(dirname(__file__).'/../string/class.string.php');

/* Injection baSession! */
class EladIntegration {
    var $config = array(
        "SystemCode"        => 111,
        "SystemPassword"    => "1qaz@WSX",
        'auth_user' => 'RestMediaUser',
        'auth_pass' => '2WSX4rfv',
    );
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* send: perform sending of the event to elad's servers */
    function send($event="SetEvent", $data="") {

        $string = new String();

        $data_string= $string->jsonEncodeUTF($data);

       // echo($data_string);
        /*$data_string = json_encode($data);*/
        $call=ELAD_SERVICE_URL.$event;

        //$call="https://sbwnza194.sheba.gov.il/IasSy2AnyJS/Service.svc/$event";
      //echo "URL = https://eladsx.eladsoftware.com/IasSy2AnyJS/Service.svc/$event , ";
        //$call="https://sylan.sheba.gov.il/IasSy2AnyJS/Service.svc/$event";
        //echo $call." ".$data_string;

        $ch = curl_init($call);
        curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_USERPWD, $this->config['auth_user'] . ":" . $this->config['auth_pass']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            // "SystemCode: 111",
            // "SystemPassword: 1qaz@WSX",
    ]);

        $result = curl_exec($ch);

        /*Debug snippet
        if($_SERVER['HTTP_X_REAL_IP'] == '192.168.155.2' || $_SERVER['REMOTE_ADDR'] == '192.168.155.2'){
            echo($data_string);
            echo "<br>";
            echo $result;
            exit();
        }*/

        curl_close($ch);

//  echo "<!--Elad Integration: ".print_r($call,1)." -->";
//  echo "<!--Elad Integration: ".print_r($data_string,1)." -->";
    //echo "<!--Elad Integration: ".print_r($result,1)." -->";
        //echo "<br>--------------------------";
        //print_r($result);exit;
        return $result;
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* delete_event: delete an event by ID */
    function delete_event($id) {
        $data = array(
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword'],
            "ID"                => $id
        );
        return $this->send("DeleteEvent", $data);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* update_event: updates an event in elad's servers */
    function update_event($event_data, $id=0, $isInsert=false) {
        $data = array(
            "Event"            => array(
                "ID"                => $id,
                "Alias"             => @$event_data['Alias'],
                "Name"              => @$event_data['Name'],
                "Sub_Title"         => @$event_data['Sub_Title'],
                "Content"           => @$event_data['Content'],
                "Content_Center"    => @$event_data['Content_Center'],
                "Lang"              => @$event_data['Lang'],
                "Top_Header"        => @$event_data['Top_Header'],
                "UpdatedTime"       => @$event_data['UpdatedTime'],
                "Event_Currency"    => @$event_data['Event_Currency'],
                "Event_Price"       => @$event_data['Event_Price'],
                "Sheba_Yashir"      => @$event_data['Sheba_Yashir'],
                "WhenCreated"       => @$event_data['WhenCreated'],
                "WhenUpdated"       => @$event_data['WhenUpdated'],
                "IsDeleted"         => @$event_data['IsDeleted'],
                "WhenDeleted"       => @$event_data['WhenDeleted'],
                "EventType_ID"      => @$event_data['EventType_ID'],
                "EMailAddress"      => @$event_data['EMailAddress'] !='' ? @$event_data['EMailAddress'] : "EMailAddress",
                "EMailSubject"      => @$event_data['EMailSubject']!='' ? @$event_data['EMailSubject']: "EMailSubject",
                "EMailBody"         => @$event_data['EMailBody'] !='' ? @$event_data['EMailBody']: "EMailBody",
                "Event_URL"         => @$event_data['Event_URL'],

            ),
        );
        return $this->send(($isInsert)?"SetEvent":"SetEvent", $data);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* insert_event: calls update_event with id=0 */
    function insert_event($event_data) {
        return $this->update_event($event_data, $event_data["ID"], true);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* delete_event_show: delete an event show by ID */
    function delete_event_show($event_id, $id) {
        $data = array(
            "Event_ID"          => $event_id,
            "ID"                => $id
        );
        return $this->send("DeleteEventShow", $data);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* update_event_show: updates an event show in elad's servers */
    function update_event_show($event_data, $event_id='', $id=0, $isInsert=false) {
        if($event_id == 0){
            $event_id = '';
        }
        $startDate = new DateTime($event_data['Start_Date']);
        $endDate = new DateTime($event_data['End_Date']);
        $data = array(
            "EventShow"        => array(
                "ID"                => $id,
                "Event_ID"          => $event_id,
                "Name"              => @$event_data['Name'],
                "Content"           => @$event_data['Content'],
                "Start_Date"        => $startDate->format('Y-m-d'),
                "End_Date"          => $endDate->format('Y-m-d')
            ),
        );
        if (!@$event_data['Start_Date']) unset($data["oEventShow"]["Start_Date"]);
        if (!@$event_data['End_Date']) unset($data["oEventShow"]["End_Date"]);
        return $this->send($isInsert?"SetEventShow":"SetEventShow", $data);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* insert_event_show: calls update_event_show with id=0 */
    function insert_event_show($event_data, $event_id, $id) {
        return $this->update_event_show($event_data, $event_id, $id, true);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* register_patient_to_event_show: as the name states .. */
    function register_patient_to_event_show($event_data, $event_id) {
        $data = array(
            "oEventShowPatient" => array(
                "Email"             => @$event_data['Email'],
                "First_Name"        => @$event_data['First_Name'],
                "Last_Name"         => @$event_data['Last_Name'],
                "Form_Data"         => @$event_data['Form_Data'],
                /*"Event_Price"       => @$event_data['Amount'],
                "Event_Currency"    => @$event_data['Currency'],*/
                "Content_Data"      => @$event_data['Content_Data'],
                "Patient_ID"        => @$event_data['Patient_ID'],
                "Phone"             => @$event_data['Phone'],
                "Sheba_ID"          => @$event_data['Sheba_ID'],
                "MobilePhone"       => @$event_data['MobilePhone'],
                "Status"            => @$event_data['Status'],
                "RegisterGUID"      => @$event_data['RegisterGUID'],
                "Show_ID"           => $event_id,
                "EventType_ID"      => @$event_data['EventType_ID']
            ),
        );

        

        return $this->send("RegisterPatientToEventShow", $data);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* register_patient_to_event_show: as the name states .. */
    function update_patient_to_event_show($registerGUID, $status,$eventTypeID=0,$eventID=0,$email='') {
        $data = array(
            "oEventShowPatient" => array(
                "Status"            => $status,
                "RegisterGUID"      => $registerGUID,
                "EventType_ID"  => $eventTypeID,
                "Event_ID"          => $eventID,
                "Email"             => $email,

            ),
        );
        return $this->send("UpdatePatientToEventShow", $data);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* register_patient_to_event: as the name states .. */
    function register_patient_to_event($event_data, $event_id) {
        foreach ($event_data['Content_Data'] as $key => $value) {
            if ($value["Show_ID"]==NULL){
                $event_data['Content_Data'][$key]["Show_ID"]=0;
            }
        }
        $data = array(
            "oEventPatient" => array(
                "Event_ID"          => $event_id,
                "Patient_ID"        => @$event_data['Patient_ID'],
                "Sheba_ID"          => @$event_data['Sheba_ID'],
                "Email"             => @$event_data['Email'],
                "Event_Price"       => ($event_data['Event_Price']?$event_data['Event_Price']:0),
                "Event_Currency"    => @$event_data['Event_Currency'],
                "First_Name"        => @$event_data['First_Name'],
                "Last_Name"         => @$event_data['Last_Name'],
                "Content_Data"      => @$event_data['Content_Data'],
                "Phone"             => @$event_data['Phone'],
                "MobilePhone"       => @$event_data['MobilePhone'],
                "Status"            => @$event_data['Status'],
                "RegisterGUID"      => @$event_data['RegisterGUID'],
                "Form_Data"         => @$event_data['Form_Data'],
                "EventType_ID"      => @$event_data['EventType_ID'],
                "OverrideEventEmail" => @$event_data['OverrideEventEmail']
            ),
        );
        return $this->send("RegisterPatientToEvent", $data);
    }
     // --------------------------------------------------------------------------------------------------------------------------------------
    /* register_patient_to_event_show: as the name states .. */
    function update_patient_to_event($registerGUID, $status,$eventTypeID=0,$eventID=0,$email='') {
        $data = array(
            "oEventPatient" => array(
                "Status"        => $status,
                "RegisterGUID"  => $registerGUID,
                "EventType_ID"  => $eventTypeID,
                "Event_ID"          => $eventID,
                "Email"             => $email,
                
            ),
        );

        return $this->send("UpdatePatientToEvent", $data);
    }

    function update_custom_fields($fieldsData) {
        $data = array(
            "Fields_Data"=>$fieldsData,
        );
        return $this->send("UpdateCustomFields", $data);
    }
}
?>
