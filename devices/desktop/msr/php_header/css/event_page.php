/* Responsive Video Embed */
.video-container {
    position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px; height: 0; overflow: hidden;
}
 
.video-container iframe,
.video-container object,
.video-container embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.videoDescription{
    background-color: #1B1B1B;
    padding: 10px;
    font-size: 14px;
    color: #FFF;
    border-top: 1px solid #474747;
}

/* END Responsive Video Embed */


.eventPage .richtext{
    font-size: 18px;
    color: #222222;
    margin-bottom: 20px;
}

.eventPage{
    margin-bottom: 25px;
}

.innerImg{
    position: relative;
    max-width: 632px;
    margin: 0 auto 23px auto;
}

.videoEmbed{
    max-width: 640px;
    margin: 0 auto 23px auto;
}

.videoAndImageDescription{
    position: absolute;
    bottom: 0;
    color: #ffffff;
    font-size: 16px;
    background-color: rgba(0,0,0,0.5);
    width: 100%;
    height: 35px;
    padding: 6px 13px 0px 6px;
}

.eventPage .dateCircle{
    width: 92px;
    height: 92px;
    background-color: #34495e;
    color: #ffffff;
    margin-<?php echo $gui->getRight();?>: 20px;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
    display: inline-block;
}

.eventPage .dateCircle .dayNum{
    font-size: 32px;
    text-align: center;
    padding-top: 12px;
}

.eventPage .dateCircle .mounthText{
    font-size: 16px;
    text-align: center;
    margin-top: -5px;
}

.eventPage .eventDayTitle{
    display: inline-block;
    border-<?php echo $gui->getRight();?>: 1px solid #333333;
    margin-<?php echo $gui->getRight();?>: 10px;
    padding-<?php echo $gui->getRight();?>: 10px;
}

.eventPage .eventHourTitle{
    display: inline-block;
    border-<?php echo $gui->getRight();?>: 1px solid #333333;
    margin-<?php echo $gui->getRight();?>: 10px;
    padding-<?php echo $gui->getRight();?>: 10px;
}

.eventPage .eventPlaceTitle{
    display: inline-block;
}

.eventPage .eventHeader h1{
    margin-top: 10px;
    margin-bottom: 10px;
}

.eventPage .eventHeader{
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid #d6d6d6;
}

.eventPage .eventItemHour{
    background-color: #1abc9c;
    color: #ffffff;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    padding: 12px 0 12px 0;
    text-align: center;
}

.eventPage .eventItem{
    margin-bottom: 30px;
}

.eventPage .eventDescription{
    background-color: #f4f4f4;
    color: #333333;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    padding: 23px 20px;
    min-height: 500px;
}

.eventPage .eventDescription h3{
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid #d6d6d6;
}


.eventPage .eventItemsWrap{
    margin-bottom: 30px;
    border-bottom: 1px solid #D6D6D6;
}

.eventPage .eventDescriptionWrap{
    margin-bottom: 30px;
    padding-bottom: 10px;
    border-bottom: 1px solid #d6d6d6;
}


.eventPage .eventRegisterButton{
    display: block;
    cursor: pointer;
    max-width: 260px;
    height: 53px;
    border: 2px solid #1ABC9C;
    text-align: center;
    font-size: 18px;
    padding-top: 12px;
    color: #222;
    margin: 0 auto 30px auto;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}

.eventPage .eventRegisterButton:hover{
    background-color: #1ABC9C;
    color: #FFF;
}





/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    min-height: inherit;
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .eventPage .eventHeader{
        text-align: center;
    }
    
    .eventPage .eventItemHour{
        margin-bottom: 15px;
    }

    .eventDescription{
        margin-bottom: 15px;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}
