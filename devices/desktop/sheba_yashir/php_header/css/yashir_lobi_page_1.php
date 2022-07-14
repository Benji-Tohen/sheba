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

.itemWrap{
	margin-bottom: 30px;
}

.itemTitle{
	display: block;
	font-size: 16px;
	font-weight: bold;
	color: #444444;
	margin-bottom: 5px;
}

.itemSubtitle{
	display: block;
	font-size: 14px;
	font-weight: normal;
	color: #444444;
}

a.itemDate, a.itemDate:visited{
	display: block;
	font-size: 16px;
	font-weight: bold;
	color: #888888;
	text-align: <?php echo $gui->getRight();?>;
}

.itemImg{
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    margin-bottom: 10px;
}

.textSection, .textSection p{
    font-size: 14px;
}

/*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
@media (max-width:1440px){

}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){

}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    
}

/*--------------------------  XS ( max 767 ) --------------------------*/
@media (max-width:767px){

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