<style type="text/css">
    .sec_<?php echo $sec["ID"];?>{
        padding: 140px 0 40px 0;
        position: relative;
        background-color: #f1f1f1;
    }
    
    .sec_<?php echo $sec["ID"];?> .hiddenLabel{
        visibility: hidden;
        display: none;
    }

    .sec_<?php echo $sec["ID"];?> .richtext{
        color: #148b74;
        font-size: 24px;
        font-weight: 300;
        text-align: center;
    }

    .sec_<?php echo $sec["ID"];?> .sectionTitle{
        text-align: center;
    }

    .sec_<?php echo $sec["ID"];?> .sectionContent{
        margin-bottom: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .sectionContentCenter{
        margin-bottom: 40px;
    }

    .sec_<?php echo $sec["ID"];?> .formArea label.outsideInputTitle{
        color: #148b74;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea .formInput{
        width: 100%;
        height: 48px;
        border: 1px solid #d2d2d2;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        color: #148b74;
        font-size: 18px;
        font-weight: normal;
        padding-<?php echo $gui->getLeft();?>: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .formArea input::-webkit-input-placeholder {
        color: #c9c9c9;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea input:-moz-placeholder { /* Firefox 18- */
       color: #c9c9c9;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea input::-moz-placeholder {  /* Firefox 19+ */
       color: #c9c9c9;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea input:-ms-input-placeholder {  
       color: #c9c9c9;
        font-size: 18px;
        font-weight: normal;
    }

    .sec_<?php echo $sec["ID"];?> .formArea .form-control{
        width: 100%;
        height: 48px;
        border: 1px solid #d2d2d2;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        color: #148b74;
        font-size: 18px;
        font-weight: normal;
        padding-<?php echo $gui->getLeft();?>: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .formArea .rowMargin{
        margin-bottom: 20px;
    }

    .sec_<?php echo $sec["ID"];?> .formArea .checkboxText{
        color: #148b74;
        font-size: 18px;
        font-weight: 300;
        margin-<?php echo $gui->getLeft();?>: 10px;
        vertical-align: -3px;
    }

    .sec_<?php echo $sec["ID"];?> .donateButton{
        position: absolute;
        margin: 0 auto;
        z-index: 10;
        right: 0;
        left: 0;
        top: -115px;
        background-color: #18a98d;
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

    .sec_<?php echo $sec["ID"];?> .donateButton:hover, .sec_<?php echo $sec["ID"];?> .donateButton:focus, .sec_<?php echo $sec["ID"];?> .donateButton:active{
        background-color: #2c353c;
        color: #F1F1F1;
        border: 12px solid #f1f1f1;
    }
    
    .sec_<?php echo $sec["ID"];?> .thankYou{
        text-align: center;
    }
    
    .sec_<?php echo $sec["ID"];?> .thankYou img{
        margin-bottom: 20px;
    }
    
    .sec_<?php echo $sec["ID"];?> .thankYou h2{
        margin-bottom: 20px;
        color: #18a98d;
        font-size: 36px;
        font-weight: bold;
    }
    
    .sec_<?php echo $sec["ID"];?> .answerText{
        font-size: 24px;
        color: #666666;
    }
    
    .sec_<?php echo $sec["ID"];?> .errorMassege{
        text-align: center;
    }
    
    .sec_<?php echo $sec["ID"];?> .errorMassege h2{
        margin-bottom: 20px;
        font-size: 36px;
        font-weight: bold;
        color: #c61c1f;
    }
    
    .sec_<?php echo $sec["ID"];?> .errorMassege h3{
        font-size: 24px;
        color: #666666;
        font-weight: normal;
    }

    /*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
    @media (max-width:1440px){

    }

    /*--------------------------  MD ( max 1200 ) --------------------------*/
    @media (max-width:1200px){

    }

    /*--------------------------  SM ( max 992 ) --------------------------*/
    @media(max-width:992px){
        .sec_<?php echo $sec["ID"];?> .formArea .rowMargin{
            margin-bottom: 0px;
        }

        .sec_<?php echo $sec["ID"];?> .formArea .formInput{
            margin-bottom: 10px;
        }
    }

    /*--------------------------  XS ( max 768 ) --------------------------*/
    @media (max-width:768px){
        .sec_<?php echo $sec["ID"];?> .donateButton{
            top: -72px;
            width: 150px;
            height: 150px;
            font-size: 24px;
            border: 7px solid #f1f1f1;
            line-height: 28px;
        }
        
        .sec_<?php echo $sec["ID"];?> .donateButton:hover, .sec_<?php echo $sec["ID"];?> .donateButton:focus, .sec_<?php echo $sec["ID"];?> .donateButton:active{
            border: 7px solid #f1f1f1;
        }
        
        .sec_<?php echo $sec["ID"];?>{
            padding: 100px 0 40px 0;
        }
        
        .sec_<?php echo $sec["ID"];?> .sectionContent{
            margin-bottom: 0px;
        }
        
        .sec_<?php echo $sec["ID"];?> .richtext p{
            margin: 0px;
        }
    }

    /*--------------------------  max 480 --------------------------*/
    @media (max-width:480px){

    }
</style>

<script type="text/javascript">  
    function scrollToForm() {
        $('html, body').animate({
            scrollTop: $("#formAnchor").offset().top
        }, 1000);
    }
</script>