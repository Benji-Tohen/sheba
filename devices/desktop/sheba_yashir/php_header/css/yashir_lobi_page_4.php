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

.breadCrumbs, .breadCrumbs a, .breadCrumbs a:hover, .breadCrumbs a:focus, breadCrumbs a:visited, .breadCrumbs a:active{
    color: #444!important;
    font-size: 16px;
    text-decoration: none;
    text-align: <?php echo $gui->getRight();?>;
    margin-top: 20px;
}

.breadCrumbsStyle{
    display: inline-block;
    float: left;
}

.contentItems{
	margin: 24px 0px;

}

.boxImageStyle{
	width: 222px;
	height: 154px;
	border-radius: 3px;
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
}

.textSection, .textSection p{
    font-size: 14px;
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