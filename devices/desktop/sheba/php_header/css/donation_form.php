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

.bigImgCont{
    margin-bottom: 25px;
}

.form-control{
    border: 1px solid #A1A1A1;
    border-radius: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
    height: 40px;
    font-size: 18px;
}

.commentsTextarea{
    margin-top: 18px;
}

.formInput::-webkit-input-placeholder {
    color: #484848;
    font-size:18px;
}

.formInput:-moz-placeholder { /* Firefox 18- */
    color: #484848;
    font-size:18px;
}

.formInput::-moz-placeholder {  /* Firefox 19+ */
    color: #484848;
    font-size:18px;
}

.formInput:-ms-input-placeholder {
    color: #484848;
    font-size:18px;
}

.submitButton{
    background: transparent;
    text-decoration: underline;
    border: none;
    font-size: 26px;
    padding: 0;
    margin-top: 5px;
}

.formArea h2{
    color: #535353;
    font-weight: bold;
    font-size: 35px;
    margin-bottom: 22px;
}

.formContentDiv{
    padding-<?php echo $gui->getRight();?>: 73px;
    color: #484848;
    padding-bottom: 25px;
}



/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .bigImgCont{
        margin-bottom: 30px !important;
    }
    .formContentDiv{
        padding-left: 15px !important;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .inputDiv{
        margin-bottom: 15px;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    
}
