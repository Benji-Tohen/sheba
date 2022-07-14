.pageHeader h1{
    border-bottom: 1px solid #C7C7C7;
    padding-bottom: 23px;
}

.pageHeader h3{
    border-bottom: 1px solid #eeeeee;
    padding-bottom: 17px;
    margin-bottom: 21px;
}

.doctorPage a, .doctorPage a:visited{
    color: #1abc9c;
}

.doctorPage .doctorInfo .richtext{
    font-size: 18px;
    color: #222222;
    margin-bottom: 20px;
}

.doctorPage{
    margin-bottom: 25px;
}

.doctorPage .richtext{
    font-size: 18px;
}

.doctorPage .doctorInfoTitle{
    font-weight: bold;
    margin-bottom: 10px;
}

.doctorDescription{
    margin-bottom: 30px;
}

.doctorDescription h3{
    line-height: 1.3em;
}

.doctorPage .doctorEmail{
    display: inline-block;
    margin-bottom: 10px;
    padding: 0px;
    border: none;
}

.doctorPage .doctorPhone{
    display: inline-block;
    border: none;
    padding: 0px;
}

.doctorInfo i{
    font-size: 20px;
    color: #1abc9c;
    margin-<?php echo $gui->getRight();?>: 16px;
}

.doctorPage .pageHeader{
    margin-bottom: 36px;
}

.doctorInfoGroup{
    margin-bottom: 22px;
}

.doctorPage .richtext h4{
    font-weight: bold;
}


/* TABS */
.panel.with-nav-tabs .panel-heading{
    padding-<?php echo $gui->getLeft();?>: 0px;
    padding-bottom: 0px;
    background-color: #ffffff;
}
.panel.with-nav-tabs .nav-tabs{
	border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
	margin-bottom: -1px;
}

.panel-default{
    border: none;
}

.panel-body{
    border-left: 1px solid #DDD;
    border-right: 1px solid #DDD;
    border-bottom: 1px solid #DDD;
}

.panel.with-nav-tabs .nav-tabs{
    padding-<?php echo $gui->getLeft();?>: 0px;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
    border-top: 3px solid #1ABC9C;
    margin-<?php echo $gui->getLeft();?>: 0px;
    color: #222222;
    padding: 10px 35px;
}

.panel-body{
    padding: 30px 15px;
}

.bottomPanelBody{
    border-left: 1px solid #DDD;
    border-right: 1px solid #DDD;
    border-bottom: 1px solid #DDD;
    padding: 30px 15px;
}
/* END TABS */




/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
    
}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    
    .doctorPage .pageHeader .innerImg img{
        margin: 0 auto;
        margin-bottom: 10px;
    }

    .doctorInfo h1{
        text-align: center;
    }

}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}
