.page-header h1{
    border-bottom: 1px solid #C7C7C7;
    padding-bottom: 23px;
}

.richtext p{
    font-size: 18px;
}
.doctorPage a, .doctorPage a:visited{
    color: #1abc9c;
}

.doctorPage .doctorInfo .richtext{
    font-size: 18px;
    color: #222222;
    margin-bottom: 20px;
}

.callDesktop{
    display: inline-block;
    border-bottom: 1px solid #eeeeee;
}
.number-phone{
    display: block;
    margin-bottom: 15px;
}

.callMobile{
    display: none;
}

#mainOverlay{
    position: fixed;
    height: 100%;
    width: 100%;
    z-index: 105;
    background: #000;
    opacity: 0.8;
}

.fullScreenIframeWrap{
    z-index: 106;
    position: fixed;
    display: none;
    width: 70%;
    height: 80%;
    top: 0;
    /* margin: 0 auto; */
    right: 0;
    margin-right: 15%;
    margin-top: 5%;
}

.doctorPage{
    margin-bottom: 25px;
}

.doctorPage .richtext{
    font-size: 18px;
}

.doctorInfoTitle{
    font-weight: bold;
    margin-bottom: 25px;
    margin-top: 25px;
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

.doctorPage .page-header{
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
    margin-top:40px;
}
/* .panel.with-nav-tabs .nav-tabs{
	border-bottom: none;
} */
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

.nav-tabs > li > a{
    display: inline-block;
    padding: 10px 35px;
    margin: 0px;
}
.nav-tabs .nav-link:hover{
    border-bottom: 1px solid inherit;
}

.nav-tabs > .nav-item > .active, 
.nav-tabs > .nav-item > a.active:hover, 
.nav-tabs > .nav-item > a.active:focus{
    border-top: 3px solid #1ABC9C;
}
.nav-tabs > .nav-item > a:hover{
    border-bottom: 1px solid inherit;
}
.panel-body{
    padding: 30px 15px;
}

.bottomPanelBody{
    border-top: 1px solid #DDD;
    padding-top: 20px;
}
/* END TABS */

.watch-video-btn{
    display: block;
    background: none;
    border: none;
    font-size: 15px;
    color: #000000;
    width: 160px;
    text-align: <?php echo $gui->getLeft();?>;
    vertical-align: middle;
    padding: 0px;
    margin-top: 10px;
}

.watch-video-btn:hover, .watch-video-btn:focus{
    color: #1ABC9C;
    outline: none;
}

.watch-video-btn-icon{
    display: inline-block;
    vertical-align: middle;
    background-image: url("<?php echo $cfg['WM']['Server'].'/webfiles/icons/sheba-yashir_doctor_pagevideo.png';?>");
    background-position: top;
    background-repeat: no-repeat;
    width: 30px;
    height: 30px;
    margin-<?php echo $gui->getRight();?>: 6px;
}

.watch-video-btn-label{
    display: inline-block;
    vertical-align: middle;
}

.watch-video-btn:hover .watch-video-btn-icon, .watch-video-btn:focus .watch-video-btn-icon{
    background-position: bottom;
}

.back-to-doc-search{
    display: none;
    cursor: pointer;
    width: 170px;
    height: 45px;
    font-size: 17px;
    text-align: center;
    border-radius: 6px;
    background-color: #34495e;
    color: #fff;
    display: flex;
    justify-items: center;
    justify-content: center;
    align-items: center;
} 

.back-to-doc-search:hover, .back-to-doc-search:focus{
    background-color: #16bc99;
}

.doc-row-between{
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -ms-justify-content: space-between;
    -moz-justify-content: space-between;
    -webkit-justify-content: space-between;
    justify-content: space-between;
    -ms-align-items: center;
    -moz-align-items: center;
    -webkit-align-items: center;
    align-items: center;
    justify-content: flex-end;
}

.specialistDoctorImg{
    margin-top: 10px;
}

.closeVideoPop{
    display: block;
    position: fixed;
    top: 20px;
    left: 20px;
    font-size: 50px;
    background: none;
    color: #fff;
    outline: none;
}


/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .specialist_doctor img{
        margin-bottom: 10px;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){
    .back-to-doc-search{
        width: 100%;
        margin-bottom: 20px;
    } 
    .fullScreenIframeWrap{
        height: 40%;
            margin-top: 35%;
    }
    .callDesktop{
        display: none;
    }
    .doctorEmail{
        font-size: 17px;
    }
    .callMobile{
        display: inline-block;
    }
    .innerImg{
        width: 100%;
        margin: 0 auto;
        text-align: center;
    }
    .doc-row-between{
        justify-content: center;
        margin-top: 20px;
    }
    .doctorPage .page-header .innerImg img{
        margin: 0 auto;
        margin-bottom: 10px;
    }

    .doctorInfo h1{
        text-align: center;
    }

    .watch-video-btn{
        display: block;
        margin: 0 auto 10px auto;
    }

    .doctorPage .doctorEmail{
        font-size: 14px;
    }

    .specialist_doctor{
        display: block;
        margin: 0 auto;
        width: 140px;
    }

    .specialist_doctor img{
        margin-top: 0px;
        margin-bottom: 10px;
    }
    .panel-body{
        margin-bottom: 20px;
    }
}