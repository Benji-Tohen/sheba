<?php

$sideItems = $wm->getChildrenOfPagetype(168);

if(!empty($sideItems['children'])){?>
    <div class="side-items-block">
        <div class="side-items-title"><?php echo $sideItems['parent']['h1'];?></div>
        
        <!-- Carousel -->
        <div class="side-items" id="side_items">
            <?php foreach ($sideItems['children'] as $sideItemKey => $sideItem) { 
                $link = $wm->getLink($sideItem);
            ?>
                <div class="side-item">
                    <a href="<?php echo $link['Link'];?>" target="<?php echo $link['Target'];?>">
                        <?php echo $sideItem['h1'];?>
                        <i class="fas fa-chevron-<?php echo $gui->getRight();?>"></i>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Button -->
    <?php if($sideItems['parent']['btn_url']){ ?>
        <a href="<?php echo $sideItems['parent']['btn_url'];?>" target="_self" class="side-items-btn"><?php echo $sideItems['parent']['btn_name'];?></a>
    <?php }?>

    <script>
        $(document).ready(function() {
            $('#side_items').slick({
                infinite: true,
                speed: 2000,
                autoplaySpeed: 0,
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                rtl: false,
                autoplay: true,
                slickPause: true,
                vertical: true,
                verticalSwiping: true,
                cssEase: 'linear',
                height: '120px',
            });
        });
    </script>
    <style>
        .side-items-block{
            display: block;
            border: 2px solid #1abc9c;
            width: 300px;
            max-width: 100%;
            margin-inline-start: auto;
            margin-bottom: 5px;
        }
        .side-items-title{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #1cc3a2;
            color: #fff;
            width: 100%;
            height: 50px;
            font-size: 26px;
        }
        .side-items{
            padding: 0 15px;
            direction: <?php echo $gui->getDir() === 'ltr' ? 'rtl' : 'ltr';?>;
        }
        .side-item{
            width: 100%;
            font-size: 18px;
            text-align-last: end;
            padding: 6px 0 6px 0;
            margin-bottom: 10px;
        }
        a.side-items-btn, a.side-items-btn:visited{
            display: block;
            width: 100%;
            background: #1ABC9C;
            color: #fff;
            font-size: 16px;
            margin-bottom: 30px;
            text-align: center;
            width: 300px;
            max-width: 100%;
            margin-inline-start: auto;
            padding: 10px 0;
            border: 2px solid #1ABC9C;
        }
        a.side-items-btn:hover, a.side-items-btn:focus{
            background: #fff;
            color: #1ABC9C;
        }
    </style>
<?php } ?>