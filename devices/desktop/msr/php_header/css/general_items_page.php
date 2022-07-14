.item{
    margin-bottom: 22px;
    padding-bottom: 22px;
    border-bottom: 1px solid #ececec;
    display: block;
}

.richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #ececec;
}

a h3, a:hover h3, a:visited h3{
    text-decoration: none;
    color: #222222;
    margin-bottom: 5px;
}

a h5.subTitle, a:hover h5.subTitle, a:visited h5.subTitle{
    text-decoration: none;
    color: #222222;
    margin-bottom: 5px;
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
    padding-<?php echo $gui->getLeft();?>: 18px;
    padding-top: 16px;
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

.itemImage{
    max-width: ;
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
    .searchBox{
        width: 180px;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}