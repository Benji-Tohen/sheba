<div class="home-news-carousel marginbottom">
    <div class="row">
        <div class="d-none d-lg-block col-sm-4 col-md-4 col-lg-4">
            <div class="titleLine bgcolor2"></div>
        </div>
        <div class="col-12 col-sm-4 col-md-4 col-lg-4">
            <h2>
                <?php echo $trans->getText("News");?>
            </h2>
        </div>
        <div class="d-none d-lg-block col-sm-4 col-md-4 col-lg-4">
            <div class="titleLine bgcolor2"></div>
        </div>
    </div>

    <!-- Caroufredsel -->
    <div class="row carouselWrap">
        <div class="col-12">
            <div class="news-slider marginbottom">
                <?php foreach ($arrHomeNewsRelated as $value) {
                    $date = date_create($value['Start_Date']);
                    $date =  date_format($date, 'd/m/Y');
                    if($value['Top_Header'] == ''){
                        $thumb_call='';$value['Top_Header'] = '/site/images/defaultEventPic.jpg';
                    }else{
                        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/240X160/zcX1/"; 
                    }
                    $link=$wm->getLink($value, true);
                    /*check if we have mofa date to display*/
                        $mofaDate = $db->getRow("SELECT Start_Date FROM wm_events WHERE wm_pages=".intval($value['ID']));
                        if($mofaDate['Start_Date']!=''){
                            $value['Start_Date']=$mofaDate['Start_Date'];
                        }
                    $date = date_create($value['Start_Date']);
                    $date =  date_format($date, 'd/m/Y');
                    ?>
                    <div>
                        <a 
                            href="<?php echo $link['Link']?>" 
                            title="<?php echo isset($value['Name']) ? $value['Name'] : $value['Name']?>"
                            class="item newFeedItem1"
                        >
                            <img 
                                src="<?php echo $thumb_call.$value['Top_Header']?>" 
                                alt="<?php echo isset($value['Top_Header_Alt']) ? $value['Top_Header_Alt'] : $value['Name']?>" 
                                class="newsImg1" 
                            />
                            <h4><?php echo $value['Name']?></h4>
                            <div class="newFeedItemDate"><?php echo $date?></div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div> 


<style>
    .home-news-carousel .event-item{
        height: 300px;
        display: block;
        text-align: center;
        margin: 0 5px;
    } 
    .home-news-carousel .event-item h4{
        color: #222222;
        font-size: 22px;
        text-align: <?php echo $gui->getLeft();?>;
        width: 100%;
        min-height:82px;
        margin-bottom: 10px;
    }

    .home-news-carousel .event-item:hover .home-news-carousel .event-item h4{
        color: #1ABC9C;
    }

    .home-news-carousel .newEventItemDate{
        color: #949494;
        font-size: 14px;
        text-align: <?php echo $gui->getLeft();?>;
        width: 100%;
        margin-bottom: 10px;
    }
    
    .home-news-carousel .events-slider{
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
    
    .home-news-carousel .events-slider .slick-slide{
        direction: <?php echo $gui->getDir();?>;
        float: <?php echo $gui->getLeft();?>;
    }
    .home-news-carousel .slick-slide img {
        margin-bottom: 13px;
    }
    
    .home-news-carousel .slick-track{
        display: flex;
        height: auto;
        align-items: center;
        justify-content: center;
    }
    .home-news-carousel .slick-prev,
        .home-news-carousel .slick-next{
        width: 42px;
        height: 42px;
        opacity: 1;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 80;
    }
    .home-news-carousel .slick-prev{
        padding-<?php echo $gui->getRight();?>: 9px;
        left: 0;
        -webkit-border-top-right-radius: 10px;
        -webkit-border-bottom-right-radius: 10px;
        -moz-border-radius-topright: 10px;
        -moz-border-radius-bottomright: 10px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    .home-news-carousel .slick-prev:hover,
        .home-news-carousel .slick-next:hover{
        opacity: 1;
        transition: all 0.2s ease;
    }

    .home-news-carousel .slick-prev:before{
        font-size: 80px;
    }

    .home-news-carousel .slick-next{
        padding-<?php echo $gui->getRight();?>: 16px;
        right: 0;
        -webkit-border-top-left-radius: 10px;
        -webkit-border-bottom-left-radius: 10px;
        -moz-border-radius-topleft: 10px;
        -moz-border-radius-bottomleft: 10px;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .home-news-carousel .slick-prev:before, .home-news-carousel .slick-next:before{
        color: #1ABC9C !important;
        font-size: 40px;
    }

    @media (max-width:767px){

    }
</style>


<script>
$(document).ready(function() {
    var sumItems =  $(".news-slider .item").length;

    $('.news-slider').slick({
        infinite: true,
        arrows: (sumItems >3) ? true : false,
        slidesToShow:3,
        slidesToScroll: 1,

        rtl: <?php if($gui->getDir()=="rtl") { echo "false" ;} else {echo "true";} ?>,
        prevArrow:'<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow:'<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        autoplay: true,
        autoplaySpeed: 10000,
        pauseOnHover: true,
        slickPause: true,
        responsive: [
            {

                breakpoint: 1920,
                settings: {
                slidesToShow: (sumItems < 3) ? sumItems : 3,
                infinite: true,
                slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                slidesToShow: 2,
                infinite: true,
                slidesToScroll: 1,
                arrows:true
                }
            },
            {
                breakpoint: 768,
                settings: {
                slidesToShow: 1,
                infinite: true,
                slidesToScroll: 1,
                arrows:true
                }
            }
        ]
    });
});
</script>