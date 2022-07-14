<h3 class="doctors-title mb-3">
    <?php echo $trans->getText('Clinic Team');?>
</h3>
<div class="doctors-slider d-block">
    <?php foreach ($arr_connected_doctors as $doctor) {
        $thumb_call=$cfg["WM"]["Server"]."/webfiles/images/cache/120X150/iarX1/";
        if (!$doctor['Top_Header']) {
            $drPic = $db->getRow("SELECT wm_doctor_title.picture FROM wm_pages INNER JOIN wm_doctor_title ON wm_doctor_title.ID = wm_pages.wm_doctor_title WHERE wm_pages.ID =".$doctor['ID']);
            $doctor['Top_Header'] = 'webfiles/shebaPics/shebaMain/'.((strpos($drPic['picture'],"female")>0)?'doctor-female.jpg':'doctor-male.jpg');
        }?>
        <div>
            <a 
                class="item"
                href="<?php echo $cfg["WM"]["Server"].'/'.$doctor['ID']?>" 
                title="<?php echo str_replace('"','&quot;',$doctor['Name'])?>"
            >
                <img 
                    src="<?php echo $thumb_call.$doctor['Top_Header']?>" 
                    alt="<?php echo str_replace('"','&quot;',$doctor['Name'])?>" 
                    class="img-fluid doctorImg"
                />
                <div class="doctor-name">
                    <?php echo $doctor['Name']?>
                </div>
            </a>
        </div>
    <?php } ?>
</div>

<style>
.doctors-slider .slick-slide img{
    width:130px;
}
.doctors-slider .slick-slide{
    width: 100%;
}
.doctors-slider .slick-prev, .doctors-slider .slick-next{
    display: block;
    position: absolute;
    width: 42px;
    height: 42px;
    opacity: 1;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 80;
    padding: 0px;
}
.doctors-slider .doctors-slider{
    text-align: center;
}
.doctors-slider .doctor-name{
    color: #222222;
    text-align: center;
    font-weight: normal;
    margin-bottom: 7px;
    font-size: 15px;
}

.doctors-slider .doctor-name img{
    margin-bottom: 15px;
} 
.doctors-slider .doctor-item{
    float: left;
    margin: 0px 10px 0px 10px;
    height: 200px;
    display: block;
    text-align: center;
    border: none;
    text-decoration: none;
    border-bottom: none;
    width:auto;
    margin: 0 auto;
}

.doctors-slider .galleryArrowleft{
    left: 0px;
    -webkit-border-top-right-radius: 10px;
    -webkit-border-bottom-right-radius: 10px;
    -moz-border-radius-topright: 10px;
    -moz-border-radius-bottomright: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

.doctors-slider .galleryArrowright{
    right: 0px;
    -webkit-border-top-left-radius: 10px;
    -webkit-border-bottom-left-radius: 10px;
    -moz-border-radius-topleft: 10px;
    -moz-border-radius-bottomleft: 10px;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.doctors-slider .item{
    padding-bottom: 0px;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    border: none;
}

.doctors-slider .slick-slide{
    float: right;
}

.doctors-slider{
    /* direction: rtl; */
}
</style>

<script>
$(document).ready(function() {
    var sumItems =  $(".doctors-slider .item").length;
 
    $('.doctors-slider').slick({
      infinite: false,
      arrows: (sumItems > 4) ? true : false,
      rtl: 'rtl',
      slidesToShow: 4,
      slidesToScroll: 1,
      prevArrow:'<button type="button" class="slick-prev galleryArrow<?php echo $gui->getRight();?>"><i class="fas fa-chevron-left"></i></button>',
      nextArrow:'<button type="button" class="slick-next galleryArrow<?php echo $gui->getLeft();?>"><i class="fas fa-chevron-right"></i></button>',
      autoplay: false,
      autoplaySpeed: 10000,
      pauseOnHover: true,
      slickPause: true,
      responsive: [
          {
            breakpoint: 1920,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 1200,
            settings: {
              arrows:true,
              slidesToShow:3,
              slidesToScroll: 1,
            
            }
          },
          {
            breakpoint: 768,
            settings: {
  
              slidesToShow: 1,
              slidesToScroll: 1,
            }
          }
        ]
    }); 
      
    <?php if ($gui->getDir()=="rtl") { ?>
    // this is due to a BUG in slick carousel that when its from right to left, it doesnt trigger
    // the correct prev/next buttons
    $('.doctors-slider').slick('slickSetOption', {"speed": 0});
    setTimeout(() => {
        $('.doctors-slider').slick('slickGoTo', $(".doctors-slider .slick-slide").length - $(".slick-active").length);
    }, 600);

    setTimeout(() => {
        $('.doctors-slider').slick('slickSetOption', {"speed":300});
    }, 900);
    <?php } ?>
});
</script>