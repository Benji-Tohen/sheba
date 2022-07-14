.sideGallery{
	overflow: hidden;
}
 
.sideGallery .slick-slide{
	float: <?php echo $gui->getRight();?>; 
}

.sideGallery .slick-arrow{
    display: inline-block;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 22px;
    width: 48px;
    height: 48px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    background-color: #00ffd9;
    border: 1px solid #00ffd9;
    color: #fff;
    z-index: 90;
    outline: none;
    -o-transition:        background-color 0.3s ease, color 0.3s ease;
    -ms-transition:       background-color 0.3s ease, color 0.3s ease;
    -moz-transition:      background-color 0.3s ease, color 0.3s ease;
    -webkit-transition:   background-color 0.3s ease, color 0.3s ease;
    transition:           background-color 0.3s ease, color 0.3s ease;
}

.sideGallery .slick-arrow:hover, .sideGallery .slick-arrow:focus{
    background-color: #fff;
    color: #00ffd9;
}

.sideGallery .slick-next{
    <?php echo $gui->getLeft();?>: 26px;
}

.sideGallery .slick-prev{
    <?php echo $gui->getRight();?>: 26px;
}

.galleryImg{
	margin: 0 auto;
    display: block;
	margin-bottom: 15px;
}

.sepLineSection.greenLine{
    margin-bottom: 25px;
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