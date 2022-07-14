a:hover{
    text-decoration: none;
}


/*--------------------------Home Big Gallery------------------------------------*/

/*start dots*/
.row_slick_gallery .slick-dots{
    position: absolute;
    list-style: none;
    display: block;
    text-align: center;
    width: 100%;
    bottom: 90px;
    z-index: 70;
    height: 30px;
    display: flex;
    justify-content: center;
    padding: 0px;
}
.row_slick_gallery  .slick-dots li button:before {
    position: absolute;
    top: 0;
    left: 0;
    content: "\2022";
    height:16px;
    width: 16px;
    font-family: "slick";
    font-size: 18px;
    line-height: 20px;
    text-align: center;
    color: white;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
.row_slick_gallery .slick-dots li button {
    background:  white;
    display: block;
    height:16px;
    width: 16px;
    outline: none;
    line-height: 0;
    font-size: 0;
    color: white;
    padding: 5px;
    cursor: pointer;
    outline: none;
    border-radius: 50%;
}
.row_slick_gallery .slick-dots .slick-active{
    color: white;
    opacity: 0.25;
}
.row_slick_gallery  .slick-active li button:before{
    color: white;
    opacity: 0.25;
}
.slick-dots li {
    margin: 0px 2px;
    position: relative;
}

.bigGallery{
    margin-bottom: 25px;
}
/*end start dots*/

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
/* END Home Big Gallery */

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

.newFeedItem1 h4{
    margin-bottom: 10px;
    color: #222222;
    margin: 0 auto;
    text-align: right;
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
}

.newFeedItem1 .overlay{
    top: 0px;
}

.marginbottom{
    margin-bottom: 30px;
}
a.item.newFeedItem1{
    height: 250px;
    display: block;
    text-align: right;
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
.newFeedItem1 .overlay{
    text-align: center;
}

/* FIRST SLIDER */
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
.slick-slide img{
    width: inherit;
    display: inline;
    margin: auto;
    text-align: center;
}

.newFeedItem1 h6{
    margin-bottom: 26px;
    color: #4c4c4c;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
}

.newFeedItem1h6{
    font-size: 14px;
    margin-bottom: 26px;
    color: #4c4c4c;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
}

a.item.newFeedItem{
    height: 220px;
    display: block;
    text-align: center;
}
.events-slider .slick-slide{
    direction: <?php echo $gui->getDir();?>;
}

.slick-slide img {
    margin-bottom: 13px;
}

.firstCarousel .slick-next, .firstCarousel .slick-prev{
    top: 33%;
}

.newFeedItem .overlay{
    top: 30px;
}
/* END FIRST SLIDER */



/* SECOND SLIDER */
.news-slider{
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

.secondCarousel .slick-next, .secondCarousel .slick-prev{
    top: 32%;
}
/* END SECOND SLIDER */



/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){

}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){

}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
	.slick-slider{
		margin: 30px 0 30px 0;
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

}


