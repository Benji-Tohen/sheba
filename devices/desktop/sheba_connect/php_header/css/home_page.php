h1{
    font-size: 38px;
    font-weight: 400;
    color: #0a0558;
    margin-bottom: 30px;
}

h2{
    font-size: 38px;
    font-weight: 400;
    color: #0a0558;
    text-align: center;
    margin-bottom: 60px;
}

.sepLine{
    width: 100%;
    height: 3px;
    background-color: #f1f1f1;
    margin-bottom: 35px;
}

.bannerItem{
    height: 28vw;
    margin-bottom: 50px;
}

.homepageBanners{
    position: relative;
    height: 28vw;
}

.home-subtitle{
    font-size: 33px;
    font-weight: 400;
    color: #0a0558;
    text-align: center;
    margin-bottom: 60px;
}

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
    top: 30px;
    font-size: 65px;
    width: 46px;
    height: 50px;
    padding: 0;
    margin: 0;
    line-height: 40px;
    background: none;
    color: #b7b8bb;
    z-index: 90;
    outline: none;
    -o-transition:        background-color 0.3s ease, color 0.3s ease;
    -ms-transition:       background-color 0.3s ease, color 0.3s ease;
    -moz-transition:      background-color 0.3s ease, color 0.3s ease;
    -webkit-transition:   background-color 0.3s ease, color 0.3s ease;
    transition:           background-color 0.3s ease, color 0.3s ease;
}

.homepageSlider .slick-arrow i{
    line-height: 40px;
}

.homepageSlider .slick-arrow:hover, .homepageSlider .slick-arrow:focus{

}

.homepageSlider .slick-next{
    <?php echo $gui->getLeft();?>: -10px;
}

.homepageSlider .slick-prev{
    <?php echo $gui->getRight();?>: -10px;
}

.homepageSlider .slideName{
    font-size: 17px;
    font-weight: bold;
    color: #444444;
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
    margin: 0 auto;
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


.bannerSection{
    background: #eff6f8;
    padding: 26px 0;
    margin-top: 50px;
}


.sepLineSection.greenLine{
    margin-top: 50px;
    margin-bottom: 50px;
}

a.homepageItemsBtn{
    width: 100%;
    background-color: #2f333e;
    color: #fff;
    display: block;
    margin-left: auto;
    margin-right: auto;
    font-size: 28px;
    color: #fff;
    text-align: center;
    background-position: center;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
}

a.homepageItemsBtn:before{
    content: ' ';
    padding-top: 53.4%;
}

a.homepageItemsBtnBig{
    width: 100%;
    background-color: #2f333e;
    color: #fff;
    display: block;
    font-size: 28px;
    color: #fff;
    text-align: center;
    margin-bottom: 10px;
    background-position: center;
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
}

a.homepageItemsBtnBig:before{
    content: ' ';
    padding-top: 36.2%;
}

a.homepageVideoDesc, a.homepageVideoDesc:visited, .homepageVideoDesc{
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #ff0079;
    width: 100%;
    text-align: center;
    color: #fff;
    font-size: 27px;
    height: 60px;
    color: #fff;
}

.bannerSection iframe{
    margin-bottom: -4px;
}

.homepageVideo{
    max-width: 100%;
}

/*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
@media (max-width:1440px){

}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    .homepageVideoDesc{
        margin-bottom: 10px;
        font-size: 18px;
    }
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .bottomBannerItem{
        width: 100%;
        text-align: center;
        margin-bottom: 20px;
    }

    .homepageItemsBtn{
        margin-bottom: 10px;
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