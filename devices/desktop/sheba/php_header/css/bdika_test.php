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


/*start module code*/
.itemExpand{
    text-align: center;
}
.itemExpand button{
    border: none;
    background: transparent;
    font-size: 38px;
    color: #5b7b81;
}
.dropNewsPage{
    margin-bottom: 65px;
}
.grayRow{
    width: 100%;
    height: 1px;
    background-color: #ccc;
}
.newsItem{
    margin-top: 15px;  
    padding-bottom: 0px;
}
.itemExpand button .fa-times {
    font-size: 20px;
}
.newsItem:first-child{
    margin-top: 0px;
}
.newsItem:last-child{
    margin-bottom: 0px;
    border-bottom: none;
}
.itemTitle h2{
    color: #666666;
    margin-bottom: 10px;
    vertical-align: top;
    padding-top: 8px;
    font-size: 20px;
}
.itemTitle h6{
    color: #777777;
    font-weight: 300;
}
.itemDate h6{
    color: #777777;
}
.itemTitle a:hover, 
.itemTitle a:focus, 
.itemDate a:hover, 
.itemDate a:focus{
    text-decoration: none;
}
h6.publishTitle{
    font-weight: bold;
    margin-bottom: 10px;
}
.itemToggle{
    font-size: 35px;
    color: #da2020;
    cursor: pointer;
    text-align: <?php echo $gui->getRight();?>;
}
.expendedItem{
    background-color: #ffffff;
    padding: 22px;
    padding-top:0px;
    padding-right: 0px;  
}
.colorRed{
    color: red !important;
}
h4.expendTitle{
    font-weight: bold;
    margin-bottom: 15px;
}
h6.expandContent{
    font-weight: 300;
    margin-bottom: 28px;
    color: #666666;
    line-height: 26px;
    font-size: 16px;
    font-weight: 400;
}
.readMore{
    font-size: 18px;
    font-weight: 300;
    text-align: center;
    display: block;
    padding: 16px 17px;
    text-transform: uppercase;
    background-color: #324da0;
    color: #ffffff;
    max-width: 128px;
    transition: all 0.2s ease;
}
.readMore:hover, 
.readMore:focus{
    background-color: #4A68C2;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.2s ease;
}
/* ITEM OVERLAY */
.itemImage .overlayItem{
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    opacity: 0;
    -moz-transition: 0.5s all ease;
    -webkit-transition: 0.5s all ease;
    -o-transition: 0.5s all ease;
    transition: 0.5s all ease;
    color: #ffffff;
    background: transparent;
}
.itemImage .overlayItem:before{
    content: '\f0c1';
    position: absolute;
    top: 50%;
    left: 50%;
    -moz-transform: translate(-50%, -50%) scale(0) rotate(0deg);
    -ms-transform: translate(-50%, -50%) scale(0) rotate(0deg);
    -o-transform: translate(-50%, -50%) scale(0) rotate(0deg);
    -webkit-transform: translate(-50%, -50%) scale(0) rotate(0deg);
    transform: translate(-50%, -50%) scale(0) rotate(0deg);
    font: 400 20px 'FontAwesome';
    line-height: 70px;
    text-align: center;
    width: 70px;
    height: 70px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    background: rgba(20,20,20,0.85);
    -moz-transition: 0.5s all ease;
    -webkit-transition: 0.5s all ease;
    -o-transition: 0.5s all ease;
    transition: 0.5s all ease;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.itemImage > a:hover .overlayItem:before, .itemImage > a:focus .overlayItem:before{
    -moz-transform: translate(-50%, -50%) scale(1) rotate(360deg);
    -ms-transform: translate(-50%, -50%) scale(1) rotate(360deg);
    -o-transform: translate(-50%, -50%) scale(1) rotate(360deg);
    -webkit-transform: translate(-50%, -50%) scale(1) rotate(360deg);
    transform: translate(-50%, -50%) scale(1) rotate(360deg);
}
.itemImage > a:hover .overlayItem, .itemImage > a:focus .overlayItem{
    opacity: 1;
    -moz-transition: 0.3s all ease;
    -webkit-transition: 0.3s all ease;
    -o-transition: 0.3s all ease;
    transition: 0.3s all ease;
}
/* END ITEM OVERLAY */


/* end module cod */
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


@media (min-width:768px) and (max-width:1199px){
    .pagerWrap a{

        font-size: 22px;
        margin-top: 40px;
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
    /*start css modul*/
    .expendedItem img{
        margin: 0 auto 20px auto;
    }
    /*end css modil*/
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    /*start modul*/

/* --------------PAGER--------*/
    .pagerWrap{
        text-align: center;
        margin-top:30px;
    }
    .pagerLinks{
        text-align: <?php echo $gui->getRight();?>;
        font-size: 32px;
        margin-top: 50px;
    }
    .pagerLinks a{
        margin-<?php echo $gui->getLeft();?>: 8px;
    }
    .current{
        font-weight:bold;
    }
    .pagerWrap a, .pagerWrap span{
        background: #ffffff; /* Old browsers */
        background: -moz-linear-gradient(top,  #ffffff 0%, #efefef 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#efefef)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #ffffff 0%,#efefef 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #ffffff 0%,#efefef 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #ffffff 0%,#efefef 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #ffffff 0%,#efefef 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#efefef',GradientType=0 ); /* IE6-9 */
    }
    .pagerWrap a, .pagerWrap a:visited{
        color: #575757;
        height:45px;
        padding-top: 13px;
        padding-left: 17px;
        padding-right: 17px;
    }

    .pagerWrap a:hover, .pagerWrap span:hover, .pagerWrap a:focus, .pagerWrap span:focus, .pagerWrap span{
        color: #ffffff;
        background: #274197; /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover, #274197 0%, #192c6f 100%); /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,#274197), color-stop(100%,#192c6f)); /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover, #274197 0%,#192c6f 100%); /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover, #274197 0%,#192c6f 100%); /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover, #274197 0%,#192c6f 100%); /* IE10+ */
        background: radial-gradient(ellipse at center, #274197 0%,#192c6f 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#274197', endColorstr='#192c6f',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
    }
    /* PAGER */
    .newsPagePager{
        margin: 15px 0 0;
    }
    .pagerWrap a{
        font-size: 18px;
    }
    /*end modul*/
}

/*--------------------------  Exception ( Only 768 ) --------------------------*/
@media(width:768px){
    .itemText{
        text-align: <?php echo $gui->getLeft();?>;
    }
}


