/* Updates Feed */
.feature-title{
    color: #464646;
    font-size: 25px;
    font-weight: 700;
    position: relative;
    margin-bottom: 8px;
    text-align: <?php echo $gui->getLeft();?>;
}

.feature-title-line{
    width: 30%;
    border-bottom: 2px solid #1abc9c;
    margin-bottom: 40px;
}

.updates-item{
    margin-bottom: 35px;
}

.updates-item:hover, .updates-item:focus{
    color: #1abc9c;
}

.updates-item:after{
    margin-top: 35px;
    content: ' ';
    display: block;
    width: 100%;
    height: 1px;
    background-color: #cecece;
}

.updates-item-link, .updates-item-link:visited{
    display: block;
    color: #464646;
}

.updates-item-link:hover, .updates-item-link:focus{
    color: #1abc9c;
}

.updates-item-title{
    font-size: 17px;
    font-weight: bold;
    line-height: 28px;
    margin-bottom: 5px;
    line-height: 1.2;
}

.updates-item-subtitle{
    font-size: 17px;
    font-weight: normal;
    line-height: 1.2;
}

.info-block{
    margin-bottom: 20px;
}

.info-block-header{
    width: 100%;
    height: 70px;
    text-align: center;
    color: #fff;
    background: #1abc9c;
    font-size: 30px;
    font-weight: 400;
    padding-top: 14px;
}

.info-block-body{
    background: #f5f5f5;
    color: #535353;
    padding: 30px 15px;
    font-size: 17px;
    text-align: <?php echo $gui->getLeft();?>;
}

.updates-item-date{
    font-size: 14px;
}

.btn-load-more{
    width: 220px;
    padding: 10px;
    font-size: 18px;
    color: #fff;
    background-color: #1abc9c;
    margin: 0 auto 20px auto;
    display: block;
}

.btn-load-more:hover, .btn-load-more:focus{
    background-color: #71d4c0;
}
/* END Updates Feed */

/* Services Feed */
.services-item-link, .services-item-link:visited{
    display: -webkit-box; 
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex; 
    display: flex;
    -webkit-box-align: center;
    -moz-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
    color: #464646;
}

.services-item-link:hover, .services-item-link:focus{
    color: #1abc9c;
}

.services-item-title{
    font-size: 23px;
    line-height: 1.2;
    text-align: <?php echo $gui->getLeft();?>;
}

.services-item{
    margin-bottom: 20px;
}

.services-item:after{
    margin-top: 20px;
    content: ' ';
    display: block;
    width: 100%;
    height: 1px;
    background-color: #cecece;
}

.service-item-side{
    display: flex;
    align-items: center;
    min-height: 50px;
}
/* END Services Feed */

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .updates-item-img{
        display: block;
        margin: 0 auto 10px auto;
    }
}