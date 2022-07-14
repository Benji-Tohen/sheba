.doctorSearchPage .item{
    margin-bottom: 22px;
    padding-bottom: 22px;
    border-bottom: 1px solid #ececec;
    display: block;
}

.doctorSearchPage .richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #d6d6d6;
}

.doctorSearchPage a, .doctorSearchPage a:hover, .doctorSearchPage a:visited{
    text-decoration: none;
    color: #222222;
}

.doctorSearchPage a h6, .doctorSearchPage a:hover, .doctorSearchPage a:visited{
    text-decoration: none;
    color: #222222;
}

.doctorSearchPageh3{
    margin-bottom: 10px;
    font-size: 22px;
}

.doctorSearchPageh6{
    margin-bottom: 7px;
}


.doctorSearchPage .showMoreButton{
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

.doctorSearchPage .showMoreButton:hover{
    background-color: #1abc9c;
    color: #ffffff;
}

.doctorSearchPage .searchBox{
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

.doctorSearchPage .itemIcon{
    background-color: #19bd9b;
    width: 60px;
    height: 60px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    padding-right: 22px;
    padding-top: 14px;
}


.doctorSearchPage .clinicArrow{
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

.doctorSearchPage .item:hover .itemIcon{
    background-color: #34495e;
}

.doctorSearchPage .item:hover .clinicArrow{
    <?php if($gui->getDir()=="rtl"){?>
        background-position: top left;
    <?php } else {?>
        background-position: top right;
    <?php }?>
}

.doctorSearchPage .itemIcon i{
    font-size: 30px;
    color: #ffffff;
}

.doctorSearchPage .itemText{
    margin-top: 15px;
}

.doctorSearchPage .searchRow{
    margin-bottom: 20px;
    margin-top: 20px;
    border-bottom: 1px solid #d6d6d6;
}

h2.searchCategodyTitle{
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ececec;
}

.doctorSearchPage .lettersWrap{
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #d6d6d6;
}

.doctorSearchPage .letterLink{
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

.doctorSearchPage .letterLink:hover{
    background-color: #1abc9c;
    color: #ffffff;
}

.doctorSearchPage .itemText .jobTitle{
    color: #7b7b7b;
}


/*--------------------------  Laptops ( max 1400 ) --------------------------*/
@media (max-width:1400px){
  
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    .doctorSearchPage .searchBox{
        width: 166px;
    }
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .doctorSearchPage .itemImage img{
        margin-bottom: 20px;
    }
    
    .itemText{
        text-align: <?php echo $gui->getLeft();?>;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .doctorSearchPage .searchBox{
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