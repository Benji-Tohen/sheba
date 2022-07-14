.lobiThreePage .threeItemsRow{
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #ececec;
}

.lobiThreePage .threeItemsRow img{
    margin: 0 auto;
}

.lobiThreePage .richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #ececec;
}

.lobiThreePage .richtext a {
     display: contents;
     max-width: unset;
     margin: unset;

}

.lobiThreePage .sepTitle{
    margin-top: 18px; color:#34495E;width: 100%;float: right;font-size: 25px;
    margin-bottom: 18px;
    border-bottom: 1px solid #ececec;
    font-weight: 600;
}

.lobiThreePage a{
    display: block;
}

.lobiThreePage a h4, .lobiThreePage a:visited h4{
    text-decoration: none;
    color: #222222;
    overflow: hidden;
    height: 60px;
}

.lobiThreePage a:hover h4, .lobiThreePage a:focus h4{
    text-decoration: none;
    color: #1ABC9C;
}

.lobiThreePage .titleOverlay{
    margin-top: 10px;
    padding: 10px 5px;
    text-align: center;
}

.lobiThreePage .showMoreButton{
    display: block;
    max-width: 260px;
    height: 53px;
    border: 2px solid #1abc9c;
    text-align: center;
    font-size: 18px;
    padding-top: 12px;
    color: #222222;
    margin: 0 auto 30px auto;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}

.lobiThreePage .showMoreButton:hover{
    background-color: #1abc9c;
    color: #ffffff;
}

.notClickable{
    pointer-events: none;
    cursor: default;
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){

    .lobiThreePage .item img{
        margin: 0 auto;
    }

    .lobiThreePage .item{
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid #ececec;
    }

    .lobiThreePage .threeItemsRow{
        border: none;
        margin-bottom: 0px;
        padding-bottom: 0px;
    }

}