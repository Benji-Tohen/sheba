.messageWrap{
    margin-bottom: 30px;
}

.messageIcon{
    padding: 18px;
    font-size: 32px;
    color: #838382;
    background-color: #ebe9e8;
    vertical-align: middle;
    display: table-cell;
    -webkit-border-top-<?php echo $gui->getLeft();?>-radius: 8px;
    -moz-border-radius-top<?php echo $gui->getLeft();?>: 8px;
    border-top-<?php echo $gui->getLeft();?>-radius: 8px;
}

.messageHead{
    padding: 18px;
    background-color: #e6e4e3;
    width: 100%;
    vertical-align: middle;
    display: table-cell;
    -webkit-border-top-<?php echo $gui->getRight();?>-radius: 8px;
    -moz-border-radius-top<?php echo $gui->getRight();?>: 8px;
    border-top-<?php echo $gui->getRight();?>-radius: 8px;
}

.messageSubject{
    font-size: 18px;
  color: #444;
}

.messageAuthor{
    font-size: 14px;
    color: #777777;
}

.messageBody{
    background-color: #f4f4f4;
    border-top: 1px solid #d5d5d5;
    padding: 16px 20px 20px 20px;
    -webkit-border-bottom-<?php echo $gui->getLeft();?>-radius: 8px;
    -webkit-border-bottom-<?php echo $gui->getRight();?>-radius: 8px;
    -moz-border-radius-bottom<?php echo $gui->getLeft();?>: 8px;
    -moz-border-radius-bottom<?php echo $gui->getRight();?>: 8px;
    border-bottom-<?php echo $gui->getLeft();?>-radius: 8px;
    border-bottom-<?php echo $gui->getRight();?>-radius: 8px;
}

.messageText{
    font-size: 14px;
    color: #444444;
    margin-bottom: 20px;
}

.messageDate{
    font-size: 14px;
    color: #999999;
    float: <?php echo $gui->getRight();?>;
}

.messageDate .fa{
    color: #34495e;
    font-size: 20px;
}

.replayIcon{
    background-image: url('<?php echo $cfg["WM"]["Server"];?>/site/images/replay.png');
    background-position: top <?php echo $gui->getLeft();?>;
    background-repeat: no-repeat;
    width: 31px;
    height: 49px;
    float: <?php echo $gui->getLeft();?>;
    margin-<?php echo $gui->getRight();?>: 20px;
}

.replay .messageBody{
    margin-<?php echo $gui->getLeft();?>: 51px;
}

.replay .messageHead{
    background-color: #34495e;
}

.replay .messageSubject{
    color: #ffffff;
}

.replay .messageAuthor{
    color: #ffffff;
}

.replay .messageIcon{
    color: #ffffff;
    background-color: #405a74;
}

.addMessage{
    display: block;
    color: #ffffff;
    background-color: #1bbc9b;
    font-size: 16px;
    text-align: center;
    padding: 10px 18px;
    cursor: pointer;
    width: 138px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.addMessage:hover{
    background-color: #30D3A8;
}

.askBtn{
    display: table-cell;
    color: #ffffff;
    background-color: #1bbc9b;
    font-size: 16px;
    text-align: center;
    padding: 10px 18px;
    cursor: pointer;
    width: 138px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.askBtn:hover{
    background-color: #30D3A8;
}

.addMessageFormHead{
    background-color: #e6e4e3;
    color: #444444;
    font-size: 22px;
    padding: 10px;
    text-align: center;
    -webkit-border-top-<?php echo $gui->getRight();?>-radius: 8px;
    -webkit-border-top-<?php echo $gui->getLeft();?>-radius: 8px;
    -moz-border-radius-top<?php echo $gui->getRight();?>: 8px;
    -moz-border-radius-top<?php echo $gui->getLeft();?>: 8px;
    border-top-<?php echo $gui->getRight();?>-radius: 8px;
    border-top-<?php echo $gui->getLeft();?>-radius: 8px;
}

.addMessageFormBody{
    background-color: #F4F4F4;
    margin: 0px;
    padding: 20px 0;
    margin-bottom: 25px;
    -webkit-border-bottom-<?php echo $gui->getLeft();?>-radius: 8px;
    -webkit-border-bottom-<?php echo $gui->getRight();?>-radius: 8px;
    -moz-border-radius-bottom<?php echo $gui->getLeft();?>: 8px;
    -moz-border-radius-bottom<?php echo $gui->getRight();?>: 8px;
    border-bottom-<?php echo $gui->getLeft();?>-radius: 8px;
    border-bottom-<?php echo $gui->getRight();?>-radius: 8px;
}

.addMessageForm .form-control{
    margin-bottom: 7px;
}

.submitMessage{
    display: block;
    color: #ffffff;
    background-color: #1bbc9b;
    font-size: 16px;
    text-align: center;
    padding: 10px 18px;
    cursor: pointer;
    width: 138px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    border: none;
    float: <?php echo $gui->getRight();?>;
}

.submitMessage:hover{
    background-color: #30D3A8;
}

.cancelMessage{
    display: block;
    color: #444444;
    background-color: #e5e5e5;
    font-size: 16px;
    text-align: center;
    padding: 10px 18px;
    cursor: pointer;
    width: 138px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    border: none;
    float: <?php echo $gui->getRight();?>;
    margin-<?php echo $gui->getRight();?>: 10px;
}

.cancelMessage:hover{
    background-color: #E25555;
    color: #ffffff;
}

textarea.form-control{
    height: 117px;
}

.searchMessageForm .forumSearchButton{
    position: absolute;
    top: 14px;
    <?php echo $gui->getRight();?>: 22px;
    font-size: 18px;
    color: #A8A8A8;
    cursor: pointer;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.searchMessageForm .forumSearchButton:hover{
    color: #34495E;
}

.forumPage h1{
    margin-bottom: 0px;
}

.forumPage h5{
    margin-bottom: 20px;
}

.forumSearchBox{
    font-size: 16px;
    height: 46px;
    border: 1px solid #cccccc;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

#searchMessage{
    width: 336px;
    position: relative;
    display: table-cell;
    padding-<?php echo $gui->getRight();?>: 10px;
}

.forumPage .lineSep{
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid #c1c1c1;
}


.messageComment{
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid #D3D3D3;
}


.loadMore{
    display: table;
    text-align: center;
    margin: 0 auto 15px auto;
    border: 2px solid #A2A1A1;
    padding: 20px 60px;
    color: #A2A1A1;
    font-size: 18px;
    cursor: pointer;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -o-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.loadMore:hover{
    background-color: #A2A1A1;
    color: #ffffff;
}


/*--------------------------  Laptops ( max 1400 ) --------------------------*/
@media (max-width:1400px){
    
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){

}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .forumPage h1{
        margin-bottom: 22px;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){

}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}