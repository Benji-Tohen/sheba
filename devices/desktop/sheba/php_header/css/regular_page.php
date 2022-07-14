h1{
    font-size: 40px !important;
}

h2{
    font-size: 24px;
}

/* Responsive Video Embed */
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

.videoDescription{
    background-color: #1B1B1B;
    padding: 10px;
    font-size: 14px;
    color: #FFF;
    border-top: 1px solid #474747;
}

/* END Responsive Video Embed */


.articlePage .richtext{
    font-size: 18px;
    color: #222222;
    margin-bottom: 20px;
}

.articlePage{
    margin-bottom: 25px;
}

.innerImg{
    position: relative;
    /* max-width: 632px; */
    margin: 0 auto 23px auto;
}

.videoEmbed{
    max-width: 640px;
    margin: 0 auto 23px auto;
}

.videoAndImageDescription{
    position: absolute;
    bottom: 0;
    color: #ffffff;
    font-size: 16px;
    background-color: rgba(0,0,0,0.5);
    width: 100%;
    height: 35px;
    padding: 6px 13px 0px 6px;
}


/* Fixing owl carousel for hebrew */
.owl-carousel{
    direction: ltr;
    margin-bottom: 20px;
}

.owl-item img{
    margin: 0 auto;
}
/* END Fixing owl carousel for hebrew */



.eventRegisterButton a, .eventRegisterButton a:visited{
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



/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .videoAndImageDescription{
        height: inherit;
        padding-bottom: 5px;
    }
}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}
