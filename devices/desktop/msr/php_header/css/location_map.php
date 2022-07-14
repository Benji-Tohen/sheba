.item{
    margin-bottom: 22px;
    padding-bottom: 22px;
    border-bottom: 1px solid #ececec;
    display: block;
}

.item:last-child{
    border-bottom: 0px;
}

.richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #ececec;
}

a h4, a:hover h4, a:visited h4{
    text-decoration: none;
    color: #666666;
    margin-bottom: 10px;
}

a h5, a:visited h5{
    text-decoration: none;
    color: #666666;
    margin-bottom: 10px;
}

a:hover h5{
    text-decoration: none;
}

h5 i{
    color: #c4c4c4;
    margin-<?php echo $gui->getRight();?>: 5px;
}

.searchBox{
    width: 255px;
    height: 46px;
    border: 1px solid #D3D3D3;
    padding: 0 10px;
    box-shadow: none;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.searchBoxButton{
    background-color: #17bd99;
    padding: 12px 32px;
    color: #ffffff;
    font-size: 16px;
    display: inline-block;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    cursor:pointer;
    margin-<?php echo $gui->getLeft();?>: 5px;
    border: none;
}

.searchBoxButton:hover{
    background-color: #34495e;
}

.itemIcon{
    background-color: #19bd9b;
    width: 60px;
    height: 60px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    padding-right: 22px;
    padding-top: 14px;
}


.clinicArrow{
    background-image: url(<?php echo $cfg["WM"]["Server"];?>/site/images/clinics_arrow_sprite.png);
    width: 20px;
    height: 33px;
    margin-top: 15px;
    <?php if($gui->getDir()=="rtl"){?>
        background-position: bottom left;
    <?php } else {?>
        background-position: bottom right;
    <?php }?>
}

.item:hover .itemIcon{
    background-color: #34495e;
}

.item:hover .clinicArrow{
    <?php if($gui->getDir()=="rtl"){?>
        background-position: top left;
    <?php } else {?>
        background-position: top right;
    <?php }?>
}

.itemIcon i{
    font-size: 30px;
    color: #ffffff;
}

.itemText{

}

.searchRow{
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ECECEC;
}

.mapEmbed{
    margin-bottom: 20px;
    padding: 5px 5px 2px 5px;
    border: 1px solid #A7A8A8;
}

.wazeLink{
    background-color: #f2f2f2;
    display: block;
    padding: 17px;
    max-width: 68px;
    float: <?php echo $gui->getRight();?>;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    position: relative;
}

.wazeLink img{
    width: 36px;
}

.wazeLink .titlePop{
    opacity: 0;
    position: absolute;
    top: 55px;
    <?php echo $gui->getRight();?>: -65px;
    margin: 0 auto;
    width: 200px;
    background-color: #34495e;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    text-align: center;
    padding: 15px;
    -webkit-box-shadow: 0 0 10px 0 rgba(0,0,0,0.4);
    box-shadow: 0 0 10px 0 rgba(0,0,0,0.4);
    transition: all 0.2s ease;
}

.wazeLink:hover .titlePop{
    opacity: 1;
    transition: all 0.2s ease;
}

.wazeLink h5{
    color: #ffffff;
    margin-bottom: 0px;
}

a.wazeLink:hover h5{
    color: #ffffff;
    margin-bottom: 0px;
}

.wazeLink .glyphicon{
    color: #34495e;
    font-size: 18px;
    position: absolute;
    top: -10px;
    left: 0;
    right: 0;
    margin: 0 auto;
    width: 20px;
}

/*--------------------------  Laptops ( max 1400 ) --------------------------*/
@media (max-width:1400px){
  
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){

}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .itemImage img{
        margin-bottom: 20px;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .searchBox{
        width: 180px;
    }
    
    .wazeLink:hover .titlePop{
        display: none;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}