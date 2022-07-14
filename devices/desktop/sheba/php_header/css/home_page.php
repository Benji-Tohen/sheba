/*------------------------------------------BIG GALLERY--------------------------------------------------------*/
.big-gallery{
    margin-bottom: 25px;
}
<?php if (empty($arr_pictures) && $wmPage["Top_Header3"] ){ ?>
    .carousel-inner {
        max-height: 450px;
    }
<?php } ?>
/*start dots*/
.row_slick_gallery .slick-dots{
    position: absolute;
    list-style: none;
    display: block;
    text-align: center;
    width: 100%;
    margin: 0 0 36px 0;
    bottom: 0px;
    z-index: 50;
    height: 30px;
    display: flex;
    justify-content: center;
    padding: 0px;
}
.row_slick_gallery .slick-dots li button:before {
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
    border-radius: 50%;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    border : 1px solid #0000009c;
}
.row_slick_gallery .slick-dots li button {
    background:  white;
    display: block;
    outline: none;
    width: 16px;
    height: 16px;
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
    border-radius: 50%;
    font-size: 18px;
    line-height: 20px;
    outline: none;
    line-height: 0;
    font-size: 0;
    opacity: 0.25;
}
.row_slick_gallery .slick-active li button:before{
    color: white;
    opacity: 0.25;
    outline: none;
    font-size: 18px;
    line-height: 20px;
    height:15px;
    width: 15px;
    border-radius: 50%;
    border : 1px solid #0000009c;
}
.slick-dots li {
    margin: 0px 5px;
    position: relative;
}
/*end dots*/
.homeVid{
    max-width: 1140px;
    width: 100%;
    overflow: hidden;
    max-height: 450px;
    margin: 0 auto;
    margin-bottom: 65px;
}
.vid{
    width: 100%;
}
.img-banner{
    min-height: 450px;
    max-height: 450px;
}

.carousel-caption{
    width: 100%;
    position: absolute;
    left: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.8);
    direction: <?php echo $gui->getDir();?>;
}
.carousel-caption h1{
    text-shadow: none;
    text-decoration: none;
    color: #16274d;
    font-size: 35px;
}
.slick-slide .overlay img{
    width: inherit;
    display: inline;
}

.gray-line{
    margin-top: 15px;
    margin-bottom: 15px;
    background-color: #ececec;
    height: 1px;
    width: 100%;
}
.moreButton{
    display: block;
    font-size: 20px;
    margin-bottom: 25px;
    margin-bottom: 50px;
    text-align: <?php echo $gui->getLeft();?>;
}
.moreButton i{
    font-size: 16px;
}
/*-------------------------------------------CHELDREN----------------------------------------------------------*/
.item-name{
    color: #232b76;
    text-align: center;
    font-size: 20px;
}
h2.ItemLongTitle{
    margin-top:unset;
    text-align: center;   
    padding: 15px 0;
}
.homeFeed h2{
    text-align: center;
}
.newFeedItem h4{
    margin-bottom: 10px;
    color: #222222;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
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
    text-align: <?php echo $gui->getLeft();?>;
    margin-bottom: 10px;
}
.homeChildrenFeed{
    margin-bottom: 80px;
}

/*-------------------------------------------NEWS--------------------------------------------------------------*/
.newsImg{
    margin: 0 auto;
}
.wrapp-news-text{
    padding: 0 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 100%;
}
.new-sub-title{
    margin-bottom: 10px;
    color: #222222;
    font-size: 18px;
    text-align: <?php echo $gui->getLeft();?>;
}
.newsCta{
    text-align: <?php echo $gui->getRight();?>;  
    font-size: 20px;
 }
.newsChev{
    font-size: 25px;
 }

/* END Home Big Gallery */


/* END Caroufredsel */

.breadCrumbsContainer{
    display: none;
}
.titleLine{
    background-color: #1abc9c;
    height: 2px;
    width: 100%;
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



.newFeedItem1 h6{
    margin-bottom: 26px;
    color: #4c4c4c;
    margin: 0 auto;
    text-align: <?php echo $gui->getLeft();?>;
    width: 240px;
}
a.item.newFeedItem1{
    display: flex;
    text-align: center;
    margin: 0 5px;
}

a:hover{
    text-decoration: none;
}

.newFeedItem1 h4{
    color: #222222;
    font-size: 22px;
    text-align: <?php echo $gui->getLeft();?>;
    width: 100%;
    margin-bottom: 10px;
}

.homeNewsItem:hover .newFeedItem1 h4{
    color: #1ABC9C;
}



/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    .slick-prev, .slick-next{
        top: 30%;
    }

    #carousel .item{
        float: none;
        display: inline-block;
    }
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .moreButton{
        margin-bottom: 20px;;
    }
    a.item.newFeedItem1{
        flex-direction: column;
        align-items: center;
    }
    img.event-img{
        width: fit-content;
    }
    .newFeedItemEn h4,
    .newFeedItemEn h6,
    .event-sub-title,
    .newFeedItemDate,
    .event-item h4{
        text-align: center;
    }

}

/*--------------------------  XS ( max 767 ) --------------------------*/
@media (max-width:767px){
	.slick-slider{
		margin: 0px 0 30px 0;
	}
    .homeFeed h2{
        text-align: <?php echo $gui->getLeft();?>;
        border-bottom: 2px solid #27B99A;
        margin-top: 0px;
        padding-bottom: 10px;
    }

    .carousel-caption{
        position: relative;
    }
    .carousel-caption h1{
        font-size: 28px;
    }
    .slick-prev,
    .slick-next{
        top: 30%;
    }

    h2.ItemLongTitle{
        text-align: center;   
        margin-left: 10px;
        margin-right: 10px;;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    .homeChildrenFeed{
        position: relative;
        text-align: center;
	
    }
    
    .homeVid{
        margin-bottom: 15px;
    }
}



