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
    top: 30%;
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
    top: 30%;
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
    //margin-bottom: 10px;
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
    margin: 0 5px;

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


/* Updates Feed */
.feature-title{
    color: #464646;
    font-size: 32px;
    font-weight: 400;
    width: 100%;
    text-align: center;
    position: relative;
    margin-bottom: 50px;
}

.feature-title::before,
.feature-title::after{
    content: ' ';
    display: block;
    width: 30%;
    height: 2px;
    background-color: #1abc9c;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}

.feature-title::before{
    left: 0;
}

.feature-title::after{
    right: 0;
}

.updates-item{
    margin-bottom: 35px;
}

.updates-item:hover, .updates-item:focus{
    color: #1abc9c;
}

.updates-item:after{
    margin-top: 35px;
    content: ' ';
    display: block;
    width: 100%;
    height: 1px;
    background-color: #cecece;
}

.updates-item-title, .updates-item-title:visited{
    color: #464646;
    font-size: 21px;
    font-weight: 400;
    line-height: 28px;
}

.updates-item-title:hover, .updates-item-title:focus{
    color: #1abc9c;
}

.info-block{
    margin-bottom: 20px;
}

.info-block-header{
    width: 100%;
    height: 70px;
    text-align: center;
    color: #fff;
    background: #1abc9c;
    font-size: 30px;
    font-weight: 400;
    padding-top: 14px;
}

.info-block-body{
    background: #f5f5f5;
    color: #535353;
    padding: 30px 15px;
    font-size: 17px;
    text-align: <?php echo $gui->getLeft();?>;
}

.updates-item-date{
    font-size: 14px;
}

.btn-load-more{
    width: 220px;
    padding: 10px;
    font-size: 18px;
    color: #fff;
    background-color: #1abc9c;
    margin: 0 auto 20px auto;
    display: block;
}

.btn-load-more:hover, .btn-load-more:focus{
    background-color: #71d4c0;
}
/* END Updates Feed */



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