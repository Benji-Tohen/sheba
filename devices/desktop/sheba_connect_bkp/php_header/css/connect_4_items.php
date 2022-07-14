

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

.boxItem{
	display: block;
	width: 480px;
	max-width: 100%;
	margin: 0 auto 30px auto;
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
		width: 100%;
	}
    
}

/*--------------------------  XS ( max 767 ) --------------------------*/
@media (max-width:767px){
	.contentItems {
	    text-align: center;
	}

	.boxLabel{
		padding-top: 0;
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