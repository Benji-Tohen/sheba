<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;600&family=Roboto&display=swap" rel="stylesheet">
        <?php 
            require_once('conf/conf.data.php');
            $csv = array_map('str_getcsv', file('stats/Corona_data_Sheba.csv'));
            array_walk($csv, function(&$a) use ($csv) {
                $a = array_combine($csv[0], $a);
            });
            array_shift($csv); # remove column header

            $dashboard_data = (isset($csv[0]) && !empty($csv[0])) ? $csv[0] :  '';
            if($dashboard_data){
                $num_of_patients = (isset($dashboard_data['NUM_OF_PATIENTS']) && !empty($dashboard_data['NUM_OF_PATIENTS'])) ? $dashboard_data['NUM_OF_PATIENTS'] :  0;
                $num_of_breathabl = (isset($dashboard_data['Num_Of_Breathable']) && !empty($dashboard_data['Num_Of_Breathable'])) ? $dashboard_data['Num_Of_Breathable'] :  0;
                $perc_occupancy = (isset($dashboard_data['Perc_Occupancy']) && !empty($dashboard_data['Perc_Occupancy'])) ? $dashboard_data['Perc_Occupancy'] :  0;

                $num_of_new_patients_today = (isset($dashboard_data['NUM_OF_NEW_PATIENTS_TODAY']) && !empty($dashboard_data['NUM_OF_NEW_PATIENTS_TODAY'])) ? $dashboard_data['NUM_OF_NEW_PATIENTS_TODAY'] :  0;
                $num_of_discharge_patients_today = (isset($dashboard_data['Num_Of_Discharge_Patients_today']) && !empty($dashboard_data['Num_Of_Discharge_Patients_today'])) ? $dashboard_data['Num_Of_Discharge_Patients_today'] :  0;
            }
        ?>
        <title><?php echo $trans->getText('Dashboard corona');?></title>
    </head>
    <body>
        <div class="wrapp-dashboard">
            <div class="one-row">
                <div class="wrapp-item">
                    <div class="item-circle"></div>
                    <div class="item-data"><?php echo  round($perc_occupancy)."%"; ?></div>
                    <div class="item-title"><?php echo $trans->getText('Perc_Occupancy');?></div>
                </div>
                <div class="wrapp-item">
                    <div class="item-circle"></div>
                    <div class="item-data"><?php echo  $num_of_breathabl; ?></div>
                    <div class="item-title"><?php echo $trans->getText('Num_Of_Breathabl');?></div>
                </div>
                <div class="wrapp-item">
                    <div class="item-circle"></div>
                    <div class="item-data"><?php echo  $num_of_patients; ?></div>
                    <div class="item-title"><?php echo $trans->getText('NUM_OF_PATIENTS');?></div>
                </div>
            </div>
            <div class="second-row">
                <div class="wrapp-item">
                    <div class="item-circle"></div>
                    <div class="item-data"><?php echo  $num_of_new_patients_today; ?></div>
                    <div class="item-title"><?php echo $trans->getText('NUM_OF_NEW_PATIENTS_TODAY');?></div>
                </div>
                <div class="wrapp-item">
                    <div class="item-circle"></div>
                    <div class="item-data"><?php echo  $num_of_discharge_patients_today; ?></div>
                    <div class="item-title"><?php echo $trans->getText('Num_Of_Discharge_Patients_today');?></div>
                </div>
            </div>
        </div>

        <style>
            html, body{
                font-family: 'Assistant', 'sans-serif';
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .wrapp-dashboard{
                width: 100vw;
                max-width: 660px;
            }
            .one-row{
                display: flex;
                justify-items: center;
                justify-content: center;
                justify-content: space-between;
            }
            .second-row{
                display: flex;
                justify-items: center;
                justify-content: center;
                justify-content: space-around;
                padding: 0 75px;
            }
            .wrapp-item{
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                display: flex;
                position: relative;
                width: 155px;
                height: 155px;
            }

            .item-circle{
                position: absolute;
                width: 117px;
                height: 117px;
                border-radius: 50%;
                border: 0.8em solid rgba(255, 255, 255, 0.2);
                border-right: 0.8em solid #1bba9d;
                transform: rotate(-50deg);
                background: #f5f6f5;
                z-index: -1;
                box-shadow: 1px 4px 6px #a0a0a059;
            }

            .item-data {
                color: #2d2871;
                font-size: 40px;
                font-weight: 400;
                font-family: 'Roboto', sans-serif;
            }
            .item-title{
                color: #2c2c70;
                font-size: 18px;
                font-weight: 400;
                font-family: 'Assistant'
            }

            @media only screen and (max-width:485px){
                .wrapp-dashboard{
                    max-width: 485px;
                }
                .item-circle{
                    position: absolute;
                    width: 150px;
                    height: 150px;
                    border-radius: 50%;
                    border: 0.5em solid rgba(255, 255, 255, 0.2);
                    border-right: 0.5em solid #1bba9d;
                    transform: rotate(-50deg);
                    background: #f5f6f5;
                    z-index: -1;
                    box-shadow: 1px 4px 6px #a0a0a059;
                }

                .item-circle{
                    width: 70px;
                    height: 70px;
                } 
                .second-row{
                    padding: 0 30px;
                }
                .wrapp-item{
                    width: 100px;
                    height: 100px;
                }
                .item-data {
                    font-size: 25px;
                }
                .item-title{
                    font-size: 12px;
                }
            }
        </style>
    </body>
</html>

