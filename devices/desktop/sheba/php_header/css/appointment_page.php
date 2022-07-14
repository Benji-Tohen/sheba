h1{
    font-style: normal;
    font-weight: bold;
    font-size: 40px;
    line-height: 48px;
    text-align: start;
    color: #2B296D;
}

.mainItemWrap{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 265px;
    height: 375px;
    background: #FFFFFF;
    box-shadow: 0px 3px 10px #D9D9D9;
    border-radius: 10px;
    flex-wrap: wrap;
    margin: 10px;
    transition: all 0.3s ease 0s, left 0.3s ease 0s;

}

.itemCard{
    max-width: 265px;
    min-height: 375px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.itemTitle{
    font-style: normal;
    font-weight: 900;
    font-size: 23px;
    line-height: 28px;
    text-align: right;
    color: #151E4C;
    text-align: center;   
    padding-top:10px;
}

.itemSubTitle{
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    line-height: 126%;
}

.imageItem{
    width:110px;
    height: 110px;
    margin: 0 auto;
}

.itemsWrpper{
    margin-bottom: 20px;
}

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

.notClickable{
    pointer-events: none;
    cursor: default;
}

.itemCard a {
    display: inline-block;
    position: relative;
    text-align: center;
    transition: font-weight 0.3s ease 0s, left 0.3s ease 0s;

}

.mainItemWrap:hover{
    box-shadow: 0px 15px 10px #D9D9D9;

}

.itemCard a .itemTitle:after {    
    margin-top: 10px;
    background: none repeat scroll 0 0 transparent;
    bottom: 0px;
    content: "";
    top: 145px;
    display: block;
    height: 2px;
    left: 50%;
    position: absolute;
    background: #151E4C;
    transition: width 0.3s ease 0s, left 0.3s ease 0s;
    width: 0;
}
.itemCard a:hover .itemTitle:after { 
    width: 100%; 
    left: 0; 
}

.itemCard a:hover .itemSubTitle{ 
    color: #151E4C;
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
    .itemsWrpper{
        justify-content: center;
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
    .mainItemWrap{
        width: 40%;
        height: auto;
        min-height: 300px;      
    }
    .imageItem {
        width: 75px;
        height: 75px;
    }
    .itemCard {
        padding: 10px;
        min-height: unset;
    }
    .itemTitle {
        font-size: 20px;
    }
    .itemSubTitle {
        font-size: 16px;
    }
    .itemCard a .itemTitle:after {    
        top: 105px;
    }
    
    h1{
        font-size:23px;
    }

}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){
     .lobiTwoPage .titleOverlay{
        max-width: 100%;
     }
}

/*--------------------------  max 375 --------------------------*/
@media (max-width:375px){
     .lobiTwoPage .titleOverlay{
        max-width: 100%;
     }
}