.genFormMultipleTitle, .genFormTextText{
    font-size: 20px;
    font-weight: normal;
    margin-bottom: 8px;
    margin-top: 8px;
}
.g-recaptcha{
    float: right;
    clear: both;
}
h1.{
    font-size: 30px;
    margin-bottom: 0px;

}
.answerText{
    margin-bottom: 20px;
    color: #18a98d;
    font-size: 29px;
    font-weight: bold;
}

.formPage .select2-container--default .select2-selection--multiple.form-control,
.formPage .form-control{
    max-width: 340px;
    height: 50px;
    border: 1px solid #d2d2d2;
    font-size: 18px;
    border-<?php echo $gui->getLeft();?>: 5px solid #19bd9b;
    margin-bottom: 14px;
    -webkit-border-top-<?php echo $gui->getRight();?>-radius: 5px;
    -webkit-border-bottom-<?php echo $gui->getRight();?>-radius: 5px;
    -moz-border-radius-top<?php echo $gui->getRight();?>: 5px;
    -moz-border-radius-bottom<?php echo $gui->getRight();?>: 5px;
    border-top-<?php echo $gui->getRight();?>-radius: 5px;
    border-bottom-<?php echo $gui->getRight();?>-radius: 5px;
}
.formPage .select2-container .select2-search--inline .select2-search__field{
    height: 20px;
}

.formPage .form-control:last-child{
    margin-bottom: 14px;
}

.radio-inline, .checkbox-inline{
    font-size: 18px;
    margin-<?php echo $gui->getRight();?>: 10px;
    margin-<?php echo $gui->getLeft();?>: 10px;
    float: <?php echo $gui->getRight();?>;
    width: 290px;
}

#mandatorySign{
  font-size: 12px;
  vertical-align: text-top;
}

.genFormInputTextarea{
    max-height: 200px;
    min-height: 95px;
}

.selectpicker{
    display: block;
    width: 100%;
    padding: 6px 12px;
    line-height: 1.42857143;
    max-width: 340px;
    height: 50px;
    border: 1px solid #d2d2d2;
    font-size: 18px;
    margin-bottom: 14px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.dynamicSubmit{
    width: 100%;
    max-width: 340px;
    display: block;
    background-color: #19bd9b;
    color: #ffffff;
    text-align: center;
    font-size: 18px;
    padding: 10px 20px;
    border: none;
    margin: 0 auto 30px auto;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}


.errorMassege{
    text-align: center;
}

.errorMassege h2{
    margin-bottom: 20px;
    font-size: 36px;
    font-weight: bold;
    color: #c61c1f;
}

.errorMassege h3{
    font-size: 24px;
    color: #666666;
    font-weight: normal;
}

.form-group{
    clear: both;
}


/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){

}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .radio-inline, .checkbox-inline{
        width: 215px;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    .formPage h4.radioTitle{
        min-width: 80px;
    }

    .formPage label .genFormInputText{
        width: 130px;
    }
}
