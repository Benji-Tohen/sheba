<?php include_once($device.'/php_components/dynamic_form/form_css.php');?>

body {
    background: <?php echo $wmPage['bg_color'] ? $wmPage['bg_color'] : '#ffffff';?> url(<?php echo $cfg["WM"]["Server"].'/'.$thumb_inner_img.$wmPage["bg_image"];?>) no-repeat fixed center;
    background-size: cover;
}   

.innerImg{
    margin: 0 auto 20px auto;
}

.content{
    color: #212529;
    font-size: 18px;
    font-weight: 400;
    font-style: normal;
    line-height: 25px;
    margin-bottom: 20px;
}

h1, h2{
    color: #171f73;
}

.text-center{
    text-align: center;
}

.divider-line{
    width: 100%;
    height: 1px;
    background-color: #f2f2f2;
    margin: 25px 0;
}

/* Slick */
a.slickItem:hover{
    text-decoration: none;
}

.slick-slide .overlay img{
    width: inherit;
    display: inline;
}

.slick-slide img {
    margin-bottom: 13px;
}

.slickItem h4{
    color: #222222;
    text-align: <?php echo $gui->getLeft();?>;
    margin: 0 auto;
    margin-bottom: 2px;
}

.slick-prev,
    .slick-next{
    width: 42px;
    height: 42px;
    opacity: 1;
    top: 50%;
    transform: translateY(calc(50% - 58px));
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 80;
    font-size:20px;
}
.slick-prev{
    padding-<?php echo $gui->getRight();?>: 9px;
    left: 0;
    -webkit-border-top-right-radius: 10px;
    -webkit-border-bottom-right-radius: 10px;
    -moz-border-radius-topright: 10px;
    -moz-border-radius-bottomright: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}
.slick-prev:hover,
    .slick-next:hover{
    opacity: 1;
    transition: all 0.2s ease;
}

.slick-prev:before{
    font-size: 80px;
}

.slick-next{
    padding-<?php echo $gui->getRight();?>: 16px;
    right: 0;
    -webkit-border-top-left-radius: 10px;
    -webkit-border-bottom-left-radius: 10px;
    -moz-border-radius-topleft: 10px;
    -moz-border-radius-bottomleft: 10px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.slick-prev:before, .slick-next:before{
    color: #1ABC9C !important;
    font-size: 40px;
}

.slickItem {
    padding-bottom: 0px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    border: none;
}

.slickItem:hover h4, .slickItem:focus h4{
    color: #1ABC9C;
}

/* Slick fields-of-activity-carousel  */
.fields-of-activity-carousel{
    direction: <?php echo $gui->getDir();?>;
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
    margin-bottom: 20px;
}
.fields-of-activity-carousel .slick-slide{
    direction: <?php echo $gui->getDir();?>;
    float: <?php echo $gui->getLeft();?>;
}
.fields-of-activity-carousel .slickItem{
    max-width: 240px;
}


/* Slick doctors */
.doctors-slider{
    direction: <?php echo $gui->getDir();?>;
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
    margin-bottom: 20px;
}
.doctors-slider .slick-slide{
    direction: <?php echo $gui->getDir();?>;
    float: <?php echo $gui->getLeft();?>;
}
.doctor-item{
    border-radius: 50%;
    width: 165px;
}
.doctor-item h4{
    text-align: center;
}

/* Tests */
.feed-item{
    margin-bottom: 30px;
}

.feed-item img{
    margin-inline-end: 30px;
    max-width: 240px;
    align-self: flex-start;
}

.feed-item h4{
    color: #525252;
    font-size: 22px;
    font-weight: 400;
    margin-bottom: 4px;
}

.feed-item:hover h4{
    color: #1ABC9C;
}
.feed-item.nolink:hover h4{
    color: #525252;
}
.feed-item-subtitle{
    color: #212529;
    font-size: 18px;
    font-weight: 300;
    line-height: 25px;
}

/* clinical_studies */
.item-arrow{
    margin-inline-end: 30px;
    font-size: 24px;
}

.clinical-studies .feed-item{
    margin: 0px;
    padding: 20px 0;
    border-bottom: 1px solid #c6cccb;
}


/* Gallery */
.row_slick_gallery .slick-dots{
    position: absolute;
    list-style: none;
    display: block;
    text-align: center;
    width: 100%;
    margin: 0 0 0 0;
    top: 15px;
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
.row_slick_gallery video{
    width: 100%;
}

/* Contect block */
.contact-block{
    width: 100%;
    background-color: #f9f9f9;
    padding: 20px;
    text-align: <?php echo $gui->getLeft();?>;
    margin-bottom: 15px;
    margin-inline-start: auto;
}
.contact-title{
    color: #171f73;
    font-size: 30px;
    font-weight: 400;
}
.contact-content{
    font-size: 18px;
    color: #212529;
    padding: 10px 0;
}
a.contact-btn{
    display: block;
    width: 100%;
    padding: 8px;
    background-color: #000756;
    border: 1px solid #000756;
    color: #fff;
    text-align: center;
    font-size: 18px;
    margin: 10px auto;
}
a.contact-btn:hover, a.contact-btn:focus{
    background-color: #fff;
    color: #000756;
}
.contact-link{
    color: #0fbf9e;
    font-size: 18px;
    font-weight: 400;
    line-height: 25px;
}

/* stories */
.stories-title{
    color: #eb3d85;
    text-align: <?php echo $gui->getLeft();?>;
}
.stories{
    text-align: <?php echo $gui->getLeft();?>;
}
.stories .feed-item img{
    border-radius: 50%;
    width: 164px;
    margin: 0 auto 10px auto;
}
.stories .feed-item{
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 30px;
    border-bottom: 1px solid #f2f2f2;
}
.stories .feed-item h4{
    font-size: 18px;
}
.stories .feed-item .feed-item-subtitle{
    font-weight: 300;
}

/* medical_zone_more */
.medical-zone-more{
    text-align: <?php echo $gui->getLeft();?>;
    margin-bottom: 30px;
}
.medical-zone-more .feed-item{
    margin: 0px;
    padding: 5px 0;
}
.medical-zone-more .feed-item h4{
    font-size: 18px;
    font-weight: 300;
}

/* Glossary of Terms */
.got-block{
    font-size: 18px;
    font-weight: 300;
    color: #212529;
    text-align: <?php echo $gui->getLeft();?>;
}

/* Q&A */
.qna-block{
    font-size: 18px;
    font-weight: 300;
    color: #212529;
    text-align: <?php echo $gui->getLeft();?>;
}

.side-block{
    width: 300px;
    max-width: 100%;
    margin-inline-start: auto;
}

.breadCrumbs{
    display: none;
}
.countdownWrapper {
    width:260px;
    height: 260px;
    background: url('/webfiles/images/countdown-bg.png');
    background-size:contain;
    display:flex !important;
    justify-content:center;
    align-items:center;
    margin:auto;
}
#countdown, #countdownm {
    text-align:center;
    color: #fff;
    font-size: 38px;
    text-shadow: 1px 1px 3px #000;
    margin-right: 10px;
}
/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .feed-item{
        border-bottom: 1px solid #c6cccb;
        padding-bottom: 20px;
    }
    .feed-item img{
        max-width: 100%;
        margin: 0 auto 10px auto;
    }

    .fields-of-activity-carousel .slickItem{
        max-width: 100%;
    }

    .row_slick_gallery .slick-dots{
        position: relative;
        align-items: center;
        margin: 0;
        top:0;
    }

    .side-block{
        width: 100%;
        margin-inline-start: none;
    }
}

/*--------------------------  XS ( max 767 ) --------------------------*/
@media (max-width:767px){

}

/* */