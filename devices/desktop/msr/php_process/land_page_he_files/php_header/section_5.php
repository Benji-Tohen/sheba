<style type="text/css">
    .sec_<?php echo $sec["ID"];?>{
        background-color: #138770;
        position: relative;
        padding-top: 55px;
        padding-bottom: 190px;
        margin-bottom: 90px;
    }

    .sec_<?php echo $sec["ID"];?> h2{
        text-align: center;
        color: #ffffff;
        margin-bottom: 15px;
    }
    .sec_<?php echo $sec["ID"];?> .grandItemWrap{
    }
    .sec_<?php echo $sec["ID"];?> h3{
        text-align: center;
        color: #ffffff;
        margin-bottom: 70px;
    }

    .sec_<?php echo $sec["ID"];?> .Link_More{
        width: 100%;
        text-align: left;
        padding-left: 10px;
        min-height: 25px;
    }

    .sec_<?php echo $sec["ID"];?> .Link_More a{
        font-size: 14px;
        color: #666666;
        text-decoration: underline;
    }

    .sec_<?php echo $sec["ID"];?> .grandItem{
        display: block;
        width: 300px;
        max-width: 100%;
        margin: 0 auto;
        border: 1px solid #e1e1e1;
        background-color: #ffffff;
        text-align: center;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        overflow: hidden;
    }

    .sec_<?php echo $sec["ID"];?> .grandItem img{
        margin: 0 auto 15px auto;
    }

    .sec_<?php echo $sec["ID"];?> .grandItem h5{
        color: #444444;
        font-weight: 400;
        margin-bottom: 5px;
        text-align: center;
        text-decoration: none;
        padding: 0 10px;
        min-height: 36px;
    }

    .sec_<?php echo $sec["ID"];?> .grandItem h6{
        font-size: 14px;
        color: #444444;
        font-weight: 400;
        margin-bottom: 15px;
        padding: 0 10px;
        min-height: 45px;
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
        text-align: <?php echo $gui->getRight();?>;
        padding: 10px;
        width: 100%;
        border: none;
        -webkit-border-bottom-right-radius: 5px;
        -webkit-border-bottom-left-radius: 5px;
        -moz-border-radius-bottomright: 5px;
        -moz-border-radius-bottomleft: 5px;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    .sec_<?php echo $sec["ID"];?> .firstItem{
        font-size: 0px;
        display: block;
        border: 1px solid #e1e1e1;
        background-color: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: stretch;
    }

    .sec_<?php echo $sec["ID"];?> .firstItemImg{
        display: flex;
    }

    .sec_<?php echo $sec["ID"];?> .firstItemContent{
        display: inline-block;
        width: 34%;
        vertical-align: top;
        font-size: 14px;
        background-color: #fff;
    }

    .sec_<?php echo $sec["ID"];?> .firstItemContent h5{
        padding: 20px 30px 10px 20px;
        overflow: hidden;
        font-size: 26px;
        flex-grow: 1;
    }

    .sec_<?php echo $sec["ID"];?> .firstItemContent h6{
        padding: 0 30px 10px 20px;
        height: 133px;
        overflow: hidden;
    }

    .sec_<?php echo $sec["ID"];?> .firstItemContent .Link_More{
        text-align: right;
        padding-right: 10px;
    }

    .sec_<?php echo $sec["ID"];?> .donateButton{
        position: absolute;
        margin: 0 auto;
        z-index: 10;
        right: 0;
        left: 0;
        bottom: -115px;
        background-color: #138770;
        color: #ffffff;
        border: 12px solid #f1f1f1;
        width: 230px;
        height: 230px;
        font-size: 40px;
        line-height: 42px;
        font-weight: normal;
        text-align: center;
        -webkit-border-radius: 500px;
        -moz-border-radius: 500px;
        border-radius: 500px;
    }

    .sec_<?php echo $sec["ID"];?> .donateButton:hover, 
    .sec_<?php echo $sec["ID"];?> .donateButton:focus, 
    .sec_<?php echo $sec["ID"];?> .donateButton:active{
        background-color: #2c353c;
        color: #F1F1F1;
        border: 12px solid #f1f1f1;
        outline: none;
    }

    /*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
    @media (max-width:1440px){

    }

    /*--------------------------  MD ( max 1200 ) --------------------------*/
    @media (max-width:1200px){
        .sec_<?php echo $sec["ID"];?> .firstItemContent h6{
            height: 80px;
        }
    }

    /*--------------------------  SM ( max 992 ) --------------------------*/
    @media(max-width:992px){
        .sec_<?php echo $sec["ID"];?> .grandItem{
            width: auto;
        }

        .sec_<?php echo $sec["ID"];?> .firstItemContent{
            width: 50%;
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

        .sec_<?php echo $sec["ID"];?> .firstItemImg{
            display: block;
            width: 100%;
            vertical-align: top;
        }
        .sec_<?php echo $sec["ID"];?> .firstItemContent{
            display: block;
            width: 100%;
        }

        .sec_<?php echo $sec["ID"];?> .firstItem{
            flex-direction: column;
        }

        .sec_<?php echo $sec["ID"];?> .clickToDonate{
            text-align: center;
        }

        .sec_<?php echo $sec["ID"];?> .firstItem{
            max-width: 300px;
            margin: 0 auto;
            margin-bottom: 15px;
        }

        .sec_<?php echo $sec["ID"];?> .grandItemWrap{
            margin-bottom: 45px;
        }

        .sec_<?php echo $sec["ID"];?> .firstItemContent h6{
            height: auto;
        }
    }

    /*--------------------------  max 480 --------------------------*/
    @media (max-width:480px){

    }
</style>