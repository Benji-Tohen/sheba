
.doctors-slider{
text-align: center;
}
.doctors-sliderHeadline{
    margin: 0px 0px 20px 0px;
}
.round-corners{
    border-radius: 12px;
}
a{
    text-decoration: none !important;
}
.doctors-slider .slick-slide slick-cloned .slick-slide slick-active{
   /* float: <?php echo $gui->getLeft();?>;
    direction: <?php echo $gui->getDir();?>;*/
    width:187px;
}
.doctors-slider .slick-slide img{
    width:130px;
}
.doctors-slider .slick-slide{
    /* float: <?php echo $gui->getLeft();?>; */
/*    direction: <?php echo $gui->getDir();?>;*/
    width: 100%;

}
.doctors-slider .slick-slide .item{
    /*float: <?php echo $gui->getLeft();?>;*/
}
.doctors-slider .slick-prev, .doctors-slider .slick-next{
    top: 35%;
}
.doctors-slider .slick-prev{
    <?php echo $gui->getRight();?>: 0px;
}
.doctors-slider .slick-next{
    <?php echo $gui->getLeft();?>: -15px;
}

.row_slick_gallery.slick-slider{
    margin-bottom: 0px;
}

.rowslickitem.slick-slide img{
    margin-bottom: 0px;
}

.mobile_slick_gallery.slick-slider{
    margin-bottom: 0px;
}

.carouselName{
    text-shadow: none;
    text-decoration: none;
    color: #16274d;
    font-size: 35px;
    line-height: 28px;
    margin-bottom: 12px;
}

.carouselContent{
    text-shadow: none;
    text-decoration: none;
    color: #16274d;
    font-size: 20px;
    line-height: 14px;
}

.rowslickitem .carousel-caption{
    padding: 12px 0;
}


.msr > .container{
	margin-top: 30px;
}





.events-slider{
    display: block;
    text-align: center;
    float: none;
    top: auto;
    right: auto;
    bottom: auto;
    left: auto;
    z-index: auto;
    margin: 0px;
    overflow: hidden;
    position: relative;
    cursor: move;
}
.slick-slide .overlay img{
    width: inherit;
    display: inline;
}
.newFeedItem1 h6{
    margin-bottom: 26px;
    color: #4c4c4c;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
}
a.item.newFeedItem1{
    height: 300px;
    display: block;
    text-align: center;
    margin: 0 5px;
}
a.item.newFeedItem{
    min-height: 207px;
	text-decoration: none;
}
.events-slider .slick-slide{
    direction: <?php echo $gui->getDir();?>;
    float: <?php echo $gui->getLeft();?>;
}
.slick-slide img {
    margin-bottom: 13px;
}
a:hover{
    text-decoration: none;
}
.newFeedItem1 h4{
    margin-bottom: 10px;
    color: #222222;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
    margin-bottom: 2px;
}

/*Home Big Gallery*/

.bigGallery{
    margin-bottom: 25px;
}

.carousel-caption{
    width: 100%;
    position: absolute;
    left: 0;
    bottom: 0;
    padding: 23px 0 12px 0;
    background-color: rgba(255, 255, 255, 0.8);
    direction: <?php echo $gui->getDir();?>;
}

.carousel-caption h1{
    text-shadow: none;
    text-decoration: none;
    color: #16274d;
    font-size: 35px;
}
.carouselWrap1 .slick-prev{
    padding-<?php echo $gui->getRight();?>: 1px;
}
.carouselWrap1 .slick-next{
    padding-<?php echo $gui->getLeft();?>: 3px;
}
.slick-prev{
    padding-<?php echo $gui->getRight();?>: 9px;
    width: 42px;
    height: 42px;
    left: 0;
    opacity: 1;
    background-color: rgba(255, 255, 255, 0.8);
    -webkit-border-top-right-radius: 10px;
    -webkit-border-bottom-right-radius: 10px;
    -moz-border-radius-topright: 10px;
    -moz-border-radius-bottomright: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

.slick-prev:hover{
    opacity: 1;
    transition: all 0.2s ease;
}

.slick-prev:before{
    font-size: 80px;
}

.slick-next{
    padding-<?php echo $gui->getRight();?>: 16px;
    width: 42px;
    height: 42px;
    right: 0;
    opacity: 1;
    background-color: rgba(255, 255, 255, 0.8);
    -webkit-border-top-left-radius: 10px;
    -webkit-border-bottom-left-radius: 10px;
    -moz-border-radius-topleft: 10px;
    -moz-border-radius-bottomleft: 10px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}



.slick-next:hover{
    opacity: 1;
    transition: all 0.2s ease;
}

.slick-prev:before, .slick-next:before{
    color: #1ABC9C !important;
    font-size: 40px;
}
/* END Home Big Gallery */



/* Caroufredsel */
#carousel,#carousel2{
    width: 100%;
    position: relative;
        text-align: center;
}
#carousel .item{
    float: <?php echo $gui->getLeft();?>;
    height: 300px;
    display: block;
    text-align: center;
    margin: 0 4px;
}
#carousel2 .item{
    float: <?php echo $gui->getRight();?>;
    height: 300px;
    display: block;
    text-align: center;
    margin: 0 5px;
}

.carouselWrap{
    position: relative;
    margin-bottom: 10px;
}
.galleryArrowLeft{
    width: 52px;
    height: 52px;
    display: block;
    position: absolute;
    left: 20px;
    top: 55px;
    font-size: 50px;
    color: #DBDBDB;
    background-color: #FFF;
    text-align: center;
    opacity: 0.8;
    cursor: pointer;
}

.galleryArrowLeft:hover{
    opacity: 1;
}

.galleryArrowRight{
    width: 52px;
    height: 52px;
    display: block;
    position: absolute;
    right: 20px;
    top: 55px;
    font-size: 50px;
    color: #DBDBDB;
    background-color: #FFF;
    text-align: center;
    opacity: 0.8;
    cursor: pointer;
}

.galleryArrowRight:hover{
    opacity: 1;
}
/* END Caroufredsel */

.breadCrumbsContainer{
    display: none;
}

.titleLine{
    background-color: #1abc9c;
    height: 2px;
    width: 100%;
}

.homeFeed h2{
    text-align: center;
    margin-top: -15px;
}

.newFeedItem h4{
    margin-bottom: 10px;
    color: #222222;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
    /*margin-bottom: 2px;*/
    text-align: center;
    height: 24px;
}

.newFeedItem h6{
    margin-bottom: 26px;
    color: #4c4c4c;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
    height: 34px;
}

.newFeedItem:hover .overlay{
    border-radius: 12px;
}

.newFeedItem img{
    margin-bottom: 13px;
    border-radius: 12px;
}
.sideWidget img{
    border-radius: 12px;
}

.newFeedItemDate{
    color: #949494;
    font-size: 14px;
    margin-bottom: 5px;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
    margin-bottom: 5px;
}

.newFeedItemEn h4{
    color: #222222;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
    text-align: center;
    margin-bottom: 20px;
}

.newFeedItemEn h6{
    margin-bottom: 26px;
    color: #4c4c4c;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
}

.newFeedItemEn img{
    border-radius: 12px;
    margin-bottom: 5px;
}










.eventsFeedItem h3{
    margin-bottom: 10px
}

.eventsFeedItem h4{
    margin-bottom: 26px;
}

.eventsFeedItem img{
    margin-bottom: 13px;
}

.eventsFeedItemDate{
    color: #949494;
    font-size: 14px;
    margin-bottom: 10px;
}


.moreButton{
    display: block;
    font-size: 20px;
    color: #34495e;
    margin-bottom: 25px;
}



.moreButton i{
    font-size: 16px;
}



.newFeedItem{
    vertical-align: top;
    display: block;
    text-align: center;
    max-width: 240px;
    margin: 0px auto 15px auto;
}

.newFeedItem .overlay{
    top: 0px;
    text-align: center;
    z-index: 80;
    height: 153px;
    border-radius: 7px;
}

.msrBanner{
    margin-bottom: 60px;
}

.titleLine{
    background-color: #c6dc5c;
}

.slick-prev, .slick-next{
    top: calc(50% - 28px);
    transform: translateY(-50%);
}


/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    #carousel .item{
        float: none;
        display: inline-block;
    }
    .newFeedItem img {
    margin-bottom: 7px;
    }
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
 #carousel .item, #carousel2 .item{
      width: 229px;
    }

    #carousel .item{
    /*float: <?php echo $gui->getLeft();?>;*/
    height: 300px;
    display: inline-block;
    text-align: center;
    margin: 0 4px;
    float: none;
    }

}

/*--------------------------  XS ( max 767 ) --------------------------*/
@media (max-width:767px){
    /*
    #carousel .item, #carousel2 .item{
      width: 244px !important;
    }
    */

    .carousel.slide{
        display: none;
    }

    .homeFeed h2{
        text-align: <?php echo $gui->getLeft();?>;
        border-bottom: 2px solid #27B99A;
        margin-top: 0px;
        padding-bottom: 10px;
    }

    #carousel .item, #carousel2 .item{
        <?php/*
    float: left;
        width: auto;
    */ ?>
    width: 100%;
    }
    .carousel-caption{
        position: relative;

    }
    .carousel-caption h1{
        font-size: 28px;
    }
    .slick-prev, .slick-next{
        top: calc(50% - 28px);
        transform: translateY(-50%);
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    /*
    #carousel .item, #carousel2 .item{
      width: 240px !important;
    }
    */
    .homeChildrenFeed{
        position: relative;
        text-align: center;
    }
}


