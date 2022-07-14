.bannerImg{
	border-radius: 10px;
	background-image: linear-gradient(to top, rgba(215, 215, 215, 0.58) 0%, rgba(236, 236, 236, 0.58) 100%);
	background-color: white;
    height: 134px;
    width: 100%;
}

.yashirBanner{
	max-width:658px;
	height: 134px;
	float: left;
}

.headLineH1 {
	color: #444;
	font-size: 34px;
	font-weight: 400;
	display: inline-block;	
}
 
.greyLine{
	margin: 15px 0px;
	border-bottom: 3px solid #ebeff0;
}


.contentItems{
	margin: 24px 0px;

}

.boxImageStyle{

}

.boxLabel{
	text-align: center;
	color: #444;
	padding-top: 15px;
	padding-bottom: 30px;
	font-size: 14px;
	font-weight: 700;
}

.boxImage{
	text-align: center;
    position: relative;
}

.boxImage:before{
	content: ' ';
    background-color: rgba(0, 255, 217, 0);
    width: 100%;
    height: 100%;
    left: 0;
    right: 0;
    position: absolute;
    -o-transition: background-color 0.2s ease;
    -ms-transition: background-color 0.2s ease;
    -moz-transition: background-color 0.2s ease;
    -webkit-transition: background-color 0.2s ease;
    transition: background-color 0.2s ease;
}

a.boxItem:hover .boxImage:before, a.boxItem:focus .boxImage:before{
    background-color: rgba(0, 255, 217, 0.3);
}

.textSection, .textSection p{
    font-size: 14px;
}

.faq{
	margin-bottom: 50px;
}

.faq-item{
	border-bottom: 1px solid #d3d3d4;
}

.faq-item.active{
	border-bottom: none;
}

.faq-question{
	background-color: #fff;
	width: 100%;
	display: flex;
	align-items: center;
	justify-content: flex-start;
	height: 62px;
}

.faq-question:hover .faq-q-text{
	color: #ff007a;
}

.faq-question:focus{
	outline: none;
}

.faq-q-icon{
	display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ff007a;
    color: #fff;
    font-size: 26px;
    margin-left: 10px;
}

.faq-q-text{
	font-size: 23px;
	color: #0a0558;
}

.faq-answer{
	background-color: #f2f2f2;
	overflow: hidden;
    max-height: 0px;
    -o-transition: 		max-height 0.6s linear;
    -ms-transition: 	max-height 0.6s linear;
    -moz-transition: 	max-height 0.6s linear;
    -webkit-transition: max-height 0.6s linear;
    transition: 		max-height 0.6s linear;
    will-change: max-height;
}

.faq-item.active .faq-answer{
	border-bottom: 4px solid #ff007a;
	max-height: none;
}

.faq-a-title-container{
	display: flex;
    align-items: center;
    justify-content: flex-start;
    height: 62px;
    padding: 0 10px;
}

.faq-a-icon{
	display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #0a0558;
    color: #fff;
    font-size: 26px;
    margin-left: 10px;
}

.faq-a-title{
	font-size: 23px;
	color: #0a0558;
}

.faq-a-text{
	color: #272727;
	font-size: 18px;
	font-weight: 400;
	line-height: 26px;
    margin-right: 60px;
    margin-bottom: 30px;
}


/*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
@media (max-width:1440px){

}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    .boxImage{
    	text-align: center;
    }
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){

	.contentItems{
		margin: 24px 0px;
	}
	.boxImageStyle{
		text-align: center;
	}
    
}

/*--------------------------  XS ( max 767 ) --------------------------*/
@media (max-width:767px){
	.contentItems {
    text-align: center;
	}
 	.boxImageStyle {
	    width: 90%;
	    height: auto;   
	}

	.faq-a-text{
		font-size: 16px;
		margin-left: 20px;
	}
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}

/*--------------------------  ZOOM 150% (max-width: 1280px) --------------------------*/
@media screen and (max-width:80em){

}

/*--------------------------  ZOOM 200% (max-width: 960px) --------------------------*/
@media screen and (max-width:60em){

}

/*--------------------------  ZOOM 200% IN Laptops (max-width: 720px) --------------------------*/
@media screen and (max-width:45em){

}

/*-------------------------- PRINT VERSION --------------------------*/
@media print{

}
/*-------------------------- END PRINT VERSION --------------------------*/