.eventRegisterButton a, .eventRegisterButton a:visited{
    width: 100%;
    max-width: 340px;
    display: block;
    background-color: #19bd9b;
    color: #ffffff;
    text-align: center;
    font-size: 18px;
    padding: 10px 20px;
    border: none;
    margin: 0 auto 30px auto;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.img-responsive, .thumbnail > img, .thumbnail a > img, .carousel-inner > .item > img, .carousel-inner > .item > a > img{
        display: inline-block;

}
.slick-slide slick-cloned .slick-slide slick-active{
   /* float: <?php echo $gui->getLeft();?>;
    direction: <?php echo $gui->getDir();?>;*/
    width:187px;
}
.slick-slide img{
    width:130px;
}
.slick-slide{
    /* float: <?php echo $gui->getLeft();?>; */
/*    direction: <?php echo $gui->getDir();?>;*/
    width: 100%;

}
.slick-slide .item{
    /*float: <?php echo $gui->getLeft();?>;*/
}
.slick-prev, .slick-next{

    top: 35%;
}
.slick-prev{
    color:black;
    <?php echo $gui->getRight();?>: 0px; 
}
.slick-next{
    <?php echo $gui->getLeft();?>: -15px;
}
.institutePage .richtext{
    font-size: 18px;
    color: #222222;
    margin-bottom: 20px;
}

.institutePage{
    margin-bottom: 25px;
}

.institutePage a:hover{
    text-decoration: none;
}

.institutePage .innerImg{
    position: relative;
    max-width: 632px;
    margin: 0 auto 23px auto;
}

.institutePage .pageTitleBG{
    /* height: 55px; */
    padding-bottom: 1px;
    background-color: #f0f0f0;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.institutePage h1{
    color: #232323;
    padding: 18px 16px 18px 16px;
    margin: 0px;
    font-size: 33px;
}
.searchBoxButton {
    background-color: #17bd99;
    padding: 12px 16px;
    color: #ffffff;
    font-size: 16px;
    text-align: -webkit-center;
    display: table-cell;
    cursor: pointer;
    border-radius: inherit!important;
    -webkit-border-top-left-radius: 5px!important;
    -webkit-border-bottom-left-radius: 5px!important;
    -moz-border-radius-topleft: 5px!important;
    -moz-border-radius-bottomleft: 5px!important;
    border-top-left-radius: 5px!important;
    border-bottom-left-radius: 5px!important;

}
.searchRow {
    border-top: 1px solid #ECECEC;
    padding-top: 20px;
}
.searchRow {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ECECEC;
    display: table;
        width: 100%;
        text-align:center;
}
.searchBox {
    padding: 0 10px;
    height: 60px;
    color: #16274d;
    font-size: 16px;
    border: 1px solid #c1c1c1;
    -webkit-box-shadow: inset 0 0 5px 0 #d9d8d6;
    box-shadow: inset 0 0 5px 0 #d9d8d6;
    border-radius: 8px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    width: 100%;
}
.institutePage .instituteInfoBox{
    min-height: 100px;
    padding: 13px 15px;
    border: 1px solid #ececec;
    border-top: 0px;
    margin-bottom: 45px;
    -webkit-border-bottom-right-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-radius-bottomright: 5px;
    -moz-border-radius-bottomleft: 5px;
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
}

.numInfoTextRight{
    float: <?php echo $gui->getLeft();?>;
}

.numInfoTextLeft{
    float: <?php echo $gui->getRight();?>;
}


.institutePage .mapLink{
    color: #1abc9c;
    font-size: 16px;
    display: inline-block;
}

.institutePage .locationTitle{
    display: inline-block;
    margin-<?php echo $gui->getRight();?>: 7px;
}

.infoCol{
    border-<?php echo $gui->getRight();?>: 1px solid #c7c7c7;
}

.institutePage .sepLine{
    width: 100%;
    height: 1px;
    background-color: #ececec;
    margin-bottom: 10px;
}
.doctors-slider{
text-align: center;
}
.doctors-sliderHeadline{
    margin: 0px 0px 20px 0px;
}
#carousel{
   
    width: 100%;
    position: relative;
}
#carousel .item{
    float: left;
    width:100px;
    margin: 0px 10px 0px 10px;
    height: 200px;
    display: block;
    text-align: center;
    border: none;
}

.carouselWrap{
    position: relative;
    margin-bottom: 10px;
}
i.fa.fa-angle-left.slick-prev, i.fa.fa-angle-left.slick-next{
    color: #E6E5E3 !important;
}
.galleryArrowLeft{
    background-image: url(<?php echo $cfg["WM"]["Server"];?>/site/images/clinics_arrow_sprite.png);
    width: 20px;
    height: 33px;+
    display: block;
    position: absolute;
    left: -25px;
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
    right: -25px;
    top: 100px;
    background-position: bottom right;
}

.galleryArrowRight:hover{
    background-position: top right;
}

div.doctorName{
    color: #222222;
    text-align: center;
    font-weight: normal;
    margin-bottom: 7px;
    font-size: 15px;
}

.doctorImg{
    margin-bottom: 15px;
}

.institutePage h2{
    margin-bottom: 14px;
}

h2.clinicTeamTitle{
    text-align: center;
    margin-bottom: 25px;
}

.showMoreButton{
    margin-bottom: 20px;
    padding-top: 0px;
    width: 100%;
    max-width: 256px;
    background-color: #fff;
}

.searchRow{
    border-top: 1px solid #ECECEC;
    padding-top: 20px;
}

.infoCircle{
    background-color: #14a6cb;
    display: table-cell;
    width: 60px;
    height: 60px;
    text-align: center;
    vertical-align: middle;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}

.infoCircle svg{
    width: 32px;
    height: 32px;
}

.infoCircle *{
    fill: #fff;
}

h3.infoText{
    display: table-cell;
    vertical-align: middle;
    color: #222222;
    padding-<?php echo $gui->getLeft();?>: 70px;
}

.infoWrap{
    display: table;
    margin-bottom: 22px;
    padding-bottom: 22px;
    border-bottom: 1px solid #ececec;
}

.infoWrap:hover .infoCircle{
    background-color: #34495e;
}
a, a:visited {
    color: #1ABC9C;
    transition: all 0.2s ease;
}

@media (min-width: 1200px){
.col-lg-2 {
    width: 16.66666667%;
}
}
.itemIcon i {
    font-size: 30px;
    color: #ffffff;
}
@media (min-width: 1200px)
.col-lg-9 {
    width: 75%;
}
a h3, a:hover h3, a:visited h3 {
    text-decoration: none;
    color: #222222;
    margin-bottom: 5px;
}
.itemIcon {
    background-color: #19bd9b;
    width: 60px;
    height: 60px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    padding-right: 22px;
    padding-top: 14px;
}
h5 {
    font-size: 16px;
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .infoCol{
        margin-bottom: 15px;
        border-bottom: 1px solid #c7c7c7;
        padding-bottom: 15px;
        border-<?php echo $gui->getRight();?>: 0px;
    }

    .galleryArrowLeft{
        left: -15px;
    }

    .galleryArrowRight{
        right: -15px;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .showMoreButton{
        max-width: 100%;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    h3.infoText{
        padding-<?php echo $gui->getLeft();?>: 20px;
    }
}
