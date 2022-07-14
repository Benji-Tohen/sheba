<?php
require_once dirname(__file__)."/../../../conf/conf.data.php";
header("Content-Type: text/css");
?>
#BNagish {
	position: fixed;
	top: 6px;
	<?php echo $gui->getLeft()?>: 6px;
	z-index: 999999999999;
}

#BNagishMenu {
	display: none;
	background: #e6e6e6;
	border-radius: 8px 0 8px 8px;
	padding: 0;
        color: #34495c;
	
	-webkit-box-shadow: -1px 2px 5px 0px rgba(50, 50, 50, 0.2);
	-moz-box-shadow:    -1px 2px 5px 0px rgba(50, 50, 50, 0.2);
	box-shadow:         -1px 2px 5px 0px rgba(50, 50, 50, 0.2);
}

#BNagishMenu a {
	display: block;
	padding: 0px 0px 0px 0px;
	padding-<?php echo $gui->getLeft()?>: 16px;
        color: #34495c;
        font-size: 14px;
}

#BNagishMenu strong {
	display: block;
	padding: 0px 0px 0px 0px;
	padding-<?php echo $gui->getLeft()?>: 16px;
	font-size: 18px;
}

#BNagishMenu span {
	display: block;
	padding: 0 16px 12px;
	font-size: 14px;
	color: #333;
}

#toggleBNagish {
	background: #34495e;
	color: #FFF;
	padding: 7px 20px;
	display: block;
	font-size: 16px;
	-webkit-border-radius: 7px;
    -moz-border-radius: 7px;
    border-radius: 7px;
	text-align: center;
	width: 151px;
    float: <?php echo $gui->getLeft()?>;
    -o-transition: none;
    -ms-transition: none;
    -moz-transition: none;
    -webkit-transition: none;
    transition: none;
}

#toggleBNagish #angle {
	margin-right: 5px;
}

.noBorderButtom{
    -webkit-border-radius: 7px !important;
    -webkit-border-bottom-right-radius: 0px !important;
    -webkit-border-bottom-left-radius: 0px !important;
    -moz-border-radius: 7px !important;
    -moz-border-radius-bottomright: 0px !important;
    -moz-border-radius-bottomleft: 0px !important;
    border-radius: 7px !important;
    border-bottom-right-radius: 0px !important;
    border-bottom-left-radius: 0px !important;
}

.toggleBNagishSize {
    float: <?php echo $gui->getLeft()?>;
    background: none repeat scroll 0 0 #dedcdd;
    border-radius: 7px;
    color: #354a5f;
    display: block;
    font-size: 16px;
    padding: 7px;
    font-weight: bold;
    width: 37px;
    margin-<?php echo $gui->getLeft()?>: 6px;
    text-align: center;
    cursor: pointer;
}

#BNagish .active {
	font-weight: bold;
	background: #3e3e3e;
	color: #fff;
	border-radius: 5px;
	margin: 0px 14px;
}

#BNagish .webColors {
	margin: 4px 14px;
	padding: 5px 8px;
}

.Nagish-Inverted {
	filter: invert(1);
	-webkit-filter: invert(1);
	-moz-filter: invert(1);
	-o-filter: invert(1);
	-ms-filter: invert(1);
}

.Nagish-Grayscale {
	-webkit-filter: grayscale(100%);
	-moz-filter: grayscale(100%);
	filter: grayscale(100%);
}


