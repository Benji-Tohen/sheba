.item{
    margin-bottom: 22px;
    padding-bottom: 22px;
    border-bottom: 1px solid #C4C2C1;
    display: block;
}

h2{
    font-size: 26px;
}

.richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #ececec;
}

.richtext a {
     display: contents;
     max-width: unset;
     margin: unset;

}

a h3, a:visited h3{
    text-decoration: none;
    color: #222222;
    margin-bottom: 5px;
}

a:hover h3, a:focus h3{
    color: #379A87;
    transition: all 0.2s ease;
    text-decoration: none;
}

a h5.subTitle, a:hover h5.subTitle, a:visited h5.subTitle{
    text-decoration: none;
    color: #222222;
    margin-bottom: 5px;
}

.title-item{
	color: #34495E;
    font-size: 25px;
}

.link-item{
	color: #34495E;
    font-size: 25px;
    text-decoration: none;
}

.link-item:hover  h3,
.link-item:active h3,
.link-item:focus  h3 {
	color: #34495E;
	cursor: text;
}

.link-item.notClickable .title-item{
    font-weight: 600;
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
    padding-<?php echo $gui->getLeft();?>: 6px;
    text-align: center;
 
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
    font-size: 60px;
    color: #ffffff;
}

.itemText{
    height: 60px;
    display: flex;
    align-items: center;
}

.searchRow{
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ECECEC;
}

.notClickable{
    pointer-events: none;
    cursor: default;
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .searchBox{
        width: 180px;
    }
}