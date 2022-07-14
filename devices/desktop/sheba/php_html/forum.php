<?php
/*check if user is allow to edit messages*/
$isAllowedEdit = false;
$isAllowedEditDoctor=false;
if($_SESSION['User_Data']['ID']>0){
    $isAllowedEdit=true;
}
if($_SESSION['doctor_id']>0){
    $isAllowedEditDoctor=true;
}
if($message['Parent'] == 0){
                    $replay = "originalPost";
                }else{
                    $replay = "replay";
                }
                
                $messId = $message['ID'];
				if($message['doctor_id']>0){
					$messageIconImg='<img src="'.$cfg['WM']['Server'].'/webfiles/linksHeader/52/find-a-doctor.svg"/>';
					$messageIconClass='messageIconDoctor';
				}else{
					$messageIconImg='<i class="fa fa-comment-o"></i>';
					$messageIconClass='messageIcon';
				}
				?>
                <div class="messageWrap <?php echo $replay;?>">
                    <?php if(!$message['Parent'] == 0){?>
                        <div class="replayIcon"></div>
                    <?php }?>
                    <div class="<?php echo $messageIconClass?>"><?php echo $messageIconImg?></div>
                    <div class="messageHead">
                        <div id="messageSubject<?php echo $messId?>" class="messageSubject"><?php echo $message['Subject']?></div>
                        <div class="messageAuthor"><?php echo $message['Full_Name']?></div>
                    </div>
                    <div class="messageBody">
                        <div id="messageText<?php echo $messId?>" class="messageText"><?php echo $message['Value']?></div>
                        <?php 
                        if(($isAllowedEdit && $replay=='originalPost') || $isAllowedEditDoctor){?>
                            <div onclick="$('#messageSubject<?php echo $messId?>').attr('contenteditable','true');$('#messageText<?php echo $messId?>').attr('contenteditable','true').focus();$('#messageSubject<?php echo $messId?>').attr('contenteditable','true');" style="border-bottom: 1px solid;cursor: pointer;">ערוך את הנושא והתוכן של ההודעה</div>
                            <div class="updateMessage" messId="<?php echo $messId?>" id="updateMessage<?php echo $messId?>" style="cursor: pointer;">שמור שינויים!</div>
                       <?php }?>
                        
                        <div class="messageDate"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date('(H:i) d-m-Y',strtotime($message['Start_Date']))?></div>
<?php
/*                        
<div id='addMessage<?php echo $messId?>' messageId='<?php echo $message['ID']?>' class="addMessage"><?php echo $trans->getText("Replay")?></div>
*/
?>
                        <div id='addMessageForm<?php echo $messId?>' class="addMessageForm" style="display: none;">
                            <?php /*add comment to message form*/?>
                            <form name="addMessage" id="messageForm<?php echo $messId?>" class="row messageComment">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <input name="Parent" type="hidden" value="<?php echo $messId?>"/>
                                    <input name="Full_Name" placeholder="<?php echo $trans->getText("Full Name")?>" value="<?php echo $_SESSION["doctor_name"]?$_SESSION["doctor_name"]:"";?>" class="form-control" type="text"/>
                                    <input name="Subject" placeholder="<?php echo $trans->getText("Subject")?>" class="form-control" type="text"/>
                                    <input name="Email" placeholder="<?php echo $trans->getText("E-Mail")?>" class="form-control" type="text"/>
                                </div>
                                
                                <div class="col-12 col-md-6 col-lg-6">
                                    <textarea name="Value" placeholder="<?php echo $trans->getText("Description")?>" class="form-control"></textarea>
                                    <div id='captchaHolder<?php echo $messId?>'></div>
                                    <input type="button" id="<?php echo $messId?>" class="submitMessage" value="<?php echo $trans->getText("Send")?>"/>
                                    <input onclick="$('#addMessageForm<?php echo $messId?>').hide();" class="cancelMessage" type="button" value="<?php echo $trans->getText("Cancel")?>"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
