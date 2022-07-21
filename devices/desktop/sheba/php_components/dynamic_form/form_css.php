.genFormTextText{
    font-size: 16px;
    font-weight: bold;
}

.genFormInputText{
    font-size: 16px;
    height: 40px;
}

textarea.form-control{
    height: 120px;
}

#sendForm .form-group .genFormCheckboxField{
    margin: 0 5px;
}


#sendForm .form-group .iradio_flat-green{
    margin: 10px 15px;

}

.dynamicSubmit{
    display: block;
    font-size: 16px;
    padding: 10px 60px;
    background-color: #1abc9c;
    color: #fff;
    border-radius: 3px;
    border: 2px solid #1abc9c;
    height: max-content;
}

.dynamicSubmit:hover, .dynamicSubmit:focus{
    background-color: #fff;
    color: #1abc9c;
    outline: none;
}

#autocompleteDiv{
    font-size: 18px;
}

#autocompleteDiv:not(:empty){
    border: 1px solid #848484;
    padding: 10px;
    height: 150px;
    overflow: hidden;
    overflow-y: auto;
    box-shadow: 3px 3px 4px #0000002e;
}

#autocompleteDiv > div{
    border-bottom: 1px solid #ced4da;
    margin-bottom: 4px;
    padding-bottom: 4px;
}

.answerText, .errorMassege{
    margin-top: 50px;
    margin-bottom: 20px;
    color: #18a98d;
    font-size: 29px;
    font-weight: bold;
}

#sendForm{
    margin-top: 30px;
}
.select2-container--default .select2-selection--multiple.form-control,
.form-control{
    max-width: 340px;
    height: 50px;
    border: 1px solid #d2d2d2;
    font-size: 18px;
    border-<?php echo $gui->getLeft();?>: 5px solid #19bd9b;
    -webkit-border-top-<?php echo $gui->getRight();?>-radius: 5px;
    -webkit-border-bottom-<?php echo $gui->getRight();?>-radius: 5px;
    -moz-border-radius-top<?php echo $gui->getRight();?>: 5px;
    -moz-border-radius-bottom<?php echo $gui->getRight();?>: 5px;
    border-top-<?php echo $gui->getRight();?>-radius: 5px;
    border-bottom-<?php echo $gui->getRight();?>-radius: 5px;
}
.select2-container .select2-search--inline .select2-search__field{
    height: 20px;
    line-height:20px;
    font-family:inherit !important;
}
.form-group .select2-container--default.select2-container--focus .select2-selection--multiple {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgb(0 123 255 / 25%);
}