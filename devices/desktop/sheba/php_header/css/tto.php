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

a:hover{
    text-decoration: none;
}

/* TTO ITEMS */
.tto-items{
    margin-bottom: 100px;
}

.tto-items a.item{
    display: block;
    text-align: center;
    margin-bottom: 50px;
}

.tto-items a.item h4{
    margin: 0 auto;
    text-align: center;
    color: #1f1f1f;
    font-size: 22px;
    font-weight: 400;
    height: 80px;
    overflow: hidden;
}

.tto-items a.item:hover h4, .tto-items a.item:focus h4{
    text-decoration: underline;
}

.tto-items a.item img{
    margin-bottom: 13px;
}

h2.ItemLongTitle{
    margin-top:unset;
    text-align: center;   
    padding: 15px 0;
    margin-bottom: 10px;
}
/* END TTO ITEMS */

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .bigGallery{
        visibility: hidden;
        height: 30px;
    }
    .tto-items{
        border-top: 1px solid #9a9a9b80;
        margin-top: 5px;
    }
    .item{
        margin-top: 5px;
       }
    .tto-items a.item h4{
        height: auto;
    }
}