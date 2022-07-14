a:hover{
    text-decoration: none;
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
    padding: 32px 0 12px 0;
    background-color: rgba(255, 255, 255, 0.8);
    direction: <?php echo $gui->getDir();?>;
}

.carousel-caption h1{
    text-shadow: none;
    text-decoration: none;
    color: #16274d;
}

.slick-prev{
    width: 29px;
    height: 49px;
    top: 37%;
    left: 2%;
    opacity: 1;
}

.slick-prev:hover{
    opacity: 1;
    transition: all 0.2s ease;
}

.slick-prev:before{
    font-size: 80px;
}

.slick-next{
    width: 29px;
    height: 49px;
    top: 37%;
    right: 2%;
    opacity: 1;
}

.slick-next:hover{
    opacity: 1;
    transition: all 0.2s ease;
}


.slick-next:before{
    font-size: 80px;
}

.slick-prev:before, .slick-next:before{
    color: #34495E;
}
/* END Home Big Gallery */



/* Caroufredsel */
#carousel,#carousel2{
    width: 100%;
    position: relative;
}
#carousel .item{
    float: left;
    height: 300px;
    display: block;
    text-align: center;
    margin: 0 5px;
}
#carousel2 .item{
    float: left;
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
    display: block;
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

.newFeedItem{
    display: block;
    margin-bottom: 30px;
}

.newFeedItem h4{
    margin-bottom: 10px;
    color: #222222;
    margin: 0 auto;
    text-align: center;
    width: 240px;
    margin-bottom: 2px;
}

.newFeedItem h6{
    margin-bottom: 26px;
    color: #4c4c4c;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
}

.newFeedItem img{
    margin-bottom: 13px;
}

.newFeedItemDate{
    color: #949494;
    font-size: 14px;
    margin-bottom: 10px;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
    margin-bottom: 10px;
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

.bannerImg{
    margin-bottom: 52px;
}

.moreButton i{
    font-size: 16px;
}

#weeklyCalendar{
    margin-bottom: 40px;
}


/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){

}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){

}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
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
        float: left;
        width: auto;
    }

    .newFeedItem img{
        margin: 0 auto 13px auto;
    }

    .newFeedItem{
        text-align: center;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    /*
    #carousel .item, #carousel2 .item{
      width: 240px !important;
    }
    */
}


