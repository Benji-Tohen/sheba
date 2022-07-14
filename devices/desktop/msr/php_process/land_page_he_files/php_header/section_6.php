<style type="text/css">
    .sec_<?php echo $sec["ID"];?>{
        background-color: #ffffff;
    }

    .sec_<?php echo $sec["ID"];?> h2{
        text-align: center;
        color: #138770;
        margin-bottom: 15px;
    }
    
    .sec_<?php echo $sec["ID"];?> h3{
        text-align: center;
        color: #138770;
        margin-bottom: 70px;
    }
    
    .sec_<?php echo $sec["ID"];?> .grandItem{
        display: block;
        width: 300px;
        margin: 0 auto;
        border: 1px solid #e1e1e1;
        background-color: #ffffff;
        text-align: center;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }
    
    .sec_<?php echo $sec["ID"];?> .grandItem img{
        margin: 0 auto 15px auto;
        -webkit-border-top-left-radius: 10px;
        -webkit-border-top-right-radius: 10px;
        -moz-border-radius-topleft: 10px;
        -moz-border-radius-topright: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;

    }
    
    .sec_<?php echo $sec["ID"];?> .grandItem h5{
        color: #444444;
        font-weight: 400;
        margin-bottom: 5px;
        text-align: center;
        text-decoration: none;
        padding: 0 10px;
    }
    
    .sec_<?php echo $sec["ID"];?> .grandItem h6{
        font-size: 14px;
        color: #444444;
        font-weight: 400;
        margin-bottom: 15px;
        padding: 0 10px;
    }
    
    .sec_<?php echo $sec["ID"];?> .grandItem:hover, .sec_<?php echo $sec["ID"];?> .grandItem:focus, .sec_<?php echo $sec["ID"];?> .grandItem:active{
        text-decoration: none;
    }
    
    .sec_<?php echo $sec["ID"];?> .grandItem:hover h3, .sec_<?php echo $sec["ID"];?> .grandItem:focus h3, .sec_<?php echo $sec["ID"];?> .grandItem:active h3{
        color: #138770;
        text-decoration: none;
    }
    
    .sec_<?php echo $sec["ID"];?> .clickToDonate{
        font-size: 14px;
        font-weight: bold;
        color: #444444;
        background-color: #ededed;
        text-align: center;
        padding: 10px;
        -webkit-border-bottom-right-radius: 5px;
        -webkit-border-bottom-left-radius: 5px;
        -moz-border-radius-bottomright: 5px;
        -moz-border-radius-bottomleft: 5px;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .sec_<?php echo $sec["ID"];?> .itemLabel{
        display: inline-block;
        height: 42px;
        background-color: rgba(19,135,112,0.85);
        padding: 10px;
        font-size: 14px;
        font-weight: bold;
        color: #ffffff;
        -webkit-border-top-right-radius: 10px;
        -webkit-border-bottom-left-radius: 10px;
        -moz-border-radius-topright: 10px;
        -moz-border-radius-bottomleft: 10px;
        border-top-right-radius: 10px;
        border-bottom-left-radius: 10px;
        position: absolute;
        top: 0;
        <?php echo $gui->getLeft();?>: 0;
    }
    
    .grandItemWrap{
        min-height: 420px;
        height: 420px;
    }
    /*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
    @media (max-width:1440px){

    }

    /*--------------------------  MD ( max 1200 ) --------------------------*/
    @media (max-width:1200px){

    }

    /*--------------------------  SM ( max 992 ) --------------------------*/
    @media(max-width:992px){
        .sec_<?php echo $sec["ID"];?> .grandItem{
            width: auto;
        }
    }

    /*--------------------------  XS ( max 768 ) --------------------------*/
    @media (max-width:768px){
        .sec_<?php echo $sec["ID"];?> .grandItem{
            margin-bottom: 30px;
            width: 100%;
            max-width: 300px;
        }
        
        .sec_<?php echo $sec["ID"];?> h3{
            margin-bottom: 0px;
        }
        
        .sec_<?php echo $sec["ID"];?> .grandItemWrap:last-child .grandItem{
            margin-bottom: 0px;
        }
    }

    /*--------------------------  max 480 --------------------------*/
    @media (max-width:480px){

    }
</style>