<?php

//error_log("Elad Integration");


require_once(dirname(__file__).'/../string/class.string.php');

/* Injection baSession! */
class EladIntegration {
    var     $config = array(
        "SystemCode"        => 1,
        "SystemPassword"    => "mobileapp4ever"
    );
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* send: perform sending of the event to elad's servers */
    function send($event="InsertEvent", $data="") {

        $string = new String();

        $data_string= $string->jsonEncodeUTF($data);
        //echo($data_string);
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
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json',
                                                    'Content-Length: ' . strlen($data_string) ) );
        $result = curl_exec($ch);

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
            "oEvent"            => array(

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
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword']
        );
        return $this->send(($isInsert)?"InsertEvent":"UpdateEvent", $data);
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
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword'],
            "Event_ID"          => $event_id,
            "ID"                => $id
        );
        return $this->send("DeleteEventShow", $data);
    }
    // --------------------------------------------------------------------------------------------------------------------------------------
    /* update_event_show: updates an event show in elad's servers */
    function update_event_show($event_data, $event_id=0, $id=0, $isInsert=false) {
        $data = array(
            "oEventShow"        => array(
                "ID"                => $id,
                "Event_ID"          => $event_id,
                "Name"              => @$event_data['Name'],
                "Content"           => @$event_data['Content'],
                "Start_Date"        => @$event_data['Start_Date'],
                "End_Date"          => @$event_data['End_Date']
            ),
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword']
        );
        if (!@$event_data['Start_Date']) unset($data["oEventShow"]["Start_Date"]);
        if (!@$event_data['End_Date']) unset($data["oEventShow"]["End_Date"]);
        return $this->send($isInsert?"InsertEventShow":"UpdateEventShow", $data);
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
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword']
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
                "Patient_ID"    => -1,
                "Email"             => $email,

            ),
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword']
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
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword']
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
                "Patient_ID"    => -1,
                "Email"             => $email,
                
            ),
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword']
        );

        return $this->send("UpdatePatientToEvent", $data);
    }

    function update_custom_fields($fieldsData) {
        $data = array(
            "Fields_Data"=>$fieldsData,
            "SystemCode"        => $this->config['SystemCode'],
            "SystemPassword"    => $this->config['SystemPassword']
        );
        return $this->send("UpdateCustomFields", $data);
    }
}
?>
