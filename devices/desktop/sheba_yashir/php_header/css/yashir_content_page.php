h1{
    font-size: 34px;
    font-weight: 400;
}

h2{
    font-size: 30px;
    font-weight: 400;
}

h3{
    font-size: 26px;
    font-weight: 400;
}

h4{
    font-size: 20px;
    font-weight: 400;
}

.textSection, .textSection p{
    font-size: 14px;
}

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
.headLineH2{
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

 .breadCrumbsStyl.breadCrumbs :first-letter {
    color: red;
}

.breadCrumbsStyle {
    display: inline-block;
    float: left;
}

.sideGallery{
	overflow: hidden;
}
 
.sideGallery .slick-slide{
	float: <?php echo $gui->getRight();?>; 
}

.sideGallery .slick-arrow{
    display: inline-block;
    position: absolute;
    top: 45%;
    font-size: 15px;
    width: 37px;
    height: 37px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    background-color: rgba(241, 241, 241, 0.8);
    z-index: 90;
    outline: none;
    -o-transition:        background-color 0.3s ease, color 0.3s ease;
    -ms-transition:       background-color 0.3s ease, color 0.3s ease;
    -moz-transition:      background-color 0.3s ease, color 0.3s ease;
    -webkit-transition:   background-color 0.3s ease, color 0.3s ease;
    transition:           background-color 0.3s ease, color 0.3s ease;
}

.sideGallery .slick-arrow:hover, .sideGallery .slick-arrow:focus{
    background-color: rgba(45, 28, 82, 1);
    color: #fff;
}

.sideGallery .slick-next{
    <?php echo $gui->getLeft();?>: 26px;
}

.sideGallery .slick-prev{
    <?php echo $gui->getRight();?>: 26px;
}

.textSection{
	padding-bottom: 20px;
    font-size: 14px;
}



.galleryImg{
	margin: 0 auto;
    display: block;
	border-radius: 8px;
	margin-bottom: 15px;
}

/*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
@media (max-width:1440px){

}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    .sideGallery{
    	position: relative;
    	max-width: 448px;
    	margin: 0 auto;
    	display: block;
    }
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