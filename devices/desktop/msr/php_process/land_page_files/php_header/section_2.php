<style type="text/css">
    .sec_<?php echo $sec["ID"];?>{
        <?php if($sec["Top_Header"]){?>
            background-image: url(<?php echo $cfg["WM"]["Server"]."/".$sec["Top_Header"];?>);
            background-size: cover;
            background-position: center top;
            height: 700px;
        <?php }?>
    }

    /*--------------------------  Laptop with HiDPI screen ( max 1440 ) --------------------------*/
    @media (max-width:1440px){

    }

    /*--------------------------  MD ( max 1200 ) --------------------------*/
    @media (max-width:1200px){
        .sec_<?php echo $sec["ID"];?>{
            height: 400px;
        }
    }

    /*--------------------------  SM ( max 992 ) --------------------------*/
    @media(max-width:992px){
        .sec_<?php echo $sec["ID"];?>{
            height: 400px;
        }
    }

    /*--------------------------  XS ( max 768 ) --------------------------*/
    @media (max-width:768px){
        .sec_<?php echo $sec["ID"];?>{
            height: 200px;
        }
    }

    /*--------------------------  max 480 --------------------------*/
    @media (max-width:480px){

    }
</style>

<script type="text/javascript">
    
</script>