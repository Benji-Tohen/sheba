<div class="container">
    <div class="row top-header">
        <div class="col">
            <div class="d-flex w-100 justify-content-end">
                <div class="d-flex justify-content-between ">
                    <!-- HEADER SEARCH -->
                    <div><?php include('header_search.php');?></div>
                    <!-- LANGUAGE MENU -->
                    <div class="language_menu d-flex"><?php include('language_menu.php');?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="first-row w-100 d-flex justify-content-between align-items-end">
                <div class="header-logo align-self-end ">
                    <!-- HEADER LOGO -->
                    <?php include('header_logo.php');?>
                </div>
                <!-- HEADER ICONS -->
                <div class="mt-5"><?php include('header_icons.php');?></div>
            </div>
        </div>
    </div>
    <div class="row header-menu">
        <div class="col">
            <div class="w-100">
                <!-- MEGA MENU -->
                <?php /* if it's the preview form page don't load the mega menu*/
                    if(!((isset($getParams[1]) && $getParams[1]=="1000") && $wmPage["Page_Type"]==6)){ 
                        include_once('mega_menu.php');
                    }
                ?>
            </div>
        </div>
    </div>
</div>