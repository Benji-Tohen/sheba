.eventsPage .eventsItemsRow{
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid #ececec;
}

.eventsPage .richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #ececec;
}

.eventsPage .eventsItemsRow .item a{
    display: block;
    position: relative;
}

.eventsPage a h4{
    margin-bottom: 10px;
}

.eventsPage a h4, .eventsPage a:hover, .eventsPage a:visited{
    text-decoration: none;
    color: #222222;
}

.eventsPage a h6{
    color: #222;
}

h6.itemDate{
    margin-bottom: 10px;
    color: #999999;
}

div.itemDate {
    margin-bottom: 10px;
    color: #222;
    font-size: 14px;
}

.eventsPage .showMoreButton{
    display: block;
    max-width: 260px;
    height: 53px;
    border: 2px solid #1abc9c;
    text-align: center;
    font-size: 18px;
    padding-top: 12px;
    color: #222222;
    margin: 0 auto 30px auto;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}

.eventsPage .showMoreButton:hover{
    background-color: #1abc9c;
    color: #ffffff;
}

.eventsPage .item img{
    margin-bottom: 14px;
}

.eventsPage .item{
    margin-bottom: 30px;
}

.titleLine{
    background-color: #1abc9c;
    height: 2px;
    width: 100%;
}

h1{
    text-align: center;
    margin-top: -20px;
}

.previousEvent, .nextEvent{
    background-color: #17a78b;
    padding: 14px 16px;
    font-size: 14px;
    color: #ffffff;
    text-align: center;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 17px;
}

a.previousEvent:hover, a.nextEvent:hover{
    color: #ffffff;
}

.previousEvent{
    float: <?php echo $gui->getLeft();?>;
    <?php if($gui->getDir()=="rtl"){?>
        direction: rtl;
    <?php } else {?>
        direction: ltr;
    <?php }?>
}

.nextEvent{
    float: <?php echo $gui->getRight();?>;
    <?php if($gui->getDir()=="rtl"){?>
        direction: ltr;
    <?php } else {?>
        direction: rtl;
    <?php }?>
}


/*--------------------------  Laptops ( max 1400 ) --------------------------*/
@media (max-width:1400px){
  
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){

}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){

}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .eventsPage .eventsItemsRow{
        margin: 0px;
        padding: 0px;
        border: none;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}