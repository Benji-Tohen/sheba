.sec_<?php echo $wmPage["ID"];?>{
    padding: 40px 0 40px 0;
}

.sec_<?php echo $wmPage["ID"];?> .richtext{
    color: #444444;
    font-size: 24px;
    font-weight: 300;
    text-align: center;
}

.sec_<?php echo $wmPage["ID"];?> .sectionTitle{
    text-align: center;
}

.sec_<?php echo $wmPage["ID"];?> .sectionContent{
    margin-bottom: 20px;
}

.sec_<?php echo $wmPage["ID"];?> .sectionContentCenter{
    margin-bottom: 40px;
}

.sec_<?php echo $wmPage["ID"];?> .formArea label.outsideInputTitle{
    color: #444444;
    font-size: 18px;
    font-weight: normal;
}

.sec_<?php echo $wmPage["ID"];?> .formArea .formInput{
    width: 100%;
    height: 48px;
    border: 1px solid #d2d2d2;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    color: #444444;
    font-size: 18px;
    font-weight: normal;
    padding-<?php echo $gui->getLeft();?>: 20px;
}

.sec_<?php echo $wmPage["ID"];?> .formArea input::-webkit-input-placeholder {
    color: #c9c9c9;
    font-size: 18px;
    font-weight: normal;
}

.sec_<?php echo $wmPage["ID"];?> .formArea input:-moz-placeholder { /* Firefox 18- */
    color: #c9c9c9;
    font-size: 18px;
    font-weight: normal;
}

.sec_<?php echo $wmPage["ID"];?> .formArea input::-moz-placeholder {  /* Firefox 19+ */
    color: #c9c9c9;
    font-size: 18px;
    font-weight: normal;
}

.sec_<?php echo $wmPage["ID"];?> .formArea input:-ms-input-placeholder {  
    color: #c9c9c9;
    font-size: 18px;
    font-weight: normal;
}

.sec_<?php echo $wmPage["ID"];?> .formArea .form-control{
    width: 100%;
    height: 48px;
    border: 1px solid #d2d2d2;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    color: #444444;
    font-size: 18px;
    font-weight: normal;
    padding-<?php echo $gui->getLeft();?>: 20px;
}

.sec_<?php echo $wmPage["ID"];?> .formArea .rowMargin{
    margin-bottom: 20px;
}

.sec_<?php echo $wmPage["ID"];?> .formArea .checkboxText{
    color: #444444;
    font-size: 18px;
    font-weight: 300;
    margin-<?php echo $gui->getLeft();?>: 10px;
    vertical-align: -3px;
}

.sec_<?php echo $wmPage["ID"];?> .donateButton{
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
    font-weight: normal;
    text-align: center;
    -webkit-border-radius: 500px;
    -moz-border-radius: 500px;
    border-radius: 500px;
}

.sec_<?php echo $wmPage["ID"];?> .donateButton:hover, .sec_<?php echo $wmPage["ID"];?> .donateButton:focus, .sec_<?php echo $wmPage["ID"];?> .donateButton:active{
    background-color: #f1f1f1;
    color: #18a98d;
    border: 12px solid #18a98d;
}

.lpButton, .lpButton:visited {
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
.lpButton:hover, .lpButton:active, .lpButton:focus {
    background-color: #fff;
    border: 3px solid #138770;
    color: #138770;
}



.sec_<?php echo $wmPage["ID"];?> .thankYou{
    text-align: center;
}

.sec_<?php echo $wmPage["ID"];?> .thankYou img{
    margin-bottom: 20px;
}

.sec_<?php echo $wmPage["ID"];?> .thankYou h2{
    margin-bottom: 20px;
    color: #18a98d;
    font-size: 36px;
    font-weight: bold;
}

.sec_<?php echo $wmPage["ID"];?> .answerText{
    font-size: 24px;
    color: #666666;
}

.sec_<?php echo $wmPage["ID"];?> .errorMassege{
    text-align: center;
}

.sec_<?php echo $wmPage["ID"];?> .errorMassege h2{
    margin-bottom: 20px;
    font-size: 36px;
    font-weight: bold;
    color: #c61c1f;
}

.sec_<?php echo $wmPage["ID"];?> .errorMassege h3{
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
    .sec_<?php echo $wmPage["ID"];?> .formArea .rowMargin{
        margin-bottom: 0px;
    }

    .sec_<?php echo $wmPage["ID"];?> .formArea .formInput{
        margin-bottom: 10px;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .sec_<?php echo $wmPage["ID"];?> .donateButton{
        top: -72px;
        width: 150px;
        height: 150px;
        font-size: 24px;
        border: 7px solid #f1f1f1;
    }
    
    .sec_<?php echo $wmPage["ID"];?> .donateButton:hover, .sec_<?php echo $wmPage["ID"];?> .donateButton:focus, .sec_<?php echo $wmPage["ID"];?> .donateButton:active{
        border: 7px solid #18a98d;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}
