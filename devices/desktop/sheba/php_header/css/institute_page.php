
/*Base setings page*/  
.institute-page{
    text-align: start;
    margin-bottom: 25px;
}
.institute-page .sepLine{
    width: 100%;
    height: 1px;
    background-color: #C4C2C1;
    margin-bottom: 10px;
}
.institute-page .richtext{
    font-size: 18px;
    color: #222222;
    margin-bottom: 20px;
}
a, a:visited {
    color: #1ABC9C;
    transition: all 0.2s ease;
}

.institute-page .richtext h1{
    font-size: 40px ;
}

.institute-page .richtext h2{
    font-size: 26px ;
}
.itemIcon i {
    font-size: 30px;
    color: #ffffff;
}
a h3, 
a:visited h3 {
    text-decoration: none;
    color: #222222;
}
a:hover h3{
    color: #19bd9b;
}


.institute-page a:hover{
    text-decoration: none;
}

.institute-page .innerImg{
    position: relative;
    max-width: 632px;
    margin: 0 auto 23px auto;
}
/*Title Page*/
.institute-page .title-page{
    padding-bottom: 1px;
    background-color: #f0f0f0;
    border-radius: 5px 5px 0 0;
    width: 100%;
}
.institute-page .title-page h1{
    color: #232323;
    padding: 18px 16px;
    margin: 0px;
    font-size: 33px;
}
/*Content*/
.box-border{
    border-radius:0 0 5px 5px;
    border: 1px solid #f0f0f0;
    padding: 15px 15px 30px 15px;
    margin-bottom: 30px;
    overflow-wrap: anywhere;
}
.half-box-one{
    border-<?php echo $gui->getRight();?>: 1px solid #f0f0f0;
}
.half-box-one ,.half-box{
    font-size: 16px;
    color: #333333;
}
.half-box{
    padding-<?php echo $gui->getLeft();?>: 15px ;
}
/*Button page*/
.event-register-button{
    width: 100%;
    margin-bottom: 20px;
    text-align: center;
}
.event-register-button a, .event-register-button a:visited{
    background-color: #19bd9b;
    color: #ffffff;
    text-align: center;
    font-size: 18px;
    padding: 10px 20px;
    border-radius: 5px;
    width: auto;
}
.event-register-button a:hover,
.event-register-button a:focus,
.event-register-button a:active{
    background-color: #34495e;
}
.doctors-title{
    margin-bottom: 20px;
    text-align: center;
}

/*search Box Button*/ 
.searchBoxButton {
    background-color: #17bd99;
    padding: 12px 16px;
    color: #ffffff;
    font-size: 16px;
    text-align: -webkit-center;
    display: table-cell;
    cursor: pointer;
    border-radius: inherit!important;
    -webkit-border-top-<?php echo $gui->getRight();?>-radius: 5px!important;
    -webkit-border-bottom-<?php echo $gui->getRight();?>-radius: 5px!important;
    -moz-border-radius-top<?php echo $gui->getRight();?>: 5px!important;
    -moz-border-radius-bottom<?php echo $gui->getRight();?>: 5px!important;
    border-top-<?php echo $gui->getRight();?>-radius: 5px!important;
    border-bottom-<?php echo $gui->getRight();?>-radius: 5px!important;

}
.searchRow {
    padding-top: 20px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #ECECEC;
    display: table;
    width: 100%;
    text-align:center;
}
.searchBox {
    padding: 0 10px;
    height: 60px;
    color: #16274d;
    font-size: 16px;
    border: 1px solid #c1c1c1;
    -webkit-box-shadow: inset 0 0 5px 0 #d9d8d6;
    box-shadow: inset 0 0 5px 0 #d9d8d6;
    border-radius: 8px;
    border-top-<?php echo $gui->getRight();?>-radius: 0;
    border-bottom-<?php echo $gui->getRight();?>-radius: 0;
    width: 100%;
}

.institute-page .mapLink{
    color: #1abc9c;
    font-size: 16px;
    display: inline-block;
}

.institute-page .locationTitle{
    display: inline-block;
    margin-<?php echo $gui->getRight();?>: 7px;
}

.institute-page h2{
    margin-bottom: 14px;
}

h2.clinicTeamTitle{
    text-align: center;
    margin-bottom: 25px;
}

.showMoreButton{
    margin-bottom: 20px;
    padding-top: 0px;
    width: 100%;
    max-width: 256px;
    background-color: #fff;
}

.infoCircle{
    background-color: #14a6cb;
    display: table-cell;
    width: 60px;
    height: 60px;
    text-align: center;
    vertical-align: middle;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    border-radius: 100px;
}

.infoCircle svg{
    width: 32px;
    height: 32px;
}

.infoCircle *{
    fill: #fff;
}

h3.infoText{
    display: table-cell;
    vertical-align: middle;
    color: #222222;
    padding-<?php echo $gui->getLeft();?>: 70px;
}

.infoWrap{
    display: table;
    margin-bottom: 22px;
    padding-bottom: 22px;
    border-bottom: 1px solid #ececec;
}

.infoWrap:hover .infoCircle{
    background-color: #34495e;
}

.itemIcon{
    background-color: #19bd9b;
    width: 60px;
    height: 60px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

h5{
    font-size: 16px;
}

.itemText{
    display: flex;
    align-items: center;
    height: 60px;
}

.wazeLink{
	display: none;
}

.title-link{
    display: none;
	font-size: 16px;
	color: #000;
	font-weight: 600;
	margin-bottom: 5px;
}

.icon-waze{
	width: 40px;
    height: 40px;
    max-width:40px;
    max-height:40px;
}
.institute-page .doctors-slider > .item{
    border-bottom: none;
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .infoCol{
        margin-bottom: 15px;
        border-bottom: 1px solid #c7c7c7;
        padding-bottom: 15px;
        border-<?php echo $gui->getRight();?>: 0px;
    }
    .galleryArrowLeft{
        left: -15px;
    }
    .galleryArrowRight{
        right: -15px;
    }
   
    .half-box-one{
        border-<?php echo $gui->getRight();?>: none;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .wazeLink{
        width: 100%;
        display: block;
        text-align: center;
    }

    .title-link{
        display: block;
        font-size: 16px;
        color: #000;
        font-weight: 600;
        margin-bottom: 5px;
        width: 100%;
        text-align: center;
    }

    .icon-waze{
        width: 40px;
        height: 40px;
        max-width:40px;
        max-height:40px;
        display: block;
        margin: 0 auto;
    }

}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
    h3.infoText{
        padding-<?php echo $gui->getLeft();?>: 20px;
    }
}
