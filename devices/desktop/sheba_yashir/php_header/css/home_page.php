h1{
    font-size: 34px;
    color: #271c3f;
    margin-bottom: 6px;
}

h2{
    font-size: 20px;
    font-weight: normal;
    color: #444444;
    margin-bottom: 30px;
    text-align: center;
}

.sepLine{
    width: 100%;
    height: 3px;
    background-color: #f1f1f1;
    margin-bottom: 35px;
}

/* HOMEPAGE BANNERS */
.bannerSubtitle{
    font-size: 22px;
    font-weight: 300;
    color: #271c3f;
}

.bannerItem{
    font-size: 0;
    background-color: #c2dfa3;
    position: relative;
    float: <?php echo $gui->getRight();?>;
    height: 425px;
    margin-bottom: 35px;
}

.bannerImg{
    display: inline-block;
    vertical-align: top;
    width: 50%;
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: <?php echo $gui->getLeft();?>;
}

.bannerText{
    display: inline-block;
    vertical-align: top;
    width: 50%;
    font-size: 14px;
}

.bannerTextBox{
    text-align: center;
}

.bannerBtn{
    margin: 0 auto;
    max-width: 200px;
}

.bannerSubtitle{
    margin-bottom: 30px;
}
/* END HOMEPAGE BANNERS */



/* HOMEPAGE ITEMS */
.homepageItems{
    text-align: center;
    margin-bottom: 35px;
}

.homepageItem{
    display: inline-block;
    width: 108px;
    text-align: center;
    margin-<?php echo $gui->getLeft();?>: 80px;
}

.homepageItem:first-child{
    margin-<?php echo $gui->getLeft();?>: 0px;
}

.homepageItemTitle{
    font-size: 16px;
    color: #000000;
}

.homepageItem img{
    margin-bottom: 16px;
}
/* END HOMEPAGE ITEMS */



/* HOMEPAGE SLIDER */
.homepageSlider{
    overflow: hidden;
    position: relative;
    text-align: center;
}

.homepageSlider .slideItem{
    display: block;
    float: <?php echo $gui->getRight();?>;
}

.homepageSlider .slick-arrow{
    display: inline-block;
    position: absolute;
    top: 60px;
    font-size: 15px;
    width: 27px;
    height: 27px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    background-color: rgba(241, 241, 241, 0.8);
    z-index: 90;
    outline: none;
    -o-transition:        background-color 0.3s ease, color 0.3s ease;
    -ms-transition:       background-color 0.3s ease, color 0.3s ease;
    -moz-transition:      background-color 0.3s ease, color 0.3s ease;
    -webkit-transition:   background-color 0.3s ease, color 0.3s ease;
    transition:           background-color 0.3s ease, color 0.3s ease;
}

.homepageSlider .slick-arrow:hover, .homepageSlider .slick-arrow:focus{
    background-color: rgba(45, 28, 82, 1);
    color: #fff;
}

.homepageSlider .slick-next{
    <?php echo $gui->getLeft();?>: 10px;
}

.homepageSlider .slick-prev{
    <?php echo $gui->getRight();?>: 10px;
}

.homepageSlider .slideName{
    font-size: 14px;
    font-weight: bold;
    color: #444444;
    margin-bottom: 35px;
}

.homepageSlider .slideDate{
    color: #949494;
    font-size: 14px;
    margin-bottom: 5px;
    margin: 0 auto;
    text-align: right;
    width: 240px;
    margin-bottom: 5px;
}

.slideItem img{
    margin: 0 auto 12px auto;
    margin-bottom: 12px;
}

a.moreButton, a.moreButton:visited{
    display: block;
    font-size: 20px;
    color: #444444;
    margin-bottom: 25px;
}

a.moreButton:hover, a.moreButton:focus{
    color: #2b1b4d;
}
/* END HOMEPAGE SLIDER */



/* HOMEPAGE BOTTOM BANNERS */
.homepageBottomBanners{
    margin-bottom: 40px;
}

.bottomBannerItem{
    display: block;
}
/* END HOMEPAGE BOTTOM BANNERS */


/*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
@media (max-width:1440px){

}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .bottomBannerItem{
        width: 100%;
        text-align: center;
        margin-bottom: 20px;
    }
}

/*--------------------------  XS ( max 767 ) --------------------------*/
@media (max-width:767px){
    .bannerImg{
        display: none;
    }

    .homepageItem{
        margin: 0 auto 20px auto;
        width: 100%;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    
}