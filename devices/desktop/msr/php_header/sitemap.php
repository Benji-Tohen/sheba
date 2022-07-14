<?php ?>

<!-- OWL CAROUSEL -->
<link rel="stylesheet" href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>owl-carousel/owl.theme.css">
<script src="<?php echo $cfg["WM"]["Server"]."/".$device."/bootstrap/";?>owl-carousel/owl.carousel.js"></script>
<!-- END OWL CAROUSEL -->

<?php ?>

<!--[if !IE]><!-->
    <style>

    /*
    Max width before this PARTICULAR table gets nasty
    This query will take effect for any screen smaller than 760px
    and also iPads specifically.
    */
    @media
    only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        table, thead, tbody, th, td, tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr { border: 1px solid #ccc; }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
        }

        
    }

    </style>
    <!--<![endif]-->
