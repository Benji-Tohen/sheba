#carousel{
   
    width: 100%;
    position: relative;
}
#carousel .item{
    float: <?php echo $gui->getLeft();?>;
    width:100px;
    margin: 0px 10px 0px 10px;
    height: 200px;
    display: block;
    text-align: center;
    border: none;
}

.carouselWrap{
    position: relative;
    margin-bottom: 30px;
}

.galleryArrowLeft{
    background-image: url(<?php echo $cfg["WM"]["Server"];?>/site/images/clinics_arrow_sprite.png);
    width: 20px;
    height: 33px;
    display: block;
    position: absolute;
    left: 0;
    top: 100px;
    background-position: bottom left;
}

.galleryArrowLeft:hover{
    background-position: top left;
}

.galleryArrowRight{
    background-image: url(<?php echo $cfg["WM"]["Server"];?>/site/images/clinics_arrow_sprite.png);
    width: 20px;
    height: 33px;
    display: block;
    position: absolute;
    right: 0;
    top: 100px;
    background-position: bottom right;
}

.galleryArrowRight:hover{
    background-position: top right;
}

h5.doctorName{
    color: #222222;
    text-align: center;
    font-weight: normal;
    margin-bottom: 7px;
}

.doctorImg{
    margin-bottom: 15px;
}
.doctorSearchPage .item{
    margin-bottom: 9px;
    padding-bottom: 9px;
    border-bottom: 1px solid #ececec;
    display: block;
}

.doctorSearchPage .richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    /* border-bottom: 1px solid #d6d6d6; */
}

.doctorSearchPage a h3, .doctorSearchPage a:hover, .doctorSearchPage a:visited{
    text-decoration: none;
    color: #222222;
}

.doctorSearchPage a h6, .doctorSearchPage a:hover, .doctorSearchPage a:visited{
    text-decoration: none;
    color: #222222;
}

.doctorSearchPage h3{
    margin-bottom: 10px;
}

.doctorSearchPage h6{
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
    margin-top: 15px;
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
    padding-bottom: 20px;
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

.doctorSearchPage .itemText h6.jobTitle{
    color: #7b7b7b;
}

.engTitle{
    float: <?php echo $gui->getRight();?>;
    color: #999999;
}

.heTitle{
    float: <?php echo $gui->getLeft();?>;
}

.sepLine{
    border-top: 1px solid #d6d6d6;
    margin-top: 22px;
    margin-bottom: 25px;
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