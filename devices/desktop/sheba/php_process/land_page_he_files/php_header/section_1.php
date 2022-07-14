<!-- JQuery -->
<?php /*
<script src="<?php echo $filepath."/jquery/";?>jquery.min.js"></script>
<script src="<?php echo $filepath."/jquery/";?>jquery-ui.min.js"></script>
*/ ?>
<!-- jQuery v3.5.1 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/jquery/";?>jquery.min.js"></script>
<!--  JQuery-UI-1.12.1 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/jquery-ui/";?>jquery-ui.min.js"></script>
<!-- END JQuery -->

<!-- Bootstrap-4.5.3 -->
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/bootstrap/";?>js/bootstrap.min.js"></script> 
<link href="<?php echo $cfg["WM"]["Server"]."/".$device."/libraries/bootstrap/";?>css/bootstrap.min.css" rel="stylesheet" />

<?php /*
<link href="<?php echo $filepath."/bootstrap/";?>css/bootstrap.<?php echo $gui->getDir();?>.min.css" rel="stylesheet" />
<script src="<?php echo $filepath."/bootstrap/";?>js/bootstrap.min.js"></script>
*/ ?>
<!-- END Bootstrap -->

<!-- Validate Email -->
<script src="<?php echo $filepath."/js/checkMail.js";?>"></script>
<!-- END Validate Email -->

<!-- iCheck -->
<link rel="stylesheet" href="<?php echo $filepath."/icheck/css/skins/flat/green.css";?>" type="text/css" property="stylesheet" />
<script type="text/javascript" src="<?php echo $filepath."/icheck/js/icheck.min.js";?>"></script>
<!-- END iCheck -->

<!-- FAVICONS -->
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $filepath;?>/favicomatic/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $filepath;?>/favicomatic/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $filepath;?>/favicomatic/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $filepath;?>/favicomatic/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo $filepath;?>/favicomatic/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo $filepath;?>/favicomatic/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo $filepath;?>/favicomatic/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $filepath;?>/favicomatic/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="<?php echo $filepath;?>/favicomatic/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="<?php echo $filepath;?>/favicomatic/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="<?php echo $filepath;?>/favicomatic/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo $filepath;?>/favicomatic/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="<?php echo $filepath;?>/favicomatic/favicon-128.png" sizes="128x128" />
<link rel="shortcut icon" href="<?php echo $filepath;?>/favicomatic/favicon.ico" type="image/x-icon" />
<!-- END FAVICONS -->

<style type="text/css">
    /* FONTS */
    /* Open Sans Hebrew */
    @font-face {
        font-family: 'Open Sans Hebrew';
        font-style: italic;
        font-weight: 300;
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-lightitalic-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-lightitalic-webfont.eot?#iefix') format('embedded-opentype'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-lightitalic-webfont.woff') format('woff'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-lightitalic-webfont.ttf') format('truetype');
    }
    @font-face {
        font-family: 'Open Sans Hebrew';
        font-style: normal;
        font-weight: 300;
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-light-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-light-webfont.eot?#iefix') format('embedded-opentype'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-light-webfont.woff') format('woff'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-light-webfont.ttf') format('truetype');
    }
    @font-face {
        font-family: 'Open Sans Hebrew';
        font-style: italic;
        font-weight: 400;
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-italic-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-italic-webfont.eot?#iefix') format('embedded-opentype'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-italic-webfont.woff') format('woff'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-italic-webfont.ttf') format('truetype');
    }

    @font-face {
        font-family: 'Open Sans Hebrew';
        font-style: normal;
        font-weight: 400;
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-regular-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-regular-webfont.eot?#iefix') format('embedded-opentype'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-regular-webfont.woff') format('woff'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-regular-webfont.ttf') format('truetype');
    }

    @font-face {
        font-family: 'Open Sans Hebrew';
        font-style: italic;
        font-weight: 700;
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/OpenSansHebrew-BoldItalic.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/OpenSansHebrew-BoldItalic.eot?#iefix') format('embedded-opentype'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/OpenSansHebrew-BoldItalic.woff') format('woff'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/OpenSansHebrew-BoldItalic.ttf') format('truetype');
    }

    @font-face {
        font-family: 'Open Sans Hebrew';
        font-style: normal;
        font-weight: 700;
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-bold-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/opensanshebrew-bold-webfont.eot?#iefix') format('embedded-opentype'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-bold-webfont.woff') format('woff'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-bold-webfont.ttf') format('truetype');
    }

    @font-face {
        font-family: 'Open Sans Hebrew';
        font-style: italic;
        font-weight: 800;
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-extrabolditalic-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-extrabolditalic-webfont.eot?#iefix') format('embedded-opentype'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-extrabolditalic-webfont.woff') format('woff'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-extrabolditalic-webfont.ttf') format('truetype');
    }
    @font-face {
        font-family: 'Open Sans Hebrew';
        font-style: normal;
        font-weight: 800;
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-extrabold-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-extrabold-webfont.eot?#iefix') format('embedded-opentype'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-extrabold-webfont.woff') format('woff'),
        url('<?php echo $filepath."/";?>fonts/openSans/he/opensanshebrew-extrabold-webfont.ttf') format('truetype');
    }


    /* Open Sans English */
    @font-face {
        font-family: 'Open Sans';
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Light-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Light-webfont.eot?#iefix') format('embedded-opentype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Light-webfont.woff') format('woff'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Light-webfont.ttf') format('truetype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Light-webfont.svg#open_sanslight') format('svg');
        font-weight: 300;
        font-style: normal;
    }

    @font-face {
        font-family: 'Open Sans';
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Regular-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Regular-webfont.eot?#iefix') format('embedded-opentype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Regular-webfont.woff') format('woff'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Regular-webfont.ttf') format('truetype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Regular-webfont.svg#open_sansregular') format('svg');
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: 'Open Sans';
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Bold-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Bold-webfont.eot?#iefix') format('embedded-opentype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Bold-webfont.woff') format('woff'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Bold-webfont.ttf') format('truetype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Bold-webfont.svg#open_sansbold') format('svg');
        font-weight: 700;
        font-style: normal;
    }

    @font-face {
        font-family: 'Open Sans';
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-ExtraBold-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-ExtraBold-webfont.eot?#iefix') format('embedded-opentype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-ExtraBold-webfont.woff') format('woff'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-ExtraBold-webfont.ttf') format('truetype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-ExtraBold-webfont.svg#open_sansextrabold') format('svg');
        font-weight: 800;
        font-style: normal;
    }

    @font-face {
        font-family: 'Open Sans';
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Italic-webfont.eot');
        src: url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Italic-webfont.eot?#iefix') format('embedded-opentype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Italic-webfont.woff') format('woff'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Italic-webfont.ttf') format('truetype'),
             url('<?php echo $filepath."/";?>fonts/openSans/OpenSans-Italic-webfont.svg#open_sansitalic') format('svg');
        font-weight: 400;
        font-style: italic;
    }
    /* END FONTS */
    
    html, body{
        font-family:'Open Sans', 'Open Sans Hebrew';
        font-weight: normal;
        font-size: 12px;
        margin: 0px;
        overflow-x: hidden;
        text-align: right;
    }
    
    .container{
        direction: <?php echo $gui->getDir();?>;
    }
    
    h1, h2, h3, h4, h5, h6{
        margin: 0px;
        padding: 0px;
    }

    .clear{
        clear: both;
    }

    .noPadding{
        padding: 0px;
    }

    .noMargin{
        margin: 0;
    }
    
    .ts{
        -o-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    
    h1{
        font-size: 44px;
    }

    h2{
        font-size: 44px;
        font-weight: 400;
    }

    h3{
        font-size: 24px;
        font-weight: 300;
    }

    h4{
        font-size: 22px;
        font-weight: 300;
    }

    h5{
        font-size: 20px;
        font-weight: 300;
    }

    h6{
        font-size: 16px;
        font-weight: 300;
    }
    
    
    /* VERTICAL PADDINGS */
    .marg0{
        margin-top:0px;
        margin-bottom:0px;
    }

    .marg1{
        margin-top:55px;
        margin-bottom:55px;
    }
    .marg1_t{
        margin-top:55px;
        margin-bottom:0px;
    }
    .marg1_b{
        margin-top:0px;
        margin-bottom:55px;
    }

    .marg2{
        margin-top:35px;
        margin-bottom:35px;
    }
    .marg2_t{
        margin-top:35px;
        margin-bottom:0px;
    }
    .marg2_b{
        margin-top:0px;
        margin-bottom:35px;
    }


    .marg3{
        margin-top:15px;
        margin-bottom:15px;
    }
    .marg3_t{
        margin-top:15px;
        margin-bottom:0px;
    }
    .marg3_b{
        margin-top:0px;
        margin-bottom:15px;
    }


    .pad0{
        padding-top:0px;
        padding-bottom:0px;
    }

    .pad1{
        padding-top:55px;
        padding-bottom:55px;
    }
    .pad1_t{
        padding-top:55px;
        padding-bottom:0px;
    }
    .pad1_b{
        padding-top:0px;
        padding-bottom:55px;
    }

    .pad2{
        padding-top:35px;
        padding-bottom:35px;
    }
    .pad2_t{
        padding-top:35px;
        padding-bottom:0px;
    }
    .pad2_b{
        padding-top:0px;
        padding-bottom:35px;
    }


    .pad3{
        padding-top:15px;
        padding-bottom:15px;
    }
    .pad3_t{
        padding-top:15px;
        padding-bottom:0px;
    }
    .pad3_b{
        padding-top:0px;
        padding-bottom:15px;
    }
    /* END VERTICAL PADDINGS */
    
    
    .anchorOffset{
      
    }
    
    .marginSection{
        
    }
    
    /* Responsive Video Embed */
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        padding-top: 30px; height: 0; overflow: hidden;
    }

    .video-container iframe,
    .video-container object,
    .video-container embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .videoDescription{
        background-color: #1B1B1B;
        padding: 10px;
        font-size: 14px;
        color: #FFF;
        border-top: 1px solid #474747;
    }
    /* END Responsive Video Embed */
    
    .topMenu{
        margin-bottom: 0px;
        background-color: #ffffff;
        border: 0;
        border-radius: 0;
        height: 177px;
    }

    .topMenu .menuItems{
        margin-top: 131px;
    }

    .topMenu .navbar-nav > li > a{
        font-size: 16px;
        padding-top: 0;
        padding-bottom: 20px;
        color: #000;
        -o-transition: all 0.2s ease;
        -ms-transition: all 0.2s ease;
        -moz-transition: all 0.2s ease;
        -webkit-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    .topMenu .navbar-nav > li > a:hover, .topMenu .navbar-nav > li > a:focus{
        background-color:transparent;
        color:  #138770;
        border-bottom: 6px solid #138770;
    }

    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus{
        background-color:transparent;
        color:#fff;
        font-weight:bold;
    }

    .topMenu .navbar-nav{
        position: relative;
    }
    .navbar-right{
      margin-right: 0px;
    }
    .navbar-left{
      margin-left: 0px;
    }
    .topMenu .submenu{
        padding: 0px;
        margin: 0px;
        min-width: 190px;
        position: absolute;
        background-color: #fff;
        top: 48px;
        z-index: 11;
        height: auto;
        box-shadow: 5px 5px 15px -5px #333;
        -moz-box-shadow: 5px 5px 15px -5px #333;
        -webkit-box-shadow: 5px 5px 15px -5px #333;
        width: 100%;
        display: none;
    }

    .submenu li {
        list-style: none;
    }

    .topMenu .submenu li a{
        color: #000;
        display: block;
        padding: 9px 20px;
        border-bottom: 1px solid #BBB;
        font-size: 14px;
        -webkit-transition: all 100ms ease-in;
        -o-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
    }

    .topMenu .submenu li:hover a{
        color: #fff;
        background-color: #000;
        text-decoration: none;
    }

    .topMenu .navbar-brand{
        height: auto;
        float: <?php echo $gui->getRight();?>;
    }

    .topMenu .navbar-brand img{
        max-height: 140px;
    }

    .topMenu .websiteLogo a:hover, .topMenu .websiteLogo a:focus{
        background: none !important;
    }

    .topMenu li.websiteLogo a{
        padding: 0;
    }

    .topMenu li.websiteLogo a:hover, .topMenu li.websiteLogo a:focus, .topMenu li.websiteLogo a:focus{
        border: none;
    }

    .topMenu .websiteLogo img{
        max-height: 105px;
        margin-top: 50px;
    }

    .navbar-toggle{
        background-color: rgb(51, 47, 96);
        border: none;
        display: none;
    }

    .navbar-default .navbar-toggle .icon-bar{
        background-color: #FFF;
    }

    .navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus{
        background-color: #138770;
    }

    .topMenu .topMenuLink{
        display: block;
    }
    
    .lpButton, .lpButton:visited{
        display: inline-block;
        max-width: 100%;
        width: 100%;
        height: 48px;
        padding: 0px 56px;
        color: #ffffff;
        font-size: 18px;
        font-weight: block;
        text-align: center;
        vertical-align: middle;
        background-color: #138770;
        border: 3px solid #f3f3f3;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
        border-radius: 8px;
    }

    .lpButton:hover, .lpButton:active, .lpButton:focus{
        background-color: #fff;
        color: #138770;
    }

    .inputErrText{
        font-weight: bold;
        color: red;
        font-size: 16px;
        margin-top: 5px;
    }

    
    /*--------------------------  Laptops ( max 1400 ) --------------------------*/
    @media (max-width:1400px){

    }

    /*--------------------------  MD ( max 1200 ) --------------------------*/
    @media (max-width:1200px){
        .navbar-nav > li > a{
            padding: 10px;
        }

        .websiteLogo a{
            padding: 0px;
        }

        .topMenu .menuItems{
            margin-top: 60px;
        }
    }

    /*--------------------------  SM ( max 992 ) --------------------------*/
    @media(max-width:992px){
        .topMenu{
            height: 70px;
        }
        
        .topMenu .menuItems{
            margin-top: 24px;
        }

        .topMenu{
            padding-bottom: 10px;
        }

        .topMenu .navbar-brand{
            padding: 0px;
            height: 40px;
        }

        .topMenu .navbar-brand img{
            /* max-height: 90px; */
        }
        
        /*
        ul.navbar-<?php echo $gui->getLeft();?>{
            float: <?php echo $gui->getRight();?> !important;
        }
        */
        
        .topMenu .websiteLogo img{
            max-height: 64px;
            margin-top: 3px;
        }
    }

    /*--------------------------  XS ( max 768 ) --------------------------*/
    @media (max-width:768px){
        
        h1{
            font-size: 32px;
        }

        h2{
            font-size: 32px;
            font-weight: 300;
        }

        h3{
            font-size: 20px;
            font-weight: 300;
        }

        h4{
            font-size: 22px;
            font-weight: 300;
        }

        h5{
            font-size: 20px;
            font-weight: 300;
        }

        h6{
            font-size: 16px;
            font-weight: 300;
        }
        
        
        /* VERTICAL PADDINGS */
        .marg0{
            margin-top:0px;
            margin-bottom:0px;
        }

        .marg1{
            margin-top:30px;
            margin-bottom:30px;
        }
        .marg1_t{
            margin-top:30px;
            margin-bottom:0px;
        }
        .marg1_b{
            margin-top:0px;
            margin-bottom:30px;
        }

        .marg2{
            margin-top:20px;
            margin-bottom:20px;
        }
        .marg2_t{
            margin-top:20px;
            margin-bottom:0px;
        }
        .marg2_b{
            margin-top:0px;
            margin-bottom:20px;
        }


        .marg3{
            margin-top:15px;
            margin-bottom:15px;
        }
        .marg3_t{
            margin-top:15px;
            margin-bottom:0px;
        }
        .marg3_b{
            margin-top:0px;
            margin-bottom:15px;
        }


        .pad0{
            padding-top:0px;
            padding-bottom:0px;
        }

        .pad1{
            padding-top:30px;
            padding-bottom:30px;
        }
        .pad1_t{
            padding-top:30px;
            padding-bottom:0px;
        }
        .pad1_b{
            padding-top:0px;
            padding-bottom:30px;
        }

        .pad2{
            padding-top:20px;
            padding-bottom:20px;
        }
        .pad2_t{
            padding-top:20px;
            padding-bottom:0px;
        }
        .pad2_b{
            padding-top:0px;
            padding-bottom:20px;
        }


        .pad3{
            padding-top:15px;
            padding-bottom:15px;
        }
        .pad3_t{
            padding-top:15px;
            padding-bottom:0px;
        }
        .pad3_b{
            padding-top:0px;
            padding-bottom:15px;
        }
        /* END VERTICAL PADDINGS */
        
        
        .panel-default > .panel-heading{
            background-color: inherit;
            border-bottom: 1px solid #7A5A51;
        }

        .panel-default:last-child > .panel-heading{
            border: none;
        }

        .topMenu{
            padding-bottom: 10px;
            padding-top: 0px;
        }

        .topMenu .navbar-brand{
            padding-bottom: 0px;
            float: right;
        }


        /* mobile menu */
        .navbar-fixed-top .navbar-collapse, .navbar-fixed-bottom .navbar-collapse{
            max-height:auto;
            /* background-color: rgb(75, 48, 40); */
        }

          .panel-group {
            margin-bottom: 0px;
          }

            #top_menu_mobile{
                margin: 0 -15px;
            }
          #top_menu_mobile .panel-heading {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            color:#333;
            font-size:22px;
          } 
          #top_menu_mobile .panel-title > li{    
            padding:10px 15px;
          }
          #top_menu_mobile .submenuArrow{
            float:<?php echo $gui->getRight(); ?>;
          }

          #top_menu_mobile .submenuArrow:after{  
          /*  
            font-family: 'Glyphicons Halflings';
            content: "\e259";
            */
          }
          #top_menu_mobile .submenuArrow span{
            font-size:20px;
            color:white;
          }
          #top_menu_mobile .panel-body{
              width: 100%;
              padding:0px 0;
          }


          #top_menu_mobile .panel-group .panel + .panel {
            margin-top: 0px;
          }
          #top_menu_mobile .panel-group .panel {
            border-radius: 0px;
          }
          #top_menu_mobile .panel-default {
            border:none;
          }

          #top_menu_mobile .panel-title > a {
            color: #000;
            font-size:20px;
            text-align: center;
          }
          #top_menu_mobile .panel-title > a:hover,#top_menu_mobile .panel-title > a:active,#top_menu_mobile .panel-title > a:focus {
            text-decoration: none;
            }
          #top_menu_mobile   .panel {
            margin: 0;
              background-color: inherit;
              border: none;
              -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
              box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
          }
          #top_menu_mobile ul{
            list-style-type: none;
            height:auto;
            width: 100%;
            padding: 0;
          }
          #top_menu_mobile li{
            height:30px;
            width: 100%;
            padding: 18px 0;
          }
          #top_menu_mobile  li a{
            height:100%;
            line-height:100%;
            font-size:18px;
            color:#333;
            padding: 10px 20px;
            vertical-align: middle;
          }
        /* end mobile menu */

        #top_menu_mobile .panel:hover, #top_menu_mobile .panel:active, #top_menu_mobile .panel:focus{
            background-color: #138770;
        }

        .topMenu .navbar-brand img{
            max-height: 70px;
            margin-top: 12px;
            margin-<?php echo $gui->getLeft();?>: 11px;
            margin-bottom: 11px;
        }
        
        .topMenu{
            height: auto;
            padding-bottom: 46px;
            padding-top: 0px;
        }
    }

    /*--------------------------  max 480 --------------------------*/
    @media (max-width:480px){

    }
</style>



<script type="text/javascript">
    $(document).ready(function() {
       
        $(".menuItem").hover(function(){ 
            if($(this).find("ul").hasClass("open")){
                $(this).find("ul").fadeOut("fast");
                $(this).find("ul").removeClass("open");
            }else{
                $(this).find("ul").fadeIn("fast");
                $(this).find("ul").addClass("open");
            }
        });
        
        /* iCheck */
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        /* END iCheck */
        
        
        /* Replace all SVG images with inline SVG */
        jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

            jQuery.get(imgURL, function(data) {
                /* Get the SVG tag, ignore the rest */
                var $svg = jQuery(data).find('svg');

                /* Add replaced image's ID to the new SVG */
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                /* Add replaced image's classes to the new SVG */
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }

                /* Remove any invalid XML tags */
                $svg = $svg.removeAttr('xmlns:a');

                /* Replace image with new SVG */
                $img.replaceWith($svg);

            }, 'xml');
        });
    
        /* Smooth Scroll And Offset */
        $(function() {
          $('a[href*=#]:not([href=#])').click(function() {
            if(this.hash.slice(1)=='60152'){
               $('html, body').animate({
                    scrollTop: $("#formAnchor").offset().top - 400
                }, 800);
           }else  if(this.hash.slice(1)=='60153'){
                $('html, body').animate({
                    scrollTop: $("#formAnchor").offset().top
                }, 800);
                $("#openForm").addClass(" in");
           }
            else{
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                  var target = $(this.hash);
                  top_offset = $('.marginSection').height();
                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                  if (target.length) {
                    $('html,body').animate({
                      scrollTop: target.offset().top - top_offset
                    }, 400);
                    return false;
                  }
                }
            }
          });
        });
        
        /* Scroll To Answer Text */
        var field = 'POST';
        var url = window.location.href;
        if(url.indexOf('?' + field) != -1){
        location.hash = "#goBackAnswer"; 
        }
        /* END Scroll To Answer Text */
    });

</script>