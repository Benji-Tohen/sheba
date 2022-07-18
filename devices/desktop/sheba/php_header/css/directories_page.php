.directoriesPage .item{
    border-bottom: 1px solid #ececec;
    display: block;
}

.directoriesPage .item:last-child{
    margin-bottom: 30px;
}

.directoriesPage .richtext{
    font-size: 14px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #d6d6d6;
}

.directoriesPage a h4, .directoriesPage a:hover, .directoriesPage a:visited{
    text-decoration: none;
    color: #222222;
}

.directoriesPage a h6, .directoriesPage a:hover, .directoriesPage a:visited{
    text-decoration: none;
    color: #222222;
}

.directoriesPage h6{
    margin-bottom: 7px;
}


.directoriesPage .showMoreButton{
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
    cursor:pointer;
}

.directoriesPage .showMoreButton:hover{
    background-color: #1abc9c;
    color: #ffffff;
}

.directoriesPage .searchBox{
    width: 210px;
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
    padding: 12px 26px;
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

.directoriesPage .itemIcon{
    background-color: #19bd9b;
    width: 60px;
    height: 60px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    padding-right: 22px;
    padding-top: 14px;
}


.directoriesPage .clinicArrow{
    background-image: url(<?php echo $cfg["WM"]["Server"];?>/site/images/clinics_arrow_sprite.png);
    width: 20px;
    height: 33px;
    margin-top: 35px;
    <?php if($gui->getDir()=="rtl"){?>
        background-position: bottom left;
    <?php } else {?>
        background-position: bottom right;
    <?php }?>
}

.directoriesPage .item:hover .itemIcon{
    background-color: #34495e;
}

.directoriesPage .item:hover .clinicArrow{
    <?php if($gui->getDir()=="rtl"){?>
        background-position: top left;
    <?php } else {?>
        background-position: top right;
    <?php }?>
}

.directoriesPage .itemIcon i{
    font-size: 30px;
    color: #ffffff;
}

.directoriesPage .itemText, .directoriesPage .itemPhone{
    margin-top: 10px;
    margin-bottom: 10px;
}



.directoriesPage .searchRow{
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #d6d6d6;
}

h2.searchCategodyTitle{
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ececec;
}

.directoriesPage .lettersWrap{
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #d6d6d6;
}

.directoriesPage .letterLink{
    width: 34px;
    height: 37px;
    background-color: #ececec;
    color: #222222;
    font-size: 18px;
    display: inline-block;
    margin-<?php echo $gui->getLeft();?>: 4px;
    cursor: pointer;
    text-align: center;
    padding-top: 5px;
    margin-bottom: 5px;
}

.directoriesPage .letterLink:hover{
    background-color: #1abc9c;
    color: #ffffff;
}

.directoriesPage .itemText h6.jobTitle{
    color: #7b7b7b;
}

.itemPhone{
    text-align: <?php echo $gui->getRight();?>;
}
.directoriesPage .pushdown{
    margin-top: 1em;
}

/*--------------------------  Laptops ( max 1400 ) --------------------------*/
@media (max-width:1400px){
  
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    .directoriesPage .searchBox{
        width: 166px;
    }
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .directoriesPage .itemImage img{
        margin-bottom: 20px;
    }
    
    .itemText{
        text-align: <?php echo $gui->getLeft();?>;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .directoriesPage .searchBox{
        width: 100%;
        margin-bottom: 6px;
    }

    .searchBoxButton{
        width: 100%;
        text-align: center;
    }

    .childrenWrap img{
        margin: 0 auto;   
    }

    .img-circle{
        margin: 0 auto;
    }

    .directoriesPage .itemText, .directoriesPage .itemPhone{
        min-height: 80px;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}

/*--------------------------  Exception ( Only 768 ) --------------------------*/
@media(width:768px){
    .itemText{
        text-align: <?php echo $gui->getLeft();?>;
    }
}