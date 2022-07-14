.lobiTwoPage .twoItemsRow{
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid #ececec;
}

.lobiTwoPage .richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #ececec;
}

.lobiTwoPage .richtext a {
     display: contents;
     max-width: unset;
     margin: unset;

}

.lobiTwoPage .sepTitle{
    margin-top: 18px;
    color:#34495E;
    width: 100%;
    float: right;
    font-size: 25px;
    font-weight: 600;
    margin-bottom: 18px;
    border-bottom: 1px solid #ececec;
}

.lobiTwoPage .twoItemsRow .item a{
    display: block;
    position: relative;
}

.lobiTwoPage a{
    display: block;
    max-width: 390px;
    margin: 0 auto;
}

.lobiTwoPage a h4, .lobiTwoPage a:visited h4{
    text-decoration: none;
    color: #222222;
}

.lobiTwoPage a:hover h4, .lobiTwoPage a:focus h4{
    text-decoration: none;
    color: #1ABC9C;
}

.lobiTwoPage .titleOverlay{
    padding-top: 18px;
    text-align: center;
    padding-left: 10px;
    padding-right: 10px;
}

.lobiTwoPage .showMoreButton{
    margin: 0 auto 30px auto;
}

.lobiTwoPage .showMoreButton:hover{
    background-color: #1abc9c;
    color: #ffffff;
}

.notClickable{
    pointer-events: none;
    cursor: default;
}

/*--------------------------  Big Screen ( min 1400 ) --------------------------*/
@media (min-width:1200px){

}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){
	.lobiTwoPage .titleOverlay{
	    width: 100%;
	    left: 0;
	    right: 0;
	    margin: 0 auto;
	}
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){

    .lobiTwoPage .item img{
        margin: 0 auto;
    }

    .lobiTwoPage .item{
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #ececec;
    }

    .lobiTwoPage .twoItemsRow{
        border: none;
        margin-bottom: 20px;
        padding-bottom: 0px;
    }

}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
     .lobiTwoPage .titleOverlay{
        max-width: 100%;
     }
}