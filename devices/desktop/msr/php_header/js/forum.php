$(document).ready(function(){
var Forum_Id = $('#Forum_Id').val();
   $( ".addMessage" ).live( "click", function() {/*open add message form*/
       /*first close other open forms*/
       $('.addMessageForm').hide();
       var messageId = $(this).attr('messageId');
       $('.g-recaptcha').appendTo($("#captchaHolder"+messageId));
       $("#addMessageForm"+messageId).show();
       $('.g-recaptcha').show();
   });
   $( ".submitMessage" ).live( "click", function() {/*add comment to existing message - or new message*/
      jQuery(".loader").fadeIn(100);
      var messageId = $(this).attr('id'); 
      
      jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: $('#messageForm'+messageId).serialize()+"&g-recaptcha-response="+$('#g-recaptcha-response').val()+"&Forum_Id="+Forum_Id,
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                jQuery(".loader").fadeOut(300);
                jQuery('#addMessageForm'+messageId).hide();
                jQuery('#allMessagesWrap').prepend(data);
                jQuery('.g-recaptcha').hide();
                
            }
        });
   });
   
   $( ".updateMessage" ).live( "click", function() {/*update text or subject of message*/
      jQuery(".loader").fadeIn(100);
      var messageId = $(this).attr('messId');
      jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "messageIdUpdate="+messageId+"&messageSubject="+$('#messageSubject'+messageId).text()+"&messageText="+$('#messageText'+messageId).text(),
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                jQuery(".loader").fadeOut(100);
                
            }
        });
   });
   
   
   $( "#submitSearchMessage" ).live( "click", function() {/*search message*/
      jQuery(".loader").fadeIn(100);
      jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: $('#searchMessage').serialize(),
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                jQuery('#allMessagesWrap').empty();
                jQuery('#allMessagesWrap').html(data);
                jQuery(".loader").fadeOut(300);
                
            }
        });
   });
   
   $( "#moreMessages" ).live( "click", function() {/*more messages*/
      jQuery(".loader").fadeIn(100);
      var limit = $(this).attr('limit');
      jQuery.ajax({
            type: "POST",
            url: "<?php echo $cfg["WM"]["Server"];?>/ajax/<?php echo str_replace('.php', '', $wmPage["Type"]["Page"]);?>",
            data: "limit="+limit+"&Forum_Id="+Forum_Id,
            async:"true",
            error: function () {
                /*alert('קרתה תקלה, אנא נסה/י שנית');*/
            },
            success: function(data){
                jQuery('#allMessagesWrap').append(data);
                jQuery(".loader").fadeOut(300);
                var newLimit = $('#allMessagesWrap').find('#limitDiv'+limit).html();
                var display = $('#allMessagesWrap').find('#limitDiv'+limit).attr('display');
                if(display == 'no'){
                    $( "#moreMessages" ).hide();
                }
                $( "#moreMessages" ).attr('limit',newLimit);
            }
        });
   });
   
});

