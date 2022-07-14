/* ----Transformicon---- */

.tcon {
  appearance: none;
  border: none;
  cursor: pointer;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  height: 40px;
  transition: 0.3s;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  width: 40px;
  background: transparent; }
  .tcon > * {
    display: block; }
  .tcon:focus {
    outline: none; }

.tcon-plus {
  height: 40px;
  position: relative;
  -webkit-transform: scale(.75);
  transform: scale(.75);
  width: 40px; }
  .tcon-plus::before, .tcon-plus::after {
    content: "";
    border-radius: 2px;
    display: block;
    width: 34px;
    height: 10px;
    margin: -5px 0 0 -17px;
    position: absolute;
    top: 50%;
    left: 50%;
    transition: 0.3s;
    background: black; }
  .tcon-plus:after {
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg); }

.tcon-plus--minus.tcon-transform:before {
  -webkit-transform: rotate(180deg) translate(0px, 0);
  transform: rotate(180deg) translate(0px, 0);
  width: 19px; }
.tcon-plus--minus.tcon-transform:after {
  -webkit-transform: rotate(-180deg) translate(-15px, 0);
  transform: rotate(-180deg) translate(-15px, 0);
  width: 19px; }

.tcon-visuallyhidden {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px; }
  .tcon-visuallyhidden:active, .tcon-visuallyhidden:focus {
    clip: auto;
    height: auto;
    margin: 0;
    overflow: visible;
    position: static;
    width: auto; }

/* ----END Transformicon---- */

.contactItemsPage .richtext{
    font-size: 18px;
    color: #222;
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #ececec;
}

.contactItemsPage .item{
    margin-bottom: 22px;
    padding-bottom: 22px;
    border-bottom: 1px solid #ececec;
}

.contactItemsPage a h3, .contactItemsPage a:hover, .contactItemsPage a:visited{
    text-decoration: none;
    color: #222222;
}

.contactItemsPage a h4, .contactItemsPage a:hover, .contactItemsPage a:visited{
    text-decoration: none;
    color: #222222;
}

.contactItemsPage h3{
    margin-bottom: 12px;
}

.contactItemsPage .showMoreButton{
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
    cursor:pointer;
}

.contactItemsPage .showMoreButton:hover{
    background-color: #1abc9c;
    color: #ffffff;
}

.contactItemsPage .itemImage img{
    -webkit-border-radius: 500px;
    -moz-border-radius: 500px;
    border-radius: 500px;
}


.contactItemsPage .infoLine{
    width: 100%;
    border-bottom: 1px solid #56CEB6;
}

.contactItemsPage .infoIcon{
    width: 58px;
    height: 58px;
    background-color: #56ceb6;
    text-align: center;
    border: none;
    border-radius: 0;
}

.contactItemsPage .infoIcon .fa{
    color: #ffffff;
    font-size: 25px;
}

.contactItemsPage .infoBox{
    position: relative;
    margin-bottom: 22px;
    padding-bottom: 22px;
    border-bottom: 1px solid #ECECEC;
}

.contactItemsPage .infoText{
    background-color: #1abc9c;
    color: #ffffff;
    height: 58px;
    font-size: 18px;
    vertical-align: middle;
    display: table-cell;
    padding-<?php echo $gui->getLeft();?>: 20px;
}

.contactItemsPage .arrowDown{
    position: absolute;
    top: -22px;
    left: 10%;
    z-index: 100;
    font-size: 40px;
    color: #FFF;
}

.contactItemsPage .arrowDown .glyphicon{
    -ms-transform: scale(1,0.7) rotate(-30deg);
    -webkit-transform: scale(1,0.7) rotate(-30deg);
    transform: scale(1,0.7) rotate(-30deg);
}

.itemExpand{
    text-align: center;
}

.itemExpand button{
    border: none;
    background: inherit;
    font-size: 40px;
    color: #1bbc9b;
}


/*--------------------------  Laptops ( max 1400 ) --------------------------*/
@media (max-width:1400px){
  
}

/*--------------------------  MD ( max 1200 ) --------------------------*/
@media (max-width:1200px){

}

/*--------------------------  SM ( max 992 ) --------------------------*/
@media(max-width:992px){
    .contactItemsPage .itemImage img{
        margin-bottom: 20px;
    }
}

/*--------------------------  XS ( max 768 ) --------------------------*/
@media (max-width:768px){

}

/*--------------------------  max 480 --------------------------*/
@media (max-width:480px){

}